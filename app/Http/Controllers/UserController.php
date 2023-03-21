<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Phone;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
        //
    }

    public function insertRecord(){
        $phone = new Phone();
        $phone->phone = fake()->phoneNumber();
        $user = User::find(1);
        $user->phone()->save($phone);
        return "Record has been created successfully!";
    }

    public function getPhoneByUser($id){
        $phone = User::find($id)->phone()->get();
        return $phone;
    }

    public function getUserByPhone($id){
        $user = Phone::find($id)->user()->get();
        return $user;
    }

    public function __destruct(){
        //
    }
}
