<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{

	static public function AddGroup($id_creater, $name, $description, $date) {
		$group = new Groups;
		$group->name_group = $name;
		$group->descripton = $description;   
		$group->intDateHappen = $date;   
		$group->id_creater = $id_creater;   
		$group->save(); 	

		$id = $group->id;
		return $id;	
	}

	static public function GetAllGroups($id) {
		$groups = \DB::table('groupe_to_users')->select('groups.*')->where('id_user',$id)->leftJoin('groups','groupe_to_users.id_groupe', '=', 'groups.id')->get();
		return $groups;
	}

	static public function GetOneGroup($id) {
		$group = Groups::find($id);
		return $group;
	}
    
}
