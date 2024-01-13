<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('user.index');

    }

    public function contact()
    {

        return view('user.contact');
    }

    public function properties()
    {
        $properties = Property::get();
        return view('user.properties',['properties' => $properties]);
    }

    public function resorts()
    {
        return view('user.resorts');
    }
    public function about()
    {

        return view('user.about');
    }
    public function blog()
    {

        return view('user.blog');
    }
    public function login_page()
      {
        return view('user.userlogin');
      }

    //admin side

     public function Admin_Dashboard()
    {
        return view('admin.dashboard.index');

    }

     public function admin_index(){

            return view('admin.dashboard.login');
       }

    //user datatable

    public function showUser()
    {
        $users = User::get();
        return view('admin.dashboard.userDatatable', ['users' => $users]);
    }

    public function tableUserAdd()
    {
        return view('admin.useradd.user_login_form');
    }

}

