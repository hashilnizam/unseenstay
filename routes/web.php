<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsLogin;

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
Route::get('/blog_single', [HomeController::class, 'blog_single'])->name('blog_single');

Route::get('/rooms_book_now/{id}/{user_id}', [HomeController::class, 'rooms_book_now'])->name('rooms_book_now');
Route::post('/reservation', [PropertyController::class, 'reservation'])->name('reservation');

//user

Route::middleware([IsLogin::class])->group(function ()
{
    Route::get('/rooms_single/{id}', [HomeController::class, 'rooms_single'])->name('rooms_single');
    Route::get('/my_profile/', [UserController::class, 'my_profile'])->name('my_profile');
    Route::get('/bookings/', [UserController::class, 'bookings'])->name('bookings');

});
//admin

Route::middleware([IsAdmin::class])->group(function ()
{
    Route::get('/unseen_admin/admin_logout', [UserController::class, 'Admin_Logout'])->name('admin_logout');
    Route::get('/unseen_admin/dashboard', [HomeController::class, 'Admin_Dashboard'])->name('admin_dashboard');
    Route::get('/user_table', [HomeController::class, 'showUser'])->name('show');
    Route::get('/user_table/useradd', [HomeController::class, 'tableUserAdd'])->name('table_user_add');
    Route::post('/user_registration', [UserController::class, 'addUser'])->name('add_User');
    Route::delete('user/{id}', [UserController::class, 'destroy']);

    Route::get('/properties/index', [PropertyController::class, 'propertiesList'])->name('properties_list');
    Route::get('/property/add', [PropertyController::class, 'propertyAdd'])->name('property_add');
    Route::delete('/property/{id}', [PropertyController::class, 'destroy']);

    Route::get('/property/add/form2', [PropertyController::class, 'propertyAdd2'])->name('property_add_form_2');
    Route::post('/property/store', [PropertyController::class, 'propertyStore'])->name('property_store');
    Route::post('/property/room/store', [PropertyController::class, 'roomStore'])->name('room_store');
    Route::get('/property/room_list', [PropertyController::class, 'roomList'])->name('room_list');
    Route::get('/property/room_Add', [PropertyController::class, 'roomAdd'])->name('room_Add');

    Route::get('/blog/form', [UserController::class, 'blog_form'])->name('blog_form');
    Route::post('/blog/form/submit', [UserController::class, 'blog_form_store'])->name('blog_form_store');
    Route::get('/blog/form/index', [UserController::class, 'blog_form_index'])->name('blog_form_index');
    Route::delete('/blog/{id}', [UserController::class, 'delete_blog']);

});




