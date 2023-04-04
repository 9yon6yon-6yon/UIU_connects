<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use stdClass;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            $userdetails = DB::select("SELECT * from `users` where `email`=?;", [$request['email']]);
            $user = new stdClass();
            if (!empty($userdetails)) {
                $user->u_id = $userdetails[0]->u_id;
            }
            Session::put('$user_id', $user->u_id);
            Session::put('$is_active', 1);
            $user_mail = Session::get('$user_email');
            DB::update("UPDATE `users` SET `is_active`= ? WHERE `email`='$user_mail';", [1]);
            return redirect('user');
        }
        return back()->with('fail', 'Wrong email or password');
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
        return redirect()->route('user-login')->with('success', 'Your account has been created Successfully');
    }
    public function dashboard()
    {
        return view('dashboard');
    }
    public function forgetPageView()
    {
        return view('forgot');
    }
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert(
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]
        );
        $link = route('reset.password.view', ['token' => $token, 'email' => $request->email]);
        $body = "We have received to reset the password for UIU Connects<br> Account associated with " . $request->email . "<br>You can reset by clicking the link below";
        Mail::send('email-forget', ['link' => $link, 'body' => $body], function ($message) use ($request) {
            $message->from('official.net.work.cn@gmail.com', 'UIU Connects');
            $message->to($request->email, 'Test')->subject('Reset Password');
        });
        return back()->with('success', 'Password reset link is sent to you mail');
    }
    public function resetPassView(Request $request, $token = null)
    {
        return view('reset-password')->with(['token' => $token, 'email' => $request->email]);
    }
    public function resetPassword(Request $request, $token = null)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|same:password|min:6',
        ]);
        $check_token = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();
        if (!$check_token) {
            return back()->withInput()->with('fail', 'Invalid Token');
        } else {
            User::where('email', $request->email)->update([
                'password' => Hash::make($request['password'], ['rounds =>12',])
            ]);
            DB::table('password_reset_tokens')->where([
                'email' => $request->email
            ])->delete();
            return redirect()->route('user-login')->with('info', 'Your password has been changed! You can Login with new password');
        }
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
                if ($user[0]->is_active) {
                    DB::update("UPDATE `users` SET `is_active`= ? WHERE `u_id`='$id';", [0]);
                    return redirect()->back()->with('success', 'User set to offline successfully!');
                } else {
                    DB::update("UPDATE `users` SET `is_active`= ? WHERE `u_id`='$id';", [1]);
                    return redirect()->back()->with('success', 'User set to online successfully!');
                }
            }  return redirect()->back()->with('error', 'User not found!');
          
        } else {
            $email = Session::get('$user_email');
            DB::update("UPDATE `users` SET `is_active`=? WHERE `email`= '$email';", [0]);
            Session::flush();
            return redirect()->route('user-login')->with('success', 'Logged out successfully!');
        }
    }
    public function searchUsers($key = null)
    {
        if ($key) {
            $user = DB::table('users')
                ->join('personal_infos', 'users.u_id', '=', 'personal_infos.user_id')
                ->where('users.email', 'like', '%' . $key . '%')
                ->orWhere('personal_infos.userName', 'like', '%' . $key . '%')
                ->select('users.*', 'personal_infos.*')
                ->get();
            return response()->json(['users' => $user]);
        } else {
            return view('search');
        }
    }
    public function personalInfo($id)
    {
        // $user = DB::select("SELECT * FROM `users` u join ");
        return view('profile');
    }
}
