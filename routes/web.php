<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Middleware\IsAdmin;

Route::get('/',[HomeController::class,'index'])->name('unseen.index');
Route::get('/unseen_admin', [HomeController::class, 'admin_index']);

//user login

Route::get('/login_page', [HomeController::class, 'login_page'])->name('index_login');
Route::post('/user_sign_in', [UserController::class, 'userSignIn'])->name('user_signin');
Route::post('/user_signup', [UserController::class, 'userSignup'])->name('user_signup');
Route::get('/user_logout', [UserController::class, 'userLogout'])->name('user_logout');

Route::post('/unseen_admin/admin_login', [UserController::class, 'Admin_Login'])->name('admin_login');

Route::get('/contact', [HomeController::class, 'contact'])->name('unseen.contact');
Route::get('/properties', [HomeController::class, 'properties'])->name('unseen.properties');
Route::get('/about', [HomeController::class, 'about'])->name('unseen.about');
Route::get('/blog', [HomeController::class, 'blog'])->name('unseen.blog');



//admin

Route::middleware([IsAdmin::class])->group(function ()
{
    Route::get('/unseen_admin/admin_logout', [UserController::class, 'Admin_Logout'])->name('admin_logout');
    Route::get('/unseen_admin/dashboard', [HomeController::class, 'Admin_Dashboard'])->name('admin_dashboard');
    Route::get('/user_table', [HomeController::class, 'showUser'])->name('show');
    Route::get('/user_table/useradd', [HomeController::class, 'tableUserAdd'])->name('table_user_add');
    Route::post('/user_registration', [UserController::class, 'addUser'])->name('add_User');
    Route::delete('user/{id}', [UserController::class, 'destroy']);

    Route::get('/propertiesIndex', [PropertyController::class, 'propertiesList'])->name('properties_list');
    Route::get('/property/add', [PropertyController::class, 'propertyAdd'])->name('property_add');
    Route::get('/property/add/form2', [PropertyController::class, 'propertyAdd2'])->name('property_add_form_2');
    Route::post('/property/store', [PropertyController::class, 'propertyStore'])->name('property_store');
    Route::post('/property/room/store', [PropertyController::class, 'roomStore'])->name('room_store');
    Route::get('/property/room_list', [PropertyController::class, 'roomList'])->name('room_list');
});




