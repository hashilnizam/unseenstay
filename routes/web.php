<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;

Route::get('/',[HomeController::class,'index'])->name('unseen.index');
Route::get('/unseenadmin', [HomeController::class, 'admin_index']);

//user login

Route::get('/loginpage', [HomeController::class, 'login_page'])->name('index_login');
Route::post('/usersignin', [UserController::class, 'userSignIn'])->name('user_signin');
Route::post('/usersignup', [UserController::class, 'userSignup'])->name('user_signup');
Route::get('/userlogout', [UserController::class, 'userLogout'])->name('user_logout');

Route::post('/unseenadmin/adminlogin', [UserController::class, 'Admin_Login'])->name('admin_login');

Route::get('/contact', [HomeController::class, 'contact'])->name('unseen.contact');
Route::get('/propertice', [HomeController::class, 'propertice'])->name('unseen.propertice');
Route::get('/about', [HomeController::class, 'about'])->name('unseen.about');
Route::get('/blog', [HomeController::class, 'blog'])->name('unseen.blog');



//admin

Route::middleware([IsAdmin::class])->group(function ()
{
    Route::get('/unseenadmin/adminlogout', [UserController::class, 'Admin_Logout'])->name('admin_logout');
    Route::get('/unseenadmin/dashboard', [HomeController::class, 'Admin_Dashboard'])->name('admin_dashboard');
    Route::get('/usertable', [HomeController::class, 'showUser'])->name('show');
    Route::get('/usertable/useradd', [HomeController::class, 'tableUserAdd'])->name('table_user_add');
    Route::post('/userregistration', [UserController::class, 'addUser'])->name('add_User');
    Route::delete('user/{id}', [UserController::class, 'destroy']);

//resorts update
    Route::get('/propertiesUpdate', [HomeController::class, 'propertiesUpdate'])->name('properties_update');
    Route::get('/property/create', [UserController::class, 'create'])->name('properties_add');
    Route::post('/property', [UserController::class, 'categoryStore'])->name('properties_store');
    Route::delete('property/{id}', [UserController::class, 'destroy_property']);






});




