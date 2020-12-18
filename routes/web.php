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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view("main");
});

Route::get('/index/mystory/write', function () {
    return view("write");
});

Route::get('/api/mystory/search', 'mystoryController@getFindMyStory');

Route::get('/api/mystory/{id}', "mystoryController@getMyStoryNo");

Route::get('/index/mystory', "mystoryController@getMyStorys");

Route::get('/index/mystory/{id}', "mystoryController@getMyStory");

Route::post('/index/mystory/write/process', "mystoryController@WriteMyStory");

Route::get('/index/mystory/edit/{id}', "mystoryController@goEdit");

Route::post('/index/mystory/edit/process/{id}', "mystoryController@EditMyStory");

Route::get('/index/mystory/delete/{id}', "mystoryController@DeleteMyStory");

Route::get('/index/image/{id}', "imageController@showImage");

Route::get('/index/project/write', function () {
    return view("projectWrite");
});

Route::get('/index/project', 'projectController@showProjectList');

Route::get('/index/project/{id}', "projectController@showProject");

Route::post('/index/project/write/process', "projectController@WriteProject");

Route::get('/index/login', function () {
    return view("auth.login");
});

Route::get('/index/about', function () {
    return view("about");
});

Route::get('/index/project/{no}', function ($no) {
    return view("view")->with($no);
});

Auth::routes();
