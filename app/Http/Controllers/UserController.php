<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use stdClass;

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
            Session::put('$user_email', $request['email']);
            $userdetails = DB::select("SELECT `u_id` from `users` where `email`=?;", [$request['email']]);
            $user = new stdClass();
            if (!empty($userdetails)) {
                $user->u_id = $userdetails[0]->u_id;
            }
            Session::put('$user_id', $user->u_id);
            $user_mail = Session::get('$user_email');
            DB::update("UPDATE `users` SET `is_active`= ? WHERE `email`='$user_mail';", [1]);
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
        $user = DB::select('select * from users where u_id=?', [$id]);
        return view('dashboard')->with(compact('user'));
    }
    public function logout($id = null)
    {
        if ($id) {
            $user = DB::select('select * from users where u_id=?', [$id]);
            if ($user) {
                DB::update("UPDATE `users` SET `is_active`= ? WHERE `u_id`='$id';", [0]);
                return redirect()->back()->with('success', 'User set to offline successfully!');
            } else {
                return redirect()->back()->with('error', 'User not found!');
            }
        } else {
            $email = Session::get('$user_email');
            DB::update("UPDATE `users` SET `is_active`=? WHERE `email`= '$email';", [0]);
            Session::flush();
            return redirect()->route('user-login')->with('success', 'Logged out successfully!');
        }
    }
}
