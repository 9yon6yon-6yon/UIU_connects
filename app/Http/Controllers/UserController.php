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
    public function allinfo()
    {
        $id =  Session::get('$user_id');
        $user = DB::table('users')
            ->leftJoin('awards', 'users.u_id', '=', 'awards.user_id')
            ->select('users.*', 'awards.*')
            ->where('users.u_id', '=', $id)
            ->get(); //this is now working properly and IDK why
        $following = DB::select("SELECT users.u_id,users.user_type,users.is_active, personal_infos.userName, personal_infos.image_path 
        FROM follows 
        JOIN users ON follows.following = users.u_id 
        JOIN personal_infos ON users.u_id = personal_infos.user_id 
        WHERE follows.follower =$id");

        $volunteer_works = DB::table('volunteer_works')
            ->select('volunteer_works.*')
            ->where('volunteer_works.user_id', '=', $id)
            ->get();
        $testimonials = DB::table('testimonials')
            ->select('testimonials.*')
            ->where('testimonials.user_id', '=', $id)
            ->get();
        $skills = DB::table('skills')
            ->select('skills.*')
            ->where('skills.user_id', '=', $id)
            ->get();
        $publications = DB::table('publications')
            ->select('publications.*')
            ->where('publications.user_id', '=', $id)
            ->get();
        $projects = DB::table('projects')
            ->select('projects.*')
            ->where('projects.user_id', '=', $id)
            ->get();
        $interests = DB::table('interests')
            ->select('interests.*')
            ->where('interests.user_id', '=', $id)
            ->get();
        $experiences = DB::table('experiences')
            ->select('experiences.*')
            ->where('experiences.user_id', '=', $id)
            ->get();
        $education = DB::table('education')
            ->select('education.*')
            ->where('education.user_id', '=', $id)
            ->get();
        $certificates = DB::table('certificates')
            ->select('certificates.*')
            ->where('certificates.user_id', '=', $id)
            ->get();

        $info = DB::table('users')
            ->leftJoin('contacts', 'users.u_id', '=', 'contacts.user_id')
            ->leftJoin('personal_infos', 'users.u_id', '=', 'personal_infos.user_id')
            ->select('users.u_id', 'users.user_type', 'users.is_active', 'contacts.*', 'personal_infos.*')
            ->where('users.u_id', '=', $id)
            ->first();

        return view('dashboard', compact('user', 'following', 'info', 'volunteer_works', 'experiences', 'testimonials', 'skills', 'publications', 'projects', 'interests', 'education', 'certificates'));
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
            }
            return redirect()->back()->with('error', 'User not found!');
        } else {
            $email = Session::get('$user_email');
            DB::update("UPDATE `users` SET `is_active`=? WHERE `email`= '$email';", [0]);
            Session::flush();
            return view('index');
        }
    }
    public function searchUsers(Request $request)
    {
        $key = $request->input('key');
        if ($key) {
            $user = DB::table('users')
                ->join('personal_infos', 'users.u_id', '=', 'personal_infos.user_id')
                ->leftJoin('contacts', 'users.u_id', '=', 'contacts.user_id')
                ->where('users.email', 'like', '%' . $key . '%')
                ->orWhere('personal_infos.userName', 'like', '%' . $key . '%')
                ->select('users.*', 'personal_infos.*', 'contacts.phone')
                ->get();
            return response()->json(['users' => $user]);
        } else {
            return view('search');
        }
    }
    public function personalInfo($id)
    {
        $user = DB::table('users')
            ->leftJoin('contacts', 'users.u_id', '=', 'contacts.user_id')
            ->leftJoin('personal_infos', 'users.u_id', '=', 'personal_infos.user_id')
            ->where('users.u_id', $id)
            ->select('users.u_id', 'users.user_type', 'users.is_active', 'contacts.*', 'personal_infos.*')
            ->first();
        $posts = DB::table('posts')
            ->where('user_id', $id)
            ->get();
        $jobs = DB::table('jobs')
            ->where('user_id', $id)
            ->get();
        $events = DB::table('events')
            ->where('user_id', $id)
            ->get();
        $applied= DB::table('job_applications')
            ->where('applied_user', $id)
            ->count();


        return view('profile')->with(compact('user', 'posts', 'jobs', 'events','applied'));
    }
    public function follows($id)
    {
        $followerid = Session::get('$user_id');

        // check if the user is already following
        $existingFollow = DB::table('follows')
            ->where('follower', $followerid)
            ->where('following', $id)
            ->first();

        if ($existingFollow) {
            return redirect()->back()->with('error', 'You are already following this user!');
        } else {
            DB::table('follows')->insert([
                'follower' => $followerid,
                'following' => $id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success', 'You have followed the user successfully!');
        }
    }
    public function addAward(Request $request)
    {
        $id = Session::get('$user_id');
        $validatedData = $request->validate([
            'award_name' => 'required',
            'date_received' => 'nullable|date',
            'description' => 'nullable',
        ]);

        // Add the award to the database
        DB::table('awards')->insert([
            'user_id' =>  $id,
            'award_name' => $request->award_name,
            'award_received' => $request->date_received,
            'award_description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        return redirect()->back()->with('success', 'Award added successfully!');
    }
    public function addExperiences(Request $request)
    {
        $id = Session::get('$user_id');
        $validatedData = $request->validate([
            'company' => 'required',
            'position' => 'required',
            'joining_date' => 'required|date',
            'retired_date' => 'nullable|date|after:joining_date',
            'description' => 'nullable',
        ]);
        //company	position	joining_date	retired_date	description
        DB::table('experiences')->insert([
            'user_id' =>  $id,
            'company' => $request->company,
            'position' => $request->position,
            'joining_date' => $request->joining_date,
            'retired_date' => $request->retired_date,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        // Redirect to the previous page with a success message
        return redirect()->back()->with('success', 'Experience added successfully.');
    }
    public function addCertificates(Request $request)
    {
        $id = Session::get('$user_id');
        $validatedData = $request->validate([
            'certification_name' => 'required',
            'issuing_organization' => 'required',
            'expiration_date' => 'required|date',
            'credentials' => 'nullable',
        ]);
        //  certification_name	issuing_organization	credentials	expiration_date 
        DB::table('certificates')->insert([
            'user_id' =>  $id,
            'certification_name' => $request->certification_name,
            'issuing_organization' => $request->issuing_organization,
            'expiration_date' => $request->expiration_date,
            'credentials' => $request->credentials,
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        // Redirect to the previous page with a success message
        return redirect()->back()->with('success', 'Certificate added successfully.');
    }
    public function addSkills(Request $request)
    {
        $id = Session::get('$user_id');
        $validatedData = $request->validate([
            'skill_name' => 'required',
            'proficiency' => 'required',
        ]);
        //  certification_name	issuing_organization	credentials	expiration_date 
        DB::table('skills')->insert([
            'user_id' =>  $id,
            'skill_name' => $request->skill_name,
            'proficiency' => $request->proficiency,
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        // Redirect to the previous page with a success message
        return redirect()->back()->with('success', 'Certificate added successfully.');
    }
    public function addEducation(Request $request)
    {
        $id = Session::get('$user_id');
    }
    public function addTestimonials(Request $request)
    {
        $id = Session::get('$user_id');
    }
    public function addAbout(Request $request)
    {
        $id = Session::get('$user_id');

        $validatedData = $request->validate([
            'userName' => 'required',
            'fathersName' => 'nullable',
            'mothersName' => 'nullable',
            'image_path' => 'required',
            'dob' => 'required|date',
            'nationality' => 'required',
            'status' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:11',
            'others' => 'nullable',
        ]);
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $path = $file->store('public/files');
        } else {
            $path = null;
        }
        $path = str_replace('public/files/', '', $path);
        DB::table('personal_infos')->updateOrInsert(
            ['user_id' => $id],
            [
                'userName' => $request->userName,
                'fathersName' => $request->fathersName,
                'mothersName' => $request->mothersName,
                'image_path' => $path,
                'dob' => $request->dob,
                'nationality' => $request->nationality,
                'status' => $request->status,
                'address' => $request->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('contacts')->updateOrInsert(
            ['user_id' => $id],
            [
                'email' => $request->email,
                'phone' => $request->phone,
                'others' => $request->others,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        return redirect()->back()->with('success', 'Profile Updated  successfully!');
    }
    public function addVolunteerWorks(Request $request)
    {
    }
    public function addInterests(Request $request)
    {
    }
}
