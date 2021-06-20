<?php

namespace App\Http\Controllers;

use App\Models\EmployeeActivity;
use Illuminate\Http\Request;

class EmployeeActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user   = $request->user();
        $models = EmployeeActivity::where('employee_id', $user->employee_id);
        $date   = date('Y-m-d',strtotime($request->date));

        $models->where("date",$date);
        $count  = $models->count();
        $models = $models->get();
        $data   = $models->map(function($row) {
            return [
                'start'         => strtotime($row->date. ' ' . $row->time_start) * 1000,
                'end'           => strtotime($row->date. ' ' . $row->time_end) * 1000,
                'time_start'    => $row->time_start,
                'time_end'      => $row->time_end,
                'date'          => $row->date,
                'title'         => $row->notes,
            ];
        })->values();

        return response()->json([
            'data'  => $data,
            'count' => $count,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function calendar(Request $request)
    {
        $user   = $request->user();
        $models = EmployeeActivity::where('employee_id', $user->employee_id);
        
        $start_date = date('Y-m-d',strtotime($request->start));
        $end_date   = date('Y-m-d',strtotime($request->end));

        $models->whereBetween("date",[$start_date, $end_date]);
        $models     = $models->get();
        $data       = $models->map(function($row) {
            return [
                'start' => strtotime($row->date. ' ' . $row->time_start) * 1000,
                'end'   => strtotime($row->date. ' ' . $row->time_end) * 1000,
                'title' => $row->notes,
            ];
        })->values();

        return response()->json($data);
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
        $user = $request->user();

        if (empty($request->notes)) {
            return response()->json([
                'success' => false,
                'message' => "Activities wajib diisi"
            ]);
        }
        
        $model = new EmployeeActivity;
        $model->employee_id = $user->employee_id;
        $model->date        = $request->date;
        $model->time_start  = $request->time_start.':00';
        $model->time_end    = $request->time_end.':00';
        $model->timezone    = $request->timezone;
        $model->latitude    = $request->latitude;
        $model->longitude   = $request->longitude;
        $model->notes       = $request->notes;
        $model->metadata    = [];
        $model->save();

        return response()->json([
            'success' => true,
        ]);
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
