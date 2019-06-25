<?php

namespace App\Http\Controllers;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentUser = Auth::user();
        $currentUser->last_activity = time();
        $currentUser->save();

        return view('home');
    }

    public function showProfilPage()
    {
        $currentUser = Auth::user();
        $currentUser->last_activity = time();
        $currentUser->save();

        return view('profil');
    }
}
