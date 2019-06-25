<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

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

       $currentUser = Auth::user();

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

        $currentUser->last_activity = time();
        $currentUser->save();

        return  redirect('profil');
    }

    public function deleteFriend()
    {

       $array = [];
       $currentUser = Auth::user();

       $friendList = $currentUser->friends;

       for($i = 0; $i < sizeof($friendList) ; $i++){
        if($friendList[$i] !== $_POST['userId']){
            array_push($array,$friendList[$i]);
        }
    }

       $currentUser->friends = $array;

       $currentUser->save();

        return  redirect('profil');
    }

    public function getFriendList(){

        $currentUser = Auth::user();
        $array = [];

        if($currentUser->friends !== null){
            for($i = 0; $i < sizeof($currentUser->friends); $i++){

                $friend = User::find($currentUser->friends[$i]);
                $attributes[$i]["id"] = $friend->id;
                $attributes[$i]["name"] = $friend->name;

                if($friend->last_activity !== NULL){
                    $attributes[$i]["last_activity"] = $friend->last_activity;
                }
            }
            array_push($array, $attributes);


        }

        return $array;

    }
}
