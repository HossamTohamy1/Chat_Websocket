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

    public function groupPage()
    {
        $groups = session()->get('groups', []);
        return view('group', compact('groups'));
    }

    public function createGroup(Request $request)
    {
        $request->validate([
            'group_name' => 'required|string|max:255',
        ]);

        $groups = session()->get('groups', []);

        $groups[] = $request->group_name;

        session(['groups' => $groups]);

        return redirect()->route('group.page')->with('success', 'Group created successfully!');
    }

}
