<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Console\Command;

class CalculateMonthlySalary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:monthlysalary {year} {month}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $year = $this->argument('year');
        $month = $this->argument('month');

        $employees = Employee::get();
        foreach ($employees as $employee) {
            $response = calculateSalesSalary($employee->id, $year, $month);
            echo json_encode($response) . "\n";

            Salary::updateOrCreate([
                'employee_id' => $employee->id,
                'year' => $year,
                'month' => $month
            ], [
                'amount' => $response['total'],
                'details' => $response['detail']
            ]);
        }

        return 0;
    }
}

