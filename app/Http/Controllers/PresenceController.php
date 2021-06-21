<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $year = $request->year;
        if (empty($year)) {
            $year = date('Y');
        }
        $month = $request->month;
        if (empty($month)) {
            $month = date('m');
        }

        $models = Presence::where('employee_id', $user->employee_id);

        $models->whereRaw("year(date) = ?",[$year]);
        $models->whereRaw("month(date) = ?",[$month]);
        $models = $models->get();
        $data = $models->groupBy('date')->map(function($rows, $date) {
            return [
                'checkin_time' => $rows->min('time'),
                'checkout_time' => $rows->max('time'),
                'date' => $date,
            ];
        })->values();
        $count = $data->count();

        return response()->json([
            'data' => $data,
            'count' => $count,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = $request->user();
            $model = new Presence;
            $model->employee_id = $user->employee_id;
            $date = date('Y-m-d');
            $model->date = $date;
            $time = date('H:i:s');
            $model->time = $time;
            $model->timezone = $request->timezone;
            $model->latitude = $request->latitude;
            $model->longitude = $request->longitude;
            $model->metadata = [];
            $model->save();

            return response()->json([
                'success' => true,
            ]);
        } catch (\Throwable $th) {
            return $th;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
