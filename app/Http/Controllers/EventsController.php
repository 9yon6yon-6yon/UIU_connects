<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EventsController extends Controller
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
        DB::table('events')->insert([
            'user_id' =>  $id,
            'event_title' => $request->title,
            'event_details' => $request->details,
            'files' => $path,
            'event_date' => $request->eventdate,
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        return redirect()->back()->with('success', 'Event has been uploaded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = DB::table('events')
            ->select('events.*')
            ->where('events.event_id', '=', $id)
            ->first();
        $user = DB::table('users')
            ->select('users.*')
            ->where('users.u_id', '=', $event->user_id)
            ->first();

        $personal_info = DB::table('personal_infos')
            ->where('user_id', '=', $event->user_id)
            ->first();
        return view('event-view', compact('event', 'user', 'personal_info'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Events $events)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Events $events)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $u_id = Session::get('$user_id');
        DB::table('events')->where([
            ['event_id', '=', $id],
            ['user_id', '=', $u_id],
        ])->delete();
        return redirect()->route('user.posts')->with('success','Post Deleted');;
    }
}
