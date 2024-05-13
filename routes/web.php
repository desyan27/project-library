<?php

use App\Http\Controllers\JurnalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\library;

Route::get('/', [library::class,'index']);
Route::get('/jurnal',[JurnalController::class,'index']);
Route::get('/addjurnal',[JurnalController::class,'addJurnal']);
Route::post('/simpanrekening', [library::class,'store']);
Route::post('/editrekening', [library::class,'edit']);
Route::post('/deleterekening', [library::class,'delete']);
Route::post('/deletejurnal',[JurnalController::class,'delete']);
Route::post('/createjurnal',[JurnalController::class,'create']);


