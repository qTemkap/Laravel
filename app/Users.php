<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
	public static function GetUsers($id) {
	    $users = \DB::table('users')->select('users.id','users.name','friends.status')->where('users.id', '<>', $id)->leftJoin('friends', function($leftJoin)use($id)
        {
            $leftJoin->on([['friends.friend_one', '=', 'users.id'],['friends.friend_two', '=', \DB::raw("'".$id."'")]])
            		 ->orOn([['friends.friend_two', '=', 'users.id'],['friends.friend_one', '=', \DB::raw("'".$id."'")]]);
        })->get();
	    return $users;
	}

	public static function GetUsersForName($name, $id) {
		$users = \DB::table('users')->where('name', 'like', '%'.$name.'%')->where('users.id', '<>', $id)->leftJoin('friends', function($leftJoin)use($id)
        {
            $leftJoin->on([['friends.friend_one', '=', 'users.id'],['friends.friend_two', '=', \DB::raw("'".$id."'")]])
            		 ->orOn([['friends.friend_two', '=', 'users.id'],['friends.friend_one', '=', \DB::raw("'".$id."'")]]);
        })->get();
		return $users;
	}

	public static function GetUserByEmail($email) {
		$users = \DB::table('users')->where('email', 'like', '%'.$email.'%')->get();
		
		return $users;
	}

	public static function GetUsersId() {
		$users = \DB::table('users')->select('id', \DB::raw('1 as buys'))->get()->toArray();
		
		return $users;
	}

}
