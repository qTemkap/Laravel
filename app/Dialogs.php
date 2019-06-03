<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dialogs extends Model
{
    public static function getDialog($idUser, $idAuth) {
        $user_true = \DB::table('users')->where('id',$idUser)->get();
        if(!empty($user_true)) {
            $dialog = \DB::table('dialogs')->where([['user_one',$idUser],['user_two',$idAuth]])->orWhere([['user_two',$idUser],['user_one',$idAuth]])->get();
            // echo "<pre>";
            // print_r($dialog['0']->id);
            // echo "</pre>";

            if(empty($dialog['0'])) {
                $dialog = new Dialogs;
                $dialog->user_one = $idAuth;
                $dialog->user_two = $idUser;   
                $dialog->save();    

                $id = $dialog->id;
                return $id; 
            } else {
                return $dialog['0']->id;    
            }
        } else {
        	return "error";
        }
    }
}