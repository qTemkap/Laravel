<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupe_to_users extends Model
{
    static public function AddToGroupe($groupe, $userId) {
		$groupe_to_user = new Groupe_to_users; 
		$groupe_to_user->id_groupe = $groupe;   
		$groupe_to_user->id_user = $userId;   
		$groupe_to_user->save();
	}

	static public function get_list_for_groupe($groupeId, $authID) {
		$list = \DB::table('groupe_to_users')->select('groupe_to_users.id as id_groupe_to_users', 'users.id', 'users.name')->where('id_groupe', '=', $groupeId)->where('users.id', '!=', $authID)->leftJoin('users', 'groupe_to_users.id_user', '=', 'users.id')->get();

		return $list;
	}

	static public function get_alllist_for_groupe($groupeId, $id_buy) {
		$list = \DB::table('groupe_to_users')->select('groupe_to_users.id as id_groupe_to_users', 'users.id', 'users.name', 'buys_to_users.price')->where('groupe_to_users.id_groupe', '=', $groupeId)->leftJoin('users', 'groupe_to_users.id_user', '=', 'users.id')->leftJoin('buys_to_users', function($leftJoin)use($groupeId, $id_buy)
	        {
	            $leftJoin->on([['users.id', '=', 'buys_to_users.id_users'],['buys_to_users.id_group', '=', \DB::raw("'".$groupeId."'")], ['buys_to_users.id_buys', '=', \DB::raw("'".$id_buy."'")]]);
	        })->orderBy('groupe_to_users.id_user', 'desc')->get();

		return $list;
	}

	static public function DelToGroupe($id_request) {
		$qwe = \DB::table('groupe_to_users')->where('id','=',$id_request)->delete();
	}
}
