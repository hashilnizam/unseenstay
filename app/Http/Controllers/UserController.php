<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function admin_index(){
      
            return view('admin.dashboard.login');
       }

    public function unseenadmin_login(Request $request){
         $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
         
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->withSuccess('You have successfully logged in!');
        }else {
            return redirect()->route('unseen.index')->with('error',"User doesn't exist!");
        }

      }

      public function unseenadmin_logout(){

        Auth::logout();
        return view('admin.dashboard.login');
      }
}