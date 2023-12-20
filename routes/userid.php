<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;


//Route

Route::post('usersignup',[UserController::class, 'signup'])->name('sign_up');
Route::get('signin', [UserController::class, 'signin'])->name('sign_in');
Route::post('/lohnvhjgin', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'user_logout'])->name('user.logout');


?>