<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{

   
    //Admin SignUp
    public function Admin_Login(Request $request){
         $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();

            return redirect()->route('admin_dashboard')->withSuccess('You have successfully logged in!');
        }else {
            return redirect()->route('unseen.index')->with('error',"User doesn't exist!");
        }

      }
     
     //Admin Logout
      public function Admin_Logout(){

        Auth::logout();
        return view('admin.dashboard.login');
      }


      //user SignUp
      public function userSignup(Request $request)
      {
          $validatedData = $request->validate([
              'username' => 'required|unique:users',
              'email' => 'required|email|unique:users',
              'password' => 'required|min:6',
              'cpassword' => 'required|same:password',          
          ]);

          if ($validatedData['password'] !== $request->input('cpassword')) {
              return redirect()->route('index_login')->with('error', 'Password confirmation does not match!');
          } else {

          $hashedPassword = bcrypt($validatedData['password']);
          $user = new User();
          $user->username = $validatedData['username'];
          $user->email = $validatedData['email'];
          $user->password = $hashedPassword;
        


          $user->save();

         return redirect()->route('unseen.index')->with('success', 'You have successfully registered, please login again with the new password!');
        }
    }

      //user SignIn
      public function userSignIn(Request $request)
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

           return back()->with('error', "User doesn't exist!");
      }

      }


      // logout
      public function userLogout()
      {
         Auth::logout();
         return redirect()->route('unseen.index')->with('success', 'You have been logged out!');
      }



      // admin user add
    public function addUser(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
            'user_type' => 'required'
        ]);


        if ($validatedData['password'] !== $request->input('cpassword')) 
        {
            return back()->with('error', "User doesn't exist!");

        }

        $hashedPassword = bcrypt($validatedData['password']);

        $user = new User();
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = $hashedPassword;
        $user->user_type = $validatedData['user_type'];


        $user->save();
        return redirect()->route('show')->with('success', 'user added');
    }

    //user datatable delete function
    public function destroy($id)
      {
          $user = User::findOrFail($id);
          $user->delete();
          return back()->withSuccess("User Deleted Successfully");
      }


      
}





