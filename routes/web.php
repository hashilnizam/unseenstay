<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReservationController;
use App\Http\Middleware\IsAdmin;

Route::get('/', [HomeController::class, 'index'])->name('unseen.index');
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


Route::get('/blog_single/{id}', [HomeController::class, 'blog_single'])->name('blog_single');

Route::post('/reservation', [PropertyController::class, 'reservation'])->name('reservation');
Route::post('/user_messages', [PropertyController::class, 'user_messages'])->name('user_messages');

Route::post('/check-availability', [ReservationController::class, 'checkAvailability'])->name('check-availability');
Route::post('/bookings_store', [ReservationController::class, 'bookings_store'])->name('bookings_store');
Route::post('/handle-payment', [ReservationController::class, 'handlePayment']);
//user

Route::get('/rooms_single/{id}', [HomeController::class, 'rooms_single'])->name('rooms_single');
Route::get('/my_profile/', [UserController::class, 'my_profile'])->name('my_profile');
Route::get('/bookings/', [UserController::class, 'bookings'])->name('bookings');
Route::get('/rooms_book_now/{id}/}', [HomeController::class, 'rooms_book_now'])->name('rooms_book_now');

//admin

Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/unseen_admin/admin_logout', [UserController::class, 'Admin_Logout'])->name('admin_logout');
    Route::get('/unseen_admin/dashboard', [HomeController::class, 'Admin_Dashboard'])->name('admin_dashboard');
    Route::get('/user_table', [HomeController::class, 'showUser'])->name('show');
    Route::get('/user_add/', [HomeController::class, 'tableUserAdd'])->name('table_user_add');
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
    Route::delete('/room/{id}', [PropertyController::class, 'room_delete']);

    Route::get('/blog/form', [UserController::class, 'blog_form'])->name('blog_form');
    Route::post('/blog/form/submit', [UserController::class, 'blog_form_store'])->name('blog_form_store');
    Route::get('/blog/form/index', [UserController::class, 'blog_form_index'])->name('blog_form_index');
    Route::delete('/blog/{id}', [UserController::class, 'delete_blog']);

    Route::get('/admin/bookings_table', [HomeController::class, 'bookings_table'])->name('bookings_table');
    Route::get('/admin/user_feedback', [HomeController::class, 'user_feedback'])->name('user_feedback');
    Route::delete('/feedback/{id}', [PropertyController::class, 'delete_feedback']);

    Route::get('/admin/banners', [HomeController::class, 'banner'])->name('banner');
    Route::post('/admin/banner/store', [PropertyController::class, 'banner_store'])->name('banner_store');
    Route::get('/admin/banner/index', [HomeController::class, 'banner_index'])->name('banner_index');
    Route::delete('/admin/banner_delete/{id}', [PropertyController::class, 'banner_delete']);

    Route::get('/admin/insta/image', [HomeController::class, 'insta_image'])->name('insta_image');
    Route::post('/admin/insta/store', [PropertyController::class, 'insta_store'])->name('insta_store');
    Route::get('/admin/insta/index', [HomeController::class, 'insta_index'])->name('insta_index');
    Route::delete('/admin/instagram_delete/{id}', [PropertyController::class, 'instagram_delete']);

    Route::get('admin/contact/index', [HomeController::class, 'contact_index'])->name('contact_index');
    Route::get('admin/contact/contact_form', [HomeController::class, 'contact_form'])->name('contact_form');
    Route::post('admin/contact/contact_store', [PropertyController::class, 'contact_store'])->name('contact_store');
    Route::delete('/contact/{id}', [PropertyController::class, 'contact_delete']);


});






