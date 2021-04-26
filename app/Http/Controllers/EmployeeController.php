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
    public function index(Request $request)
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
        if (empty($request->name)) {
            return response()->json([
                'success' => false,
                'message' => "Nama wajib diisi"
            ]);
        }
        if (strlen($request->name) < 4) {
            return response()->json([
                'success' => false,
                'message' => "Nama minimal 4 huruf"
            ]);
        }
        if (empty($request->job_title)) {
            return response()->json([
                'success' => false,
                'message' => "Jabatan wajib diisi"
            ]);
        }
        if (empty($request->employee_status)) {
            return response()->json([
                'success' => false,
                'message' => "Status Pekerjaan wajib diisi"
            ]);
        }
        if (empty($request->date_of_birth)) {
            return response()->json([
                'success' => false,
                'message' => "Tanggal lahir wajib diisi"
            ]);
        }

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
        if (empty($request->name)) {
            return response()->json([
                'success' => false,
                'message' => "Nama wajib diisi"
            ]);
        }
        if (strlen($request->name) < 4) {
            return response()->json([
                'success' => false,
                'message' => "Nama minimal 4 huruf"
            ]);
        }
        if (empty($request->job_title)) {
            return response()->json([
                'success' => false,
                'message' => "Jabatan wajib diisi"
            ]);
        }
        if (empty($request->employee_status)) {
            return response()->json([
                'success' => false,
                'message' => "Status Pekerjaan wajib diisi"
            ]);
        }
        if (empty($request->date_of_birth)) {
            return response()->json([
                'success' => false,
                'message' => "Tanggal lahir wajib diisi"
            ]);
        }

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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Employee $employee)
    {
        $user = $request->user();
        if (!$user->getAllPermissions()->where('name','employee.delete')->first()) {
            return response()->json([
                'success' => false,
            ]);
        }

        $employee->delete();

        return response()->json([
            'success' => true,
            'status'  => 200,
            'data'    => $employee
        ]);
    }
}
