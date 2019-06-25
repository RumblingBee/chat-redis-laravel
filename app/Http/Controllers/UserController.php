<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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


    public function updateAvatar(Request $request){

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);



        $user = Auth::user();

        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();


        $image = $request->avatar;


        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(120, 120);
        $image_resize->save(public_path('/storage/avatars/' .$avatarName));

        $user->avatar = $avatarName;
        $user->save();

        return back()
            ->with('success','You have successfully upload image.');

        }

    public function deleteAccount(){
        $user = \Auth::user();
        $user->forceDelete();
        return redirect()->route('home');
    }
}

