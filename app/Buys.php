<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class Buys extends Model
{
    static public function addBuy($idGroup, $name) {
    	$buy = new Buys;
    	$buy->id_group = $idGroup;
		$buy->name_buy = $name;
		$buy->save();
    }

    static public function GetBuysForGroup($idGroup) {
    	$buys_list = \DB::table('buys')->select('buys.*',  \DB::raw('1 as ViewProducts'))->where('id_group', $idGroup)->get();

    	return $buys_list;
    }

    static public function GetBuysForGroup_Pay($idGroup) {
        $buys_list = \DB::table('buys')->select('buys.*',  \DB::raw('1 as products'))->where('id_group', $idGroup)->get();

        return $buys_list;
    }
}
