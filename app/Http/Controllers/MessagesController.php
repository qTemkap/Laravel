<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;

class MessagesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function GetMessages($room) {
    	$id_twoUser = App\Messages::getTwoUser($room, Auth::user()->id);

    	$messages = App\Messages::getMessagesList($room);

    	if(!empty($id_twoUser))
    		return view('room', compact('room','id_twoUser','messages'));
    	else
			return redirect('users');
    }

    public function sendMessage(Request $request) {
        App\Messages::setMessage($request->room_id, $request->user, $request->body);
    	App\Events\PrivateChat::dispatch($request->all());
    }
}
