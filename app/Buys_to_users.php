<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class Buys_to_users extends Model
{
    static public function SetPayUsers($id_buy, $id_group, $users_list) {
        Log::error($users_list);
    	foreach ($users_list as $key => $user_pay) {
            if($key != 0) {
                $res = \DB::table('buys_to_users')->select('id')->where('id_group', '=', $id_group)->where('id_buys', '=', $id_buy)->where('id_users', $key)->get()->toArray();

                if(empty($res[0]->id)) {
                    $user = new Buys_to_users();

                    $user->id_group = $id_group;
                    $user->id_buys = $id_buy;
                    $user->id_users = $key;
                    $user->price = $user_pay;

                    $user->save();
                } else {
                    if(empty($user_pay)) {
                        $user_pay = 0;
                    }
                    \DB::table('buys_to_users')->where('id', $res[0]->id)->update(['price' => $user_pay]);
                }        		
            }
    	}
    }

    static public function GetPayUsers($id_buy, $id_group) {
    	$list = \DB::table('buys_to_users')->select('price')->where('id_group', '=', $id_group)->where('id_buys', '=', $id_buy)->orderBy('id_users', 'desc')->get();

        
        return $list;
    }

    static public function getBuysToUser($id_user, $id_group) {
        $list = \DB::table('buys_to_users')->select('buys_to_users.*', \DB::raw('1 as products'))->where('id_group', $id_group)->where('id_users', $id_user)->get()->toArray();

        return $list;
    }
}
