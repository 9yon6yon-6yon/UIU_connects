<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        $id =  Session::get('$user_id');
        $user = DB::table('users')
            ->select('status', 'u_id', 'user_type')
            ->where('u_id', $id)
            ->first();

        $friends = DB::table('follows')
            ->where('follower', $user->u_id)
            ->where('following', '!=', $user->u_id) 
            ->join('users', 'users.u_id', '=', 'follows.following')
            ->join('personal_infos', 'personal_infos.user_id', '=', 'users.u_id')
            ->select('personal_infos.user_id', 'users.email', 'users.user_type', 'users.is_active', 'personal_infos.userName')
            ->get();


        $active_users = User::join('personal_infos', 'users.u_id', '=', 'personal_infos.user_id')
            ->where('users.is_active', true)
            ->select('personal_infos.userName')
            ->get();


        return response()->json([
            'friends' => $friends,
            'active_users' => $active_users
        ]);
    }
    public function show($id)
    { // Get user's chat history with another user (receiver_id)
        $u_id =  Session::get('$user_id');
        Session::put('$receiver_id', $id);
        $chats = DB::table('chats')
            ->select('chats.*', 'personal_infos.userName','personal_infos.image_path')
            ->join('users', 'users.u_id', '=', 'chats.sender_id')
            ->join('personal_infos', 'personal_infos.user_id', '=', 'users.u_id')
            ->where('chats.receiver_id', $id)
            ->where('chats.sender_id', $u_id)
            ->orWhere('chats.receiver_id', $u_id)
            ->where('chats.sender_id', $id)
            ->orderBy('chats.created_at', 'ASC')
            ->get();

        // return response()->json(['chats' => $chats]);
        return redirect()->back()->with(['chats' => $chats]);
    }
    public function store(Request $request)
    {
        $sender_id = Session::get('$user_id');
        $validatedData = $request->validate([
            'receiver_id' => 'required',
            'message' => 'required',
        ]);
        DB::table('chats')->insert([
            'sender_id' => $sender_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->back();
    }
}
