<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App;

class DialogsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getDialog(Request $request) {
    	$id = App\Dialogs::getDialog($request->userID, Auth::user()->id);
    	if($id !== "error")
			return redirect('room/'.$id);
		else
			return redirect('users');
    }
}
