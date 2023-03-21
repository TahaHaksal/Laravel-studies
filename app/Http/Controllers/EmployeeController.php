<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function __construct(){
        //
    }

    public function insertEmployee(){
        foreach(range(1, 100) as $i){
            DB::table('employees')->insert([
                'name' => fake()->name(),
                'email' => fake()->email(),
                'salary' => fake()->numberBetween(2500, 50000).'$',
                'department' => fake()->jobTitle(),
            ]);
        }
        return "Successfully created Employees";
    }

    public function exportIntoExcel(){
        return Excel::download(new EmployeeExport, 'employeelist.xlsx');
    }

    public function exportIntoCSV(){
        return Excel::download(new EmployeeExport, 'employeelist.csv');
    }

    public function __destruct(){
        //
    }
}
