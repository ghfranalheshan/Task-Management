<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamController;

use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout');

});
Route::middleware('auth:sanctum')->group(function () {
Route::prefix('project')->group(function (){
    Route::controller(ProjectController::class)->group(function () {
   Route::get('/','index');
   Route::post('/','store');
   Route::put('/{project}','update');
   Route::get('/{project}','show');
   Route::delete('/{project}','destroy');
});
});
Route::prefix('team')->group(function (){
    Route::controller(TeamController::class)->group(function () {
    Route::get('/members/{team}','getMyTeamMembers');
    Route::get('/','index');
    Route::post('/','store');
    Route::put('/{team}','update');
    Route::get('/{team}','show');
    Route::delete('/{team}','destroy');
    Route::post('/adduser','addUserToTeam');
    Route::post('/myteam','getMyTeam');
   
  

 });
});
 Route::prefix('task')->group(function (){
    Route::controller(TaskController::class)->group(function () {
    Route::get('/mytask','getMyTask');
    Route::get('/bytype','getMytaskByType');
   Route::get('/','index');
    Route::post('/','store');
    Route::put('/{task}','update');
    Route::get('/{task}','show');
    Route::delete('/{task}','destroy');
    Route::post('/assign','assignTask');
    Route::get('/project/{project}','getTaskbyProject');
    Route::post('/setcompleted/{task}','setComplete');
 
 });
});
 Route::prefix('attachment')->group(function (){
    Route::controller(AttachmentController::class)->group(function () {
    Route::get('/','index');
    Route::post('/','store');
    Route::put('/{attachment}','update');
    Route::get('/{attachment}','show');
    Route::delete('/{attachment}','destroy');
 });
});
 
});
