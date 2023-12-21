<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{

    public function admin_index(){
                  toastr()->success('Please select the shop delivery area','Shop Delivery Type Updated');

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

      //user login id

      public function signup(Request $request)
      {
          $validatedData = $request->validate([
              'username' => 'required|unique:users',
              'email' => 'required|email|unique:users',
              'password' => 'required|min:6',
              'cpassword' => 'required|same:password', // Check if cpassword matches password
          ]);

          // Check if the password matches the confirmed password
          if ($validatedData['password'] !== $request->input('cpassword')) {
              return redirect()->route('unseen.login')->with('error', 'Password confirmation does not match!');
          }

          $hashedPassword = bcrypt($validatedData['password']);

          $user = new User();
          $user->username = $validatedData['username'];
          $user->email = $validatedData['email'];
          $user->password = $hashedPassword;

          $user->save();

          return redirect()->route('unseen.index')->with('sucess', 'You have successfully registered, please login agin with new password!');
          //->with('success', 'You have successfully regist;
      }

      // logout

      public function user_logout()
      {
         Auth::logout();
         return redirect()->route('unseen.index')->with('success', 'You have been logged out!');
      }

      public function login(Request $request)
      {
      $credentials = $request->validate([
          'username' => 'required',
          'password' => 'required|min:6'
      ]);

      if (Auth::attempt($credentials)) {
          $user = Auth::user();
          $request->session()->regenerate();
          return redirect()->route('unseen.index')->withSuccess('You have successfully logged in!');
      } else {
          return redirect()->route('sign_up')->with('error', "User doesn't exist!");
      }
      }
      public function signin()
      {
        return view('user.userlogin');
      }

      public function user_datatable()
      {
          return view('admin.dashboard.userdatatable');

      }

}
