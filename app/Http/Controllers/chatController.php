<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Redis;

class ChatController extends Controller
{
    public function __construct()
	{
		//$this->middleware('guest');
	}

	public function sendMessage(Request $request)
	{
        $currentUser = Auth::user();
        $currentUser->last_activity = time();
        $currentUser->save();

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
