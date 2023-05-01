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
            ->join('users', 'users.u_id', '=', 'follows.following')
            ->join('personal_infos', 'personal_infos.user_id', '=', 'users.u_id')
            ->select('users.email', 'users.user_type', 'users.is_active', 'personal_infos.userName')
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
        $chats = DB::table('chats')
            ->select('chats.message', 'chats.created_at', 'personal_infos.userName')
            ->join('users', 'users.u_id', '=', 'chats.sender_id')
            ->join('personal_infos', 'personal_infos.user_id', '=', 'users.u_id')
            ->where('chats.receiver_id', $id)
            ->orderBy('chats.created_at', 'desc')
            ->get();

        return response()->json(['chats' => $chats]);
    }
    public function store(Request $request)
    {
    }
}
