<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;

class DebitsController extends Controller
{	
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
    	$id = Auth::user()->id;

    	$credit = App\Debts::getDebtsUserOne($id);
		$debit = App\Debts::getDebtsUserTwo($id);

		return view('debits', compact('debit', 'credit'));
    }

    public function setCredit(Request $request) {
    	$id = Auth::user()->id;
    	$id_request = $request->id_request;
    	$price = $request->price;

    	App\Debts::setCredit($id_request, $price);
    	$credit = App\Debts::getDebtsUserOne($id);
		$debit = App\Debts::getDebtsUserTwo($id);

		$mas = array();
		$mas['credit'] = $credit;
		$mas['debit'] = $debit;

    	return $mas;
    }
}
