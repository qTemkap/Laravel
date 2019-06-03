<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;
use Log;

class GroupsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $id = Auth::user()->id;
        
    	$groups_list = App\Groups::GetAllGroups($id);

    	// var_export($groups_list);
    	return view('groups', compact('groups_list'));
    }

    public function create() {
    	return view('groups_create');
    }

    public function add(Request $request) {
    	$name = $request->name;
    	$description = $request->description;
        $date = $request->date;

    	$id = App\Groups::AddGroup(Auth::user()->id, $name, $description, $date);

    	if(!empty($id)) {
            App\Groupe_to_users::AddToGroupe($id, Auth::user()->id);
    		return redirect('/groups');
    	} else {
    		return redirect('/groups_create');
    	}
    }

    public function view($group) {
        $group = App\Groups::GetOneGroup($group);
        return  view('group', compact('group'));
    }

    public function add_to_groupe(Request $request) {
        $userId = $request->idUser;
        $groupe = $request->idGroup;
        App\Groupe_to_users::AddToGroupe($groupe, $userId);
    }

    public function del_to_groupe(Request $request) {
        $id_request = $request->id_request;
        App\Groupe_to_users::DelToGroupe($id_request);
    }

    public function get_list_for_groupe(Request $request) {
        $groupe = $request->idGroup;
        $list = App\Groupe_to_users::get_list_for_groupe($groupe, Auth::user()->id);
        return $list;
    }

    public function get_alllist_for_groupe(Request $request) {
        $groupe = $request->idGroup;
        $id_buy = $request->id_buy;

        $list['users'] = App\Groupe_to_users::get_alllist_for_groupe($groupe, $id_buy);
        $prices = App\Buys_to_users::GetPayUsers($id_buy, $groupe);

        $list['price'] = array();
        foreach ($prices as $key => $price) {
            array_push($list['price'], $price);
        }

        return $list;
    }

    public function setPay(Request $request) {
        $id_group = $request->id_group;
        $buys = App\Buys::GetBuysForGroup_Pay($id_group);

        foreach ($buys as $key => $buy) {
            $products = App\Products::getProductsForBuy_Pay($id_group, $buy->id);

            $buys[$key]->products = array();
            foreach ($products as $keyp => $product) {       
                array_push($buys[$key]->products, $product);
            }            
        }

        $users = App\Users::GetUsersId();
        $pay_users = array();

        foreach ($users as $key => $user) {
            $users[$key]->buys = array();
            $buys_list = App\Buys_to_users::getBuysToUser($user->id, $id_group);
            foreach ($buys_list as $keyb => $buy) {
                
                if(isset($pay_users[$user->id])) {
                    $pay_users[$user->id] = $pay_users[$user->id] + $buy->price;
                } else {                    
                    $pay_users[$user->id] = $buy->price;
                }
                $buy->products = array();
                
                $products = App\Products_to_users::GetProductsToUser($user->id, $id_group, $buy->id_buys);
                foreach ($products as $keyp => $product) {
                    array_push($buy->products, $product);
                }
                array_push($users[$key]->buys, $buy);
            }
        }

        $count_user_to_products = array();
        $partPrices = array();

        foreach($buys as $keyb => $buy) {
            foreach($buy->products as $keyp => $product) {
                $count_user_to_products[$product->id]['users'] = array();
                $count_user_to_products[$product->id]['count'] = 0;
                foreach ($users as $keyu => $user) {
                    foreach ($user->buys as $keyub => $ubuy) {                             
                        foreach ($ubuy->products as $keyup => $uproduct) {
                            if($uproduct->id_products == $product->id && $uproduct->status == 1) {   
                                $count_user_to_products[$product->id]['count']+=1;
                                array_push($count_user_to_products[$product->id]['users'], array($user->id, $ubuy->price));
                            }
                        }                        
                    }
                }

                $partPrices[$product->id] = $product->price / $count_user_to_products[$product->id]['count'];
            }
        }
              
        $user_price_last = array();

        foreach ($partPrices as $key => $partPrice) {
            foreach($count_user_to_products[$key]['users'] as $keyu => $user) {
                $pay_users[$user['0']] = $pay_users[$user['0']] - $partPrice;
            }
        }

        ksort($pay_users);

        foreach ($pay_users as $key => $pay_user) {
            if($pay_user > 0) {
                $pluss[$key] = $pay_user;
            } else {
                $minuss[$key] = $pay_user;
            }
        }

        $debt = array();

        foreach ($minuss as $keym => $minus) {
            foreach ($pluss as $keyp => $plus) {                
                if($minus != 0 && $pluss[$keyp] != 0) {
                    $tmp = $minus + $plus;                
                    if($tmp < 0) {
                        $minus = $tmp;
                        $tmp_array = array($keym.",".$keyp,$plus);
                        array_push($debt, $tmp_array);
                    } elseif($tmp == 0){
                        $tmp_array = array($keym.",".$keyp,$plus);
                        array_push($debt, $tmp_array);
                        $minus = 0;
                        $pluss[$keyp] = 0;
                    } else {
                        $pluss[$keyp] = $tmp;                        
                        $tmp_array = array($keym.",".$keyp,abs($minus));
                        array_push($debt, $tmp_array); 
                        $minus = 0;
                    }
                }
            }
        }   

        foreach ($debt as $key => $item) {
            $users = explode(',', $item['0']);
            App\Debts::AddDebt($users['0'], $users['1'], $id_group, $item['1']);
        }
    }
}
