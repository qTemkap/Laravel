<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class Friends extends Model
{
    public static function addFriend($idUser, $idFriend) {
		$friend = new Friends;
		$friend->friend_one = $idUser;
		$friend->friend_two = $idFriend;   
		$friend->status = "1";   
		$friend->save(); 	

		return $friend->id;
	}

	public static function deleteRequest($idUser, $idFriend) {
		$qwe = \DB::table('friends')->where([['friend_one',$idUser],['friend_two',$idFriend]])->orWhere([['friend_two',$idUser],['friend_one',$idFriend]])->delete();
		return true;
	}

	public static function deleteFriend($idUser, $idFriend) {
		$qwe = \DB::table('friends')->where([['friend_one',$idUser],['friend_two',$idFriend]])->orWhere([['friend_two',$idUser],['friend_one',$idFriend]])->update(['status' => 1]);
		return true;
	}

	public static function GetListFriends($idUser) {
		$friends_list1 = \DB::table('friends')->select('friends.id as id_request','friends.friend_one','friends.friend_two', 'users.id', 'users.name', \DB::raw('1 as status_in_groupe'))->where('friend_one', '=', $idUser)->where('status', '=', '2')->leftJoin('users', 'friends.friend_two', '=', 'users.id');
		$friends = \DB::table('friends')->select('friends.id as id_request','friends.friend_one','friends.friend_two', 'users.id', 'users.name', \DB::raw('1 as status_in_groupe'))->where('friend_two', '=', $idUser)->where('status', '=', '2')->leftJoin('users', 'friends.friend_one', '=', 'users.id')->union($friends_list1)->get();

		return $friends;
	}

	public static function GetListFriends_for_groupe($idUser, $idGroupe) {
		$friends_list1 = \DB::table('friends')->select('friends.id as id_request','friends.friend_one','friends.friend_two', 'users.id', 'users.name', \DB::raw('1 as status_in_groupe'))->where('friend_one', '=', $idUser)->where('status', '=', '2')->whereNull('groupe_to_users.id_user')->leftJoin('users', 'friends.friend_two', '=', 'users.id')->leftJoin('groupe_to_users', function($leftJoin)use($idGroupe)
	        {
	            $leftJoin->on([['friends.friend_two', '=', 'groupe_to_users.id_user'],['groupe_to_users.id_groupe', '=', \DB::raw("'".$idGroupe."'")]]);
	        });

		$friends = \DB::table('friends')->select('friends.id as id_request','friends.friend_one','friends.friend_two', 'users.id', 'users.name', \DB::raw('1 as status_in_groupe'))->where('friend_two', '=', $idUser)->where('status', '=', '2')->whereNull('groupe_to_users.id_user')->leftJoin('users', 'friends.friend_one', '=', 'users.id')->leftJoin('groupe_to_users', function($leftJoin)use($idGroupe)
	        {
	            $leftJoin->on([['friends.friend_one', '=', 'groupe_to_users.id_user'],['groupe_to_users.id_groupe', '=', \DB::raw("'".$idGroupe."'")]]);
	        })->union($friends_list1)->get();

		return $friends;
	}

	public static function GetRequestOut($idUser) {
		$friends = \DB::table('friends')->select('friends.id as id_request','friends.friend_one','friends.friend_two', 'users.id', 'users.name')->where('friend_one', '=', $idUser)->where('status', '=', '1')->leftJoin('users', 'friends.friend_two', '=', 'users.id')->get();

		return $friends;
	}

	public static function GetRequestIn($idUser) {
		$friends = \DB::table('friends')->select('friends.id as id_request','friends.friend_one','friends.friend_two', 'users.id', 'users.name')->where('friend_two', '=', $idUser)->where('status', '=', '1')->leftJoin('users', 'friends.friend_one', '=', 'users.id')->get();

		return $friends;
	}

	public static function acceptFriend($id_request) {
		$qwe = \DB::table('friends')->where('id', '=', $id_request)->update(['status' => 2]);;
		return true;
	}
}
