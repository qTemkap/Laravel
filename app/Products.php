<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    static public function AddProducts($idBuy, $idGroup, $productName, $productDesc, $productPrice) {
    	$product = new Products;
    	$product->id_group = $idGroup;
    	$product->id_buy = $idBuy;
    	$product->name_products = $productName;
    	$product->discription = $productDesc;
    	$product->price = $productPrice;
    	$product->save();

    	return $product->id;
    }

    static public function getProductsForBuy($id_group, $id_buy) {
    	$products_list = \DB::table('products')->where('id_group', $id_group)->where('id_buy', $id_buy)->get();

    	if(!empty($products_list)) {
    		return $products_list;
    	}
    	return false;
    }

    static public function getProductsForBuy_Pay($id_group, $id_buy) {
        $products_list = \DB::table('products')->where('id_group', $id_group)->where('id_buy', $id_buy)->get()->toArray();
        
        if(!empty($products_list)) {
            return $products_list;
        }
        return [];
    }
}