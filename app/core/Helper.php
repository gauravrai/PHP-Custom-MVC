<?php

class Helper
{
	public static function isLoggedIn(){
		if(!isset($_SESSION['userLoggedIn']))
			return false;

		return true;
	}
	public static function redirect($path='/'){
		header('Location: ' . $path);
		exit;
	}
	public static function redirecIfNotLoggedIn(){
		if(!self::isLoggedIn()){
			self::redirect('/user/login');
		}
	}
	public static function getHeaders($status){
		if($status==200){
			return 'HTTP/1.1 200 OK';
		}
		elseif($status==201){
			return 'HTTP/1.1 201 Created';
		}
		elseif($status==404){
			return 'HTTP/1.1 404 Not Found';
		}
		else{
			return 'HTTP/1.1 500 Error';
		}
	}
	private static function generator($no){
		for($i=97;$i<123;$i++)
			$alphabets[] =chr($i);
		return $new_string=array_merge(array_slice($alphabets, $no, NULL, true), array_slice($alphabets, 0, $no, true));
	}
	public static function encode($str){
		$str=trim($str);
		$no = strlen($str);
		$new_string = self::generator($no);

		//Encryption
		$encrypted_string='';
		for($j=0;$j<$no;$j++){
			$current_key = array_search($str[$j],$new_string);
			
			$next_key = $current_key+$no;
			if($next_key>25){//25 in crrent case
				$next_key = $next_key - 26;
			}
			
			$encrypted_string .= $new_string[$next_key];
		}

		return $encrypted_string;
	}
	public static function decode($str){
		$str=trim($str);
		$no = strlen($str);
		$new_string = self::generator($no);

		//Decryption
		$decrypted_string = '';
		for($j=0;$j<$no;$j++){
			$current_key = array_search($str[$j],$new_string);
			
			$prev_key = $current_key-$no;
			if($prev_key<0){
				$prev_key = $prev_key + 26;
			}
			$decrypted_string .= $new_string[$prev_key];
		}
		return $decrypted_string;
		
	}
}