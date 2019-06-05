<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Request;
use Redis;

//use LRedis;

class ChatController extends Controller
{
    public function __construct()

	{

		//$this->middleware('guest');

	}

	public function sendMessage($request) {
		//$r = Illuminate\Support\Facades\Redis::connection();

		Redis::publish('test-channel', 'ceci est un tset');

		//Redis::set('name', 'Taylor');

		//return Redis::get('name');
	}
}
