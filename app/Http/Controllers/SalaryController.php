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
