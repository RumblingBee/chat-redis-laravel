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
		$redis = Redis::connection();
		$data = [
			'user' => $request->input('user', 'Anonyme'), 
			'channel' => $request->input('channel', 'General'), 
			'message' => $request->input('message', 'Message introuvable.'),
			'date' => date("Y-m-d"),
			'time' => date("H:i:s")   
		];
		$redis->publish('message', json_encode($data));
		return response()->json([]);
	}
}
