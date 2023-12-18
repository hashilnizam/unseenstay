<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;



include('admin.php');

//users

Route::get('/',[HomeController::class,'index'])->name('unseen.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('unseen.contact');
Route::get('/rooms', [HomeController::class, 'rooms'])->name('unseen.rooms');
Route::get('/resorts', [HomeController::class, 'resorts'])->name('unseen.resorts');
Route::get('/about', [HomeController::class, 'about'])->name('unseen.about');
Route::get('/blog', [HomeController::class, 'blog'])->name('unseen.blog');
Route::get('/userlogin', [HomeController::class, 'login'])->name('unseen.login');


// Route::get('/test', [HomeController::class, 'testQueryBuilder'])->name('unseen.test');