<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    public static function getTwoUser($idDialog, $idAuth) {
    	$dialog = \DB::table('dialogs')->where('id', $idDialog)->get();

    	// echo "<pre>";
    	// print_r($dialog);
    	// echo "</pre>";
        if(!empty($dialog['0'])) {
        	if($dialog['0']->user_one == $idAuth) {
        		return $dialog['0']->user_two;
        	} else {
      			return $dialog['0']->user_one;  		
        	}
        } else {
            return "";
        }
    }

    public static function getMessagesList($idDialog) {
        $messages_list = \DB::table('messages')->where('idDialog', $idDialog)->get();

        return $messages_list;
    }

    public static function setMessage($id_room, $id_user, $message) {
        // \Log::error($message);
        $messages = new Messages;
        $messages->idDialog = (int)$id_room;
        $messages->idUser = (int)$id_user;   
        $messages->message = (string)$message;   
        $messages->save();    

        return "1";
    }
}
