<?php

namespace App\Http\Controllers;

use App\Models\unseen;
use Illuminate\Http\Request;

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

    public function rooms()
    {

        return view('user.rooms');
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

    /**
     * Show the form for creating a new resource.
     */
    public function login()
    {
    
        return view('user.userlogin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function unseenadmin_dashboard()
    {
        return view('admin.dashboard.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(){
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(unseen $unseen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, unseen $unseen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(unseen $unseen)
    {
        //
    }
}
