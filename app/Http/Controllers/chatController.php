<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Request;

use LRedis;

class ChatController extends Controller
{
    public function __construct()

	{

		$this->middleware('guest');

	}

	public function sendMessage(){

		$redis = LRedis::connection();

		$data = ['message' => 'test', 'user' => Request::input('user')];

		$redis->publish('message', json_encode($data));

		return response()->json([]);

	}
}
