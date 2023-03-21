<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    public static function getEmployee(){
        $records = DB::table('employees')->select('id', 'name', 'email', 'salary', 'department')->get()->toArray();
        return $records;
    }
}
