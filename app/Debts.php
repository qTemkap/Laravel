<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class Debts extends Model
{
    static public function AddDebt($user_one, $user_two, $id_group, $price) {
    	$result = \DB::table('debts')->select('id')->where('user_one',$user_one)->where('user_two',$user_two)->where('id_group',$id_group)->get()->toArray();

    	if(!empty($result['0']->id)) {
    		\DB::table('debts')->where('id', $result['0']->id)->update(['debit' => $price]);
    	} else {
    		$debt = new Debts;
    		$debt->user_one = $user_one;
    		$debt->user_two = $user_two;
    		$debt->id_group = $id_group;
    		$debt->debit = $price;
    		$debt->credit = 0;
    		$debt->status = 1;

    		$debt->save();
    	}
    }

    static public function getDebtsForGroup($id_group) {
    	$result = \DB::table('debts')->select('debts.id', 'debts.debit', 'u1.name as name1', 'u2.name as name2')->where('id_group',$id_group)->leftJoin('users as u1', 'debts.user_one', '=', 'u1.id')->leftJoin('users as u2', 'debts.user_two', '=', 'u2.id')->get();

        return $result;
    }

    static public function getDebtsUserOne($id_user) {
        $result = \DB::table('debts')->select('debts.id', 'debts.debit', 'debts.id_group', 'debts.status', 'debts.credit', 'u2.name as name')->where('user_one', $id_user)->leftJoin('users as u2', 'debts.user_two', '=', 'u2.id')->get();

        return $result;
    }

    static public function getDebtsUserTwo($id_user) {
        $result = \DB::table('debts')->select('debts.id', 'debts.debit', 'debts.id_group', 'debts.status', 'debts.credit', 'u1.name as name')->where('user_two', $id_user)->leftJoin('users as u1', 'debts.user_one', '=', 'u1.id')->get();

        return $result;
    }

    static public function setCredit($id_request, $price) {        
        \DB::table('debts')->where('id', $id_request)->update(['credit' => $price]);
    }
}
