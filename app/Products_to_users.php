<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class Products_to_users extends Model
{
    public static function AddProductsToUsers($id_products, $id_group, $id_buys, $authUser, $users_list = array()) {

    	$products_to_users = new Products_to_users;
		$products_to_users->id_products = $id_products;
		$products_to_users->id_group = $id_group;
		$products_to_users->id_buys = $id_buys;
		$products_to_users->id_users = $authUser;
		$products_to_users->status = 1;

		$products_to_users->save();

    	foreach ($users_list as $key=>$user) {
    		$products_to_users = new Products_to_users;
    		$products_to_users->id_products = $id_products;
    		$products_to_users->id_group = $id_group;
    		$products_to_users->id_buys = $id_buys;
    		$products_to_users->id_users = $user->id;
    		$products_to_users->status = 1;

    		$products_to_users->save();
    		//Log::error($user->id);
    	}    	
    }

    public static function GetUsersToProducts($id_group, $id_buy, $id_product) {
    	$list = \DB::table('products_to_users')->select('products_to_users.id as id_products_to_users', 'products_to_users.id_group', 'products_to_users.id_products', 'products_to_users.id_buys', 'products_to_users.id_users', 'products_to_users.status', 'users.id', 'users.name')->where('id_group', '=', $id_group)->where('id_buys', '=', $id_buy)->where('id_products', '=', $id_product)->leftJoin('users', 'products_to_users.id_users', '=', 'users.id')->get();

		return $list;		
	}

	public static function setStatusProd($id_request, $status) {
		$qwe = \DB::table('products_to_users')->where('id', $id_request)->update(['status' => $status]);
	}

    public static function GetProductsToUser($user_id, $id_group, $id_buy) {
        $list = \DB::table('products_to_users')->where('id_group', $id_group)->where('id_buys', $id_buy)->where('id_users', $user_id)->get()->toArray();

        return $list;
    }
}
