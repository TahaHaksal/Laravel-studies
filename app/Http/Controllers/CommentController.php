<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function __construct(){
        //
    }

    public function insertRecord(){
        DB::table('posts')->insert([
            'title' => 'Post Title',
            'body' => 'Post Description'
        ]);
    }

    public function __destruct(){
        //
    }
}
