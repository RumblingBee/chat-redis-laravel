<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redis;

class ChatController extends Controller
{
    public function __construct()
	{
		//$this->middleware('guest');
	}

	public function sendMessage(Request $request) 
	{
		//Redis::publish('test-channel', $request->input('message', 'Message introuvable.'));
		$redis = Redis::connection();
		$data = ['message' => $request->input('message', 'Message introuvable.'), 'user' => $request->input('user', 'Anonyme')];
		$redis->publish('message', json_encode($data));
		return response()->json([]);
	}
}
