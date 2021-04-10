<?php

namespace App\Http\Controllers;

use App\Models\WorkSchedule;
use Illuminate\Http\Request;

class WorkScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data  = WorkSchedule::get();
        $count = WorkSchedule::count();

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
        if (empty($request->checkin_time)) {
            return response()->json([
                'success' => false,
                'message' => "Jam Masuk wajib diisi"
            ]);
        }        
        if (empty($request->break_start_time)) {
            return response()->json([
                'success' => false,
                'message' => "Jam Istirahat Mulai wajib diisi"
            ]);
        }
        if (empty($request->break_end_time)) {
            return response()->json([
                'success' => false,
                'message' => "Jam Istirahat Selesai  wajib diisi"
            ]);
        }
        if (empty($request->checkout_time)) {
            return response()->json([
                'success' => false,
                'message' => "Jam Keluar wajib diisi"
            ]);
        }
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

        WorkSchedule::create([
            'checkin_time'     => $request->checkin_time,
            'break_start_time' => $request->break_start_time,
            'break_end_time'   => $request->break_end_time,
            'checkout_time'    => $request->checkout_time,          
            'name'             => $request->name
        ]);

        return response()->json([
            'success' => true,
            'status'  => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $workSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(WorkSchedule $workSchedule)
    {
        return response()->json([
            'success' => true,
            'status'  => 200,
            'data'    => $workSchedule,
        ]);
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
     * @param  int  $workSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkSchedule $workSchedule)
    {
        if (empty($request->checkin_time)) {
            return response()->json([
                'success' => false,
                'message' => "Jam Masuk wajib diisi"
            ]);
        }       
        if (empty($request->break_start_time)) {
            return response()->json([
                'success' => false,
                'message' => "Jam Istirahat Mulai wajib diisi"
            ]);
        }
        if (empty($request->break_end_time)) {
            return response()->json([
                'success' => false,
                'message' => "Jam Istirahat Selesai  wajib diisi"
            ]);
        }
        if (empty($request->checkout_time)) {
            return response()->json([
                'success' => false,
                'message' => "Jam Keluar wajib diisi"
            ]);
        }
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

        $data = [
            'checkin_time'     => $request->checkin_time,
            'break_start_time' => $request->break_start_time,
            'break_end_time'   => $request->break_end_time,
            'checkout_time'    => $request->checkout_time,          
            'name'             => $request->name
        ];

        $workSchedule->update($data);

        return response()->json([
            'success' => true,
            'status'  => 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $workSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkSchedule $workSchedule)
    {
        $workSchedule->delete();

        return response()->json([
            'success' => true,
            'status'  => 200,
            'data'    => $workSchedule
        ]);
    }
}
