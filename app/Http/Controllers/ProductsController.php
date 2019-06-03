<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App;

class ProductsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function addProducts(Request $request) {
    	$idBuy = $request->id_buy;
		$idGroup = $request->id_group;
		$productName = $request->productName;
		$productDesc = $request->productDesc;
		$productPrice = $request->productPrice;

		$id_products = App\Products::AddProducts($idBuy, $idGroup, $productName, $productDesc, $productPrice);

        $list = App\Groupe_to_users::get_list_for_groupe($idGroup, Auth::user()->id);

        App\Products_to_users::AddProductsToUsers($id_products, $idGroup, $idBuy, Auth::user()->id, $list);
    }

    public function GetListUsersToProducts(Request $request) {
    	$id_buy = $request->id_buy;
		$id_group = $request->id_group;
		$id_product = $request->id_product;

		$users_list = App\Products_to_users::GetUsersToProducts($id_group, $id_buy, $id_product);

		return $users_list;
    }

    public function getProducts(Request $request) {
    	$id_group = $request->id_group;
    	$id_buy = $request->id_buy;
    	
    	$products_list = App\Products::getProductsForBuy($id_group, $id_buy);
    	return $products_list;
    }

    public function setStatusProd(Request $request) {
    	$id_request = $request->id_request;
    	$status = $request->status;

    	App\Products_to_users::setStatusProd($id_request, $status);
    }
}
