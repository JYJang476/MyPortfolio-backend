<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('CheckAuth')->group(function () {
    // 프로젝트 작성
    Route::post('/project/write', "projectController@WriteProject");

    // 글 쓰기
    Route::post('/mystory/write', "mystoryController@WriteMyStory");

    // 글 수정
    Route::post('/mystory/edit/{id}', "mystoryController@EditMyStory");

    // 글 삭제
    Route::delete('/mystory/{id}', "mystoryController@DeleteMyStory");

    // 로그인 확인
    Route::get('/auth/check', 'UserController@IsLogin');
});

// 로그인
Route::post('/auth/login', 'UserController@Login');
Route::post('/auth/register', 'UserController@Register');

// 마이 스토리 글 검색
Route::get('/mystory/search', 'mystoryController@getFindMyStory');

// 마이 스토리 해당 글 번호 가져오기
Route::get('/mystory/{id}', "mystoryController@getMyStoryNo");

// 마이 스토리 글 목록 가져오기
Route::get('/mystory/list/{page}', "mystoryController@getMyStorys");

// 마이 스토리 해당 글 가져오기
Route::get('/mystory/view/{id}', "mystoryController@getMyStory");

// 이미지 출력
Route::get('/image/{id}', "imageController@showImage");

// 이미지 리스트 출력
Route::get('/list/image', "imageController@GetImageList");

// 프로젝트 리스트 가져오기
Route::get('/project/list/{page}', 'projectController@showProjectList');

// 프로젝트 가져오기
Route::get('/project/view/{id}', "projectController@showProject");
// 내 스펙 데이터 가져오기
Route::get('/stack', "stackController@GetStackData");
Route::post('/stack', "stackController@WriteStackData");


// 내 스킬 관리
Route::post('/skill', 'myskillController@RegistrySkill');
Route::get('/skill', 'myskillController@GetSkillList');
Route::get('/skill/icon/{id}', 'myskillController@GetSkillIcon');
