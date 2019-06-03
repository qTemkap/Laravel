<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;

class FriendsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
    	$id = Auth::user()->id;
    	$friends = App\Friends::GetListFriends($id);
        return view('friends', compact('friends'));
    }

    public function request_out() {
    	$id = Auth::user()->id;
    	$friends = App\Friends::GetRequestOut($id);
        return $friends;
    }

    public function friends_list() {
        $id = Auth::user()->id;
        $friends = App\Friends::GetListFriends($id);
        return $friends;
    }

    public function get_friends_list_for_groupe(Request $request) {
    	$id = Auth::user()->id;
        $idGroupe = $request->idGroup;
    	$friends = App\Friends::GetListFriends_for_groupe($id, $idGroupe);
    	return $friends;
    }

    public function request_in() {
    	$id = Auth::user()->id;
    	$friends = App\Friends::GetRequestIn($id);
        return $friends;
    }

    public function acceptFriend(Request $request) {
        $id_request = $request->id_request;
        App\Friends::acceptFriend($id_request);
    }
}



