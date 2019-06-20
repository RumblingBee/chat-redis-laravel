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
		$user = $request->input('user', 'Anonyme');
		$channel = $request->input('channel', 'General');
		$message = $request->input('message', 'Message introuvable.');
		
		$badword = file_get_contents('../public/badwords.dic');
		$badwords = explode(PHP_EOL, $badword);
		
		$redis = Redis::connection();
		if (!$redis->exists('badwords')) {
			foreach ($badwords as $b) {
				$redis->rPush('badwords', $b);
			}
		}

		$words = explode(' ', $message);
		foreach ($words as $w) {
			$compteur = 0;
			$count = $redis->lLen('badwords');
			$censure = false;
			while ($compteur < $count && $censure === false) {
				$search = $redis->lindex('badwords', $compteur);
				$w = strtolower($w);
				if ($w === $search) {
					$nbl = strlen($w);
					$replace = str_repeat('*', $nbl);

					//$message = str_ireplace($w, $replace , $message);

					$array_message = explode(" ", $message);

					for($i = 0; $i < count($array_message); $i++){
						if($array_message[$i] === $search){

							$array_message[$i] = $replace;
						}

					}

					$message = implode(" ",$array_message);
					

					$censure = true;
				}
				$compteur++;
			}
		}

		$data = [
			'user' => $user, 
			'channel' => $channel, 
			'message' => $message,
			'date' => date("Y-m-d"),
			'time' => date("H:i:s")   
		];

		$redis->publish('message', json_encode($data));
		return response()->json([]);
	}
}
