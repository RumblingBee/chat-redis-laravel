<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FriendsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if ($currentUser = Auth::user()) {
            $currentUser->last_activity = time();
            $currentUser->save();

            $friends = new FriendsController();
            return view('home', ['friends' => $friends->getFriendList()]);
        }
        return view('home', ['friends' => ['general']]);
    }

    public function showProfilPage()
    {
        if ($currentUser = Auth::user()) {
            $currentUser->last_activity = time();
            $currentUser->save();
        }

        return view('profil');
    }
}
