<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = Session::get('$user_id');
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $path = $file->store('public/files');
        } else {
            $path = null;
        }
        $path = str_replace('public/files/', '', $path);
        DB::table('jobs')->insert([
            'user_id' =>  $id,
            'job_title' => $request->title,
            'job_details' => $request->details,
            'files' => $path,
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        return redirect()->back()->with('success', 'Job post has been uploaded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jobs = DB::table('jobs')
            ->select('jobs.*')
            ->where('jobs.job_id', '=', $id)
            ->first();
        $user = DB::table('users')
            ->select('users.*')
            ->where('users.u_id', '=', $jobs->user_id)
            ->first();

        $personal_info = DB::table('personal_infos')
            ->where('user_id', '=', $jobs->user_id)
            ->first();
        $applications = DB::table('job_applications')
            ->where('j_id', '=', $id)
            ->get();

        return view('job-view', compact('jobs', 'user', 'personal_info', 'applications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jobs $jobs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jobs $jobs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $u_id = Session::get('$user_id');
        DB::table('jobs')->where([
            ['job_id', '=', $id],
            ['user_id', '=', $u_id],
        ])->delete();
        return redirect()->route('user.posts')->with('success','Post Deleted');
    }

    public function applyforjob(Request $request, $id)
    {
        $u_id = Session::get('$user_id');
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $path = $file->store('public/files');
        } else {
            $path = null;
        }
        $path = str_replace('public/files/', '', $path);
        DB::table('job_applications')->insert([
            'applied_user' => $u_id,
            'j_id' => $id,
            'file_path' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Application sent successfully!');
    }
}
