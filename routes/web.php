<?php

use App\Models\Employee;
use Illuminate\Http\Request;
use App\PaymentGateway\Payment;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ex9Middleware;
use App\Http\Controllers\Ex2Controller;
use App\Http\Controllers\Ex4Controller;
use App\Http\Controllers\Ex5Controller;
use App\Http\Controllers\Ex7Controller;
use App\Http\Controllers\Ex10Controller;
use App\Http\Controllers\Ex11Controller;
use App\Http\Controllers\Ex13Controller;
use App\Http\Controllers\Ex16Controller;
use App\Http\Controllers\Ex17Controller;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Exercise 1
Route::prefix('/ex1')->group(function () {
    Route::get('/', function () {
        echo('Hello world');
    });

    Route::get('/required/{name}', function ($name) {
        echo ('Hi ' . $name . '!');
    });

    Route::get('/optional/{name?}', function ($name = null) {
        if ($name)
            echo 'Hello ' . $name . '!';
        else
            echo 'Who are you?';
    });

    Route::get('/alphanumeric/{tag?}', function ($tag = null) {
        if ($tag)
            echo $tag . ' is alphanumeric!';
        else
            echo 'Please enter a tag';
    })->where('tag', '[a-zA-Z0-9]+');

    Route::match(['get', 'post'], '/match', function( Request $req) {
        return 'Requested method is ' . $req->method();
    });

    Route::any('/any-method', function (Request $req) {
        return 'Requested method is ' . $req->method();
    });
});
//Exercise 1

//Exercise 2
Route::prefix('/ex2')->group(function () {
    Route::get('/index', [Ex2Controller::class, 'index']);
    Route::get('/var-ex/{id}', [Ex2Controller::class, 'varEx'])->where('id', '[0-9]+');
    //Ex3
    Route::get('/multi-var', [Ex2Controller::class, 'multiVar']);
    //Ex3
});
//Exercise 2

//Exercise 4
Route::prefix('/ex4')->group(function () {
    Route::get('/get-posts', [Ex4Controller::class, 'getAllPosts']);
    Route::get('/get-post-by-id/{id}', [Ex4Controller::class, 'getPostById'])->where('id', '[0-9]+');
    Route::get('/insert-post', [Ex4Controller::class, 'insertPost']);
    Route::get('/update-post', [Ex4Controller::class, 'updatePost']);
    Route::get('/delete-post/{id}', [Ex4Controller::class, 'deletePost'])->where('id', '[0-9]+');
});
//Exercise 4


//Exercise 5
Route::prefix('/ex5')->group(function () {
    Route::get('/string-manip', [Ex5Controller::class, 'index']);
});
//Exercise 5

//Exercise 7
Route::prefix('/ex7')->group(function (){
    Route::get('/login', [Ex7Controller::class, 'index'])->middleware('test');
    Route::post('/submit', [Ex7Controller::class, 'submit']);
});
//Exercise 7

//Exercise 10
Route::prefix('/ex10')->group(function (){
    Route::get('/storeSession', [Ex10Controller::class, 'storeSessionData']);
    Route::get('/deleteSession', [Ex10Controller::class, 'deleteSessionData']);
    Route::get('/getSession', [Ex10Controller::class, 'getSession']);
});
//Exercise 10

//Exercise 11
Route::prefix('/ex11')->group(function () {
    Route::get('/storeRandom', [Ex11Controller::class, 'storeRandomPost']);
    Route::get('/store', [Ex11Controller::class, 'storePost']);
    Route::get('/allPost', [Ex11Controller::class, 'getAllPosts']);
    Route::post('/store', [Ex11Controller::class, 'storeMethodPost'])->name('post.addsubmit');
    Route::get('/single-post/{id}', [Ex11Controller::class, 'singlePost']);
    Route::get('/delete-post/{id}', [Ex11Controller::class, 'deletePost']);
    Route::get('/edit-post/{id}', [Ex11Controller::class, 'editPost']);
    Route::post('/edit-post/{id}', [Ex11Controller::class, 'editPostSave']);


});
//Exercise 11

//Exercise13
Route::prefix('/ex13')->group(function () {
    Route::get('/join', [Ex11Controller::class, 'innerJoinClause']);
    Route::get('/left-join', [Ex11Controller::class, 'leftJoin']);
    Route::get('/right-join', [Ex11Controller::class, 'rightJoin']);
    Route::get('/all', [Ex11Controller::class, 'getAllModel']);
});
//Exercise13

//Exercise15
Route::prefix('/ex15')->group(function () {
    Route::get('/blade', function () {
        return view('ex14view');
    });
    Route::get('/home', function () {
        return view('index');
    });
    Route::get('/about', function () {
        return view('about');
    });
    Route::get('/contact', function () {
        return view('contact');
    });
});
//Exercise15

//Exercise16
Route::prefix('/ex16')->group(function () {
    Route::get('/pagination', [Ex16Controller::class, 'pagination']);
});
//Exercise16

//Exercise17
Route::prefix('/ex17')->group(function () {
    Route::get('/upload', [Ex17Controller::class, 'uploadForm']);
    Route::post('/upload', [Ex17Controller::class, 'uploadFile']);
});
//Exercise17


//Exercise18
Route::get('/facade', function () {
    Payment::process();
});
//Exercise18

//Exercise19
Route::get('/mail', [MailController::class, 'sendEmail']);
//Exercise19

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/get-students', [StudentController::class, 'getStudents']);

Route::get('/get-student/{id}', [StudentController::class, 'getStudent']);

Route::get('/get-students-between/{id1}/{id2}', [StudentController::class, 'getStudentsinBetween'])->where('id1', '[0-9]+')->where('id2', '[0-9]+');

Route::get('/insert-record', [UserController::class, 'insertRecord']);

Route::get('/get-phone-from-user/{id}', [UserController::class, 'getPhoneByUser']);

Route::get('/get-user-from-phone/{id}', [UserController::class, 'getUserByPhone']);

Route::get('/put-employee', [EmployeeController::class, 'insertEmployee']);

Route::get('/employee-excel', [EmployeeController::class, 'exportIntoExcel']);

Route::get('/employee-csv', [EmployeeController::class, 'exportIntoCSV']);
