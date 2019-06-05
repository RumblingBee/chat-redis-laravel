<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function addFriend()
    {
        $currentUser = \App\User::find($_POST['user_id']);

        if($currentUser->friends !== null){

            $array = $currentUser->friends;
            array_push($array, $_POST['friendId']);
            $currentUser->friends = $array;
        }
        else{

            $array = [];
            $array[0] = $_POST['friendId'];
            $currentUser->friends =  $array;
        }

        $currentUser->save();

        return view('profil');
    }
}
