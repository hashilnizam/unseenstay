<?php

namespace App\Http\Controllers;

use App\Models\unseen;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\property;


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

    public function propertice()
    {
        $properties = property::get();
        return view('user.propertice',['properties' => $properties]);
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
        return view('admin.useradd.index');
    }

    // resort add
    public function propertiesUpdate()
    {
        $properties = property::get();
        return view('admin.propertiesUpdate.index',['properties' => $properties]);
    }



}

