<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;



include('admin.php');
include('userid.php');


//view

Route::get('/',[HomeController::class,'index'])->name('unseen.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('unseen.contact');
Route::get('/rooms', [HomeController::class, 'rooms'])->name('unseen.rooms');
Route::get('/resorts', [HomeController::class, 'resorts'])->name('unseen.resorts');
Route::get('/about', [HomeController::class, 'about'])->name('unseen.about');
Route::get('/blog', [HomeController::class, 'blog'])->name('unseen.blog');



