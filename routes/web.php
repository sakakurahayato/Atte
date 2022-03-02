<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\ManagementController;

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

Route::get('/',[AttendanceController::class,'index'])->middleware(('auth'));
Route::post('/work_start',[AttendanceController::class,'work_start'])->middleware('auth');
Route::post('/work_end',[AttendanceController::class,'work_end'])->middleware('auth');
Route::post('/rest_start',[RestController::class,'rest_start'])->middleware('auth');
Route::post('/rest_end',[RestController::class,'rest_end'])->middleware('auth');
Route::get('/attendance',[AttendanceController::class,'attendance'])->middleware('auth');
Route::post('/next',[AttendanceController::class,'next']);
Route::post('/back',[AttendanceController::class,'next']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashbord');

require __DIR__.'/auth.php';