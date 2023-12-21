<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\HomeController;




Route::get('/unseenadmin', [UserController::class, 'admin_index']);
Route::post('/unseenadmin/login', [UserController::class, 'unseenadmin_login'])->name('admin_login');
Route::middleware([IsAdmin::class])->group(function () {
Route::get('/unseenadmin/dashboard', [HomeController::class, 'unseenadmin_dashboard'])->name('admin.dashboard');
});
Route::get('/unseenadmin/logout', [UserController::class, 'unseenadmin_logout'])->name('admin_logout');

//user datatable

Route::get('/usertable', [UserController::class, 'user_datatable'])->name(name: 'userdatatable');
?>
