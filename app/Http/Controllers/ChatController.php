<?php

namespace App\Http\Controllers;
use App\Events\chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function NotFound()
    {
         abort(404, 'Page Not Found');
    }

     public function chat(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',           
        ]);
        $username = $request->username;

            return view('chat')->with('username', $username);   
         }

    public function broadcastChat( Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',       
            'msg' => 'required|string|max:255',  
        ]);
       event(new chat($request->username, $request->msg));
        return response()->json($request->all());
    }

}
