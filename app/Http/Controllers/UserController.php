<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $passwordHash;
    public function login()
    {
        return view('login');
    }
    public function loginCheck(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
<<<<<<< Updated upstream
=======
            // Session::put('$user_email', $request['email']);
            // $user_mail = Session::get('$user_email');
            // DB::update("UPDATE `users` SET `is_active`= ? WHERE `email`='$user_mail';", [1]);
>>>>>>> Stashed changes
            return redirect('user');
        }
    }
    public function register()
    {
        return view('signup');
    }
    public function regUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|same:password|min:6',
            'type' => 'required|in:student,teacher,admin',
        ]);

        // Create a new user instance with the form inputs
        $user = new User([
            'email' => $request->input('email'),
            'password' => Hash::make($request['password'], ['rounds =>12',]),
            'user_type' => $request->input('type'),
            'status' => 'pending',
            'is_active' => false
        ]);

        $user->save();
        return redirect()->route('user-login')->with('success', 'Your account has been created. Please login.');
    }
    public function dashboard()
    {
        return view('dashboard');
    }
    public function resetPassword()
    {
    }
    public function profile($id)
    {
<<<<<<< Updated upstream
        $user = DB::select('select email,status from users where u_id=?',[$id]);
        
=======
        $user = DB::select('select email,status from users where u_id=?', [$id]);
>>>>>>> Stashed changes
        return view('dashboard')->with(compact('user'));
    }
    public function logout()
    {
<<<<<<< Updated upstream
=======
        $email = Session::get('$user_email');
        DB::update("UPDATE `users` SET `is_active`='? WHERE `email`= '$email';", [0]);
>>>>>>> Stashed changes
        Session::flush();
        Auth::logout();
    }
}
