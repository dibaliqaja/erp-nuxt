<?php

namespace App\Exports;

use App\Models\Salary;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalaryExport implements FromQuery, WithMapping, WithHeadings
{
    public function __construct(int $year, int $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public function query()
    {
        return Salary::query()->where('year', $this->year)->where('month', $this->month);
    }

    public function map($salary): array 
    {
        return [
            $salary->employee->name,
            $salary->amount
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Salary Amount'
        ];
    }
}
