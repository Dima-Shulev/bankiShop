<?php

use App\Http\Controllers\All\FormBackController;
use Illuminate\Support\Facades\Route;

Route::get('/',[FormBackController::class,'index'])->name('all.home');
Route::get('/create',[FormBackController::class,'create'])->name('all.create');
Route::post('/',[FormBackController::class,'store'])->name('all.store');
Route::get('/json',[FormBackController::class,'json'])->name('app.json');
Route::get('/{path}',[FormBackController::class,'saveImage'])->name('all.saveImage');

