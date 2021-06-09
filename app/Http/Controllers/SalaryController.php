<?php

namespace App\Http\Controllers;

use App\Exports\SalaryExport;
use App\Models\Salary;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SalaryController extends Controller
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

        $models = Salary::with(['employee']);

        $models->where("year", $year);
        $models->where("month", $month);
        $count = $models->count();
        $models = $models->get();

        return response()->json([
            'data' => $models,
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
            $model = new Salary;
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
            dd($th);
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

    public function export(Request $request)
    {
        $year = $request->year;
        if (empty($year)) {
            $year = date('Y');
        }

        $month = $request->month;
        if (empty($month)) {
            $month = date('m');
        }

        return Excel::download(new SalaryExport($year, $month), 'salary.xlsx');
    }
}
