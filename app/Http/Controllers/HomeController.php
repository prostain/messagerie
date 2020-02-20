<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    public function index(){
        $users = User::select('name', 'id')->where('id', '!=', Auth::user()->id)->get();
        return view('pages.index', [
            'users' => $users
        ]);
    }

    public function show(User $user){
        $authUser_id =Auth::user()->id;
        $messages = Message::whereRaw("((from_id = $authUser_id AND to_id = $user->id) OR (from_id = $user->id AND to_id = $authUser_id))")
        ->orderBy('created_at')->get();

        $users = User::select('name', 'id')->where('id', '!=', $authUser_id)->get();
        return view('pages.show', [
            'users' => $users,
            'messages' => $messages,
            'user' => $user
        ]);
    }

    public function store(Request $request) {
        $authUser_id =Auth::user()->id;
        $message = new Message;
        $message->from_id =$authUser_id;
        $message->to_id =  $request->to_id;
        $message->content = $request->content;
        $message->save();
        return redirect("/conversations/$request->to_id");
    }
}
