<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class NotAuthController extends Controller
{
    public function searchByEmail(Request $request) {
        $email = $request->email;       

        return App\Users::GetUserByEmail($email);        
    }
}