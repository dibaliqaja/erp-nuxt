<?php

use App\Models\Presence;
use App\Models\PurchaseOrder;

function isAllowedUpload($ext) {
    $all = array('jpg','jpeg','bmp','gif','png','jpeg-large','tif','tiff','doc','docx','xls','xlsx','pdf','odt','ppt','pptx','txt','zip','rar','csv','tar','gz','7z','mp4','mkv');
    return in_array(strtolower($ext),$all);
}

function randSeed($min, $max, $seed) {
    return round($min + (hexdec(md5($seed)) / hexdec("FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF")) * ($max - $min));
}

function calculateSalesSalary($employee_id, $year, $month) {
    $start_date = date('Y-m-01', strtotime("$year-$month-01"));
    $end_date   = date('Y-m-t', strtotime("$year-$month-01"));

    $calculateDailyAttendance = calculateDailyAttendance($employee_id, $start_date, $end_date);
    $calculateTotalSales = calculateTotalSales($employee_id, $start_date, $end_date);
    $total = $calculateDailyAttendance * 50000 + $calculateTotalSales * 1 / 100;

    return [
        'total' => $total,
        'detail' => [
            'daily_attendance' => $calculateDailyAttendance,
            'basic_salary' => $calculateDailyAttendance * 50000,
            'total_salary' => $calculateTotalSales,
            'commision' => $calculateTotalSales * 1 / 100
        ]
    ];
}

function calculateDailyAttendance($employee_id, $start_date, $end_date) {
    $models = Presence::where('employee_id', $employee_id);

    $models->whereBetween("date",[$start_date, $end_date]);
    $models = $models->get();
    $data = $models->groupBy('date')->map(function($rows, $date) {
        return [
            'checkin_time' => $rows->min('time'),
            'checkout_time' => $rows->max('time'),
            'date' => $date,
        ];
    })->values();

    return $data->count();
}

function calculateTotalSales($employee_id, $start_date, $end_date) {
    $models = PurchaseOrder::where('employee_id', $employee_id);
    $models->whereBetween("created_at", [$start_date . "00:00:00", $end_date . "23:59:59"]);

    return $models->sum('total_price');
}

