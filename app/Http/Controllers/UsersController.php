<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function GetUsers() {
    	$users = App\Users::GetUsers(Auth::user()->id);
        return view('users', compact('users'));
    }

    public function GetAllUsers() {
    	$users = App\Users::GetUsers(Auth::user()->id);
    	return view('search', compact('users'));
    }

    public function GetUsersForSearch(Request $request) {
    	$name = $request->name;
        return App\Users::GetUsersForName($name, Auth::user()->id);
    }

    public function AddFriends(Request $request) {
        $id = Auth::user()->id;
        $idFriend = $request->id;
        return App\Friends::addFriend($id, $idFriend);
    }

    public function deleteRequest(Request $request) {
        $id = Auth::user()->id;
        $idFriend = $request->id;
        App\Friends::deleteRequest($id, $idFriend);
    }

    public function DeleteFriend(Request $request) {
        $id = Auth::user()->id;
        $idFriend = $request->id;
        App\Friends::deleteFriend($id, $idFriend);
    }

}
