<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data  = Employee::get();
        $count = Employee::count();

        return response()->json([
            'status' => 200,
            'data'   => $data,
            'count'  => $count
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
            Employee::create([
                'name'            => $request->name,
                'job_title'       => $request->job_title,
                'employee_status' => $request->employee_status,
                'date_of_birth'   => $request->date_of_birth,
                'profiles'        => '{}',
                'unit_id'         => 1
            ]);

            return response()->json([
                'success' => true,
                'status'  => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response()->json([
            'success' => true,
            'status'  => 200,
            'data'    => $employee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        try {
            $data = [
                'name'            => $request->name,
                'job_title'       => $request->job_title,
                'employee_status' => $request->employee_status,
                'date_of_birth'   => $request->date_of_birth,
                'profiles'        => '{}',
                'unit_id'         => 1
            ];

            $employee->update($data);

            return response()->json([
                'success' => true,
                'status'  => 200,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();

            return response()->json([
                'success' => true,
                'status'  => 200,
                'data'    => $employee
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message'  => $th
            ]);
        }
    }
}
