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
        session(['username' => $username]);


            return view('chat')->with('username', $username);   
         }

    public function broadcastChat( Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',       
            'msg' => 'required|string|max:255',  
            'groupName' => 'nullable|string|max:255', 

        ]);
       event(new chat($request->username, $request->msg , $request->groupName));
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

        return redirect()->route('group.page', ['group' => $request->group_name])
                ->with('success', 'Group created and redirected!');

            
    }

     public function groupChatPage($groupName)
  {
            $groups = session()->get('groups', []);
            
            if (!in_array($groupName, $groups)) {
                abort(403, 'Access denied. This group does not exist.');
            }

            $username = session('username');
            if (!$username) {
                return redirect()->route('user.login')->with('error', 'Please login first.');
            }

            return view('group-chat', compact('groupName','username'));
        }


}
