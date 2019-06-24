<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        $currentUserList = \App\User::all();


        return $currentUserList;
    }

    public function updateUser(){


    }

    public function renderUpdateUserPage(){

        $currentUser = Auth::user();

        return view('auth.update',['name' => $currentUser->name, 'email' => $currentUser->email, 'country' => $currentUser->country, 'language' => $currentUser->language, 'complete_name' => $currentUser->complete_name,'facebook_account' => $currentUser->facebook_account,'birth_date' => $currentUser->birth_date]);

    }
    public function updateProfil(){

        $currentUser = Auth::user();

        $currentUser->name = $_POST['name'];
        $currentUser->email = $_POST['email'];
        $currentUser->country = $_POST['country'];
        $currentUser->language = $_POST['language'];


        if( $_POST['complete_name'] !== NULL){

            $currentUser->complete_name =  $_POST['complete_name'];
        }

        if( $_POST['facebook_account'] !== NULL){

            $currentUser->facebook_account =  $_POST['facebook_account'];
        }

        if( $_POST['birth_date'] !== NULL){

            $currentUser->birth_date =  $_POST['birth_date'];
        }

        $currentUser->save();

        return view('profil');

    }


}
