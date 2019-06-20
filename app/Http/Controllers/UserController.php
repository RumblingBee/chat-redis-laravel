<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function listUsers()
    {
        $userList = \App\User::all();


        return $userList;
    }
    public function deleteAccount(){
        $user = \Auth::user();
        $user->forceDelete();
        return redirect()->route('home');
    }
}

