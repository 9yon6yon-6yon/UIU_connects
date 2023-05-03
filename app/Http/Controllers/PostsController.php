<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Jobs;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Posts::orderBy('created_at', 'desc')->get();
        $jobs = Jobs::orderBy('created_at', 'desc')->get();
        $events = Events::orderByRaw('ABS(DATEDIFF(event_date, NOW())) ASC')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('post', compact('posts', 'jobs', 'events'));
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
        DB::table('posts')->insert([
            'user_id' =>  $id,
            'post_title' => $request->title,
            'content' => $request->details,
            'files' => $path,
            'upvotes' => 0,
            'downvotes' => 0,
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        return redirect()->back()->with('success', 'Post has been uploaded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = DB::table('posts')
            ->select('posts.*')
            ->where('posts.post_id', '=', $id)
            ->first();

        $user = DB::table('users')
            ->select('users.*')
            ->where('users.u_id', '=', $post->user_id)
            ->first();

        $personal_info = DB::table('personal_infos')
            ->where('user_id', '=', $post->user_id)
            ->first();

        $comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.u_id')
            ->join('personal_infos', 'users.u_id', '=', 'personal_infos.user_id')
            ->select('comments.*', 'personal_infos.userName','personal_infos.image_path')
            ->where('pst_id', '=', $id)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('post-view', compact('post', 'comments','user','personal_info'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Posts $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $u_id = Session::get('$user_id');
        DB::table('posts')->where([
            ['post_id', '=', $id],
            ['user_id', '=', $u_id],
        ])->delete();
        return redirect()->route('user.posts')->with('success','Post Deleted');;
    }
    public function upvote($id)
    {
        $user_id = Session::get('$user_id');

        // Check if the user has already upvoted this post
        $existing_vote = DB::table('votes')
            ->where('user_id', $user_id)
            ->where('pst_id', $id)
            ->where('type', 'upvote')
            ->first();

        if ($existing_vote) {
            // The user has already upvoted, so cancel their vote
            DB::table('votes')
                ->where('user_id', $user_id)
                ->where('pst_id', $id)
                ->delete();
            DB::update("UPDATE posts SET upvotes = upvotes - 1 WHERE post_id = $id;");
        } else {
            // The user has not upvoted, so add their vote
            DB::table('votes')->insert([
                'user_id' => $user_id,
                'pst_id' => $id,
                'type' => 'upvote',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::update("UPDATE posts SET upvotes = upvotes + 1 WHERE post_id = $id;");
        }

        return redirect()->back();
    }

    public function downvote($id)
    {
        $user_id = Session::get('$user_id');

        // Check if the user has already downvoted this post
        $existing_vote = DB::table('votes')
            ->where('user_id', $user_id)
            ->where('pst_id', $id)
            ->where('type', 'downvote')
            ->first();

        if ($existing_vote) {
            // The user has already downvoted, so cancel their vote
            DB::table('votes')
                ->where('user_id', $user_id)
                ->where('pst_id', $id)
                ->delete();
            DB::update("UPDATE posts SET downvotes = downvotes - 1 WHERE post_id = $id;");
        } else {
            // The user has not downvoted, so add their vote
            DB::table('votes')->insert([
                'user_id' => $user_id,
                'pst_id' => $id,
                'type' => 'downvote',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::update("UPDATE posts SET downvotes = downvotes + 1 WHERE post_id = $id;");
        }

        return redirect()->back();
    }
    public function comment(Request $request,$id){
        $u_id = Session::get('$user_id');
        DB::table('comments')->insert([
            'user_id' => $u_id,
            'pst_id' => $id,
            'c_details' => $request->c_details,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Commented successfully!');
    }
}
