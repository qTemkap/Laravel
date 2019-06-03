<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App;

class BuysController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function addBuy(Request $request) {
    	$id_group = $request->idGroup;
    	$name = $request->nameBuy;
    	App\Buys::addBuy($id_group, $name);
    }

    public function index(Request $request)
    {
    	$id_group = $request->idGroup;
    	$buys = App\Buys::GetBuysForGroup($id_group);
    	return $buys;
    }

    public function SetPayUsers(Request $request) {
        $id_buy = $request->id_buy;
        $id_group = $request->id_group;
        $users_list = $request->users;

        App\Buys_to_users::SetPayUsers($id_buy, $id_group, $users_list);
    }    
}
