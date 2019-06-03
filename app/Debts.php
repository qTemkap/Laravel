<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debts extends Model
{
    static public function AddDebt($user_one, $user_two, $id_group, $price) {
    	$result = \DB::::table('debts')->select('id')->where('user_one',$user_one)->where('user_two',$user_two)->where('id_group',$id_group)->get()->toArray();

    	if(!empty($result->id)) {
    		\DB::table('products_to_users')->where('id', $result->id)->update(['debit' => $price]);
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
}
