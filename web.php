<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello/{name}', function($name) {

    $task = [
                ['name' => "task1", 'due_date' => '<h>task1</h>'],
                ['name' => "task2", 'due_date' => '<h>task2</h>'],
                ['name' => "task3", 'due_date' => '<h>task3</h>']
            ];
    return view('hello')->with("datas", $task);
});

Route::get('/index', function () {
   return view("main");
});

Route::get('/index/mystory', function () {
    return view("mystory");
});

Route::get('/index/mystory/write', function () {
    return view("write");
});

Route::get('/index/project', function () {
    return view("project");
});

Route::get('/index/project/write', function () {
    return view("projectWrite");
});

Route::get('/index/login', function () {
    return view("login");
});

Route::get('/index/about', function () {
    return view("about");
});

Route::get('/index/project/{no}', function ($no) {
    return view("view")->with($no);
});


//
//Route::get('make/model/{name}', function ($name) {
//    return Artisan::call('make:model', ['name'=>$name]);
//});

Route::get('task/list3/{id}', 'TaskController@list3');

//Route::get('task/list3', function() {
//    print(method_exists("App\Http\Controllers\TaskController", '__invoke'));
//    return view('task.list3');
//});

