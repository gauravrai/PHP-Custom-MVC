<?php

/*
	Its a class
	Instance of this class is being called in /app/init.php
	This file includes the code for setting up the architecture
*/

class App
{
	protected $controller = 'User';//default controller
	protected $method = 'index';//default method
	protected $params = []; //empty array for params
	
	public function __construct(){
		$url = $this->parseUrl();	
		
		$file_path = $_SERVER['DOCUMENT_ROOT'] . '/../app/controllers/'.ucfirst($url[0]).'.php';
		if(file_exists($file_path) && $url[0]!=''){//if controller file exists
			$this->controller = $url[0];
			unset($url[0]);//remove controller name
		}
		else{
			$file_path = $_SERVER['DOCUMENT_ROOT'] . '/../app/controllers/'.$this->controller.'.php';
		}

		require_once($file_path);

		$this->controller = new $this->controller;//create an object to be passed later in call_user_func_array

		if(isset($url[1])){//if method exists on the controller
			if(method_exists($this->controller, $url[1])){
				$this->method = $url[1];
				unset($url[1]);//remove method name
			}
		}
		//now we have only parameters left with $url
		$this->params = $url ? array_values($url):[];//rebase or empty array

		//call the callable method defined on the controller with paramters as an array, because we dont know how many parameters are there in the array :)
		call_user_func_array([$this->controller, $this->method], $this->params);
	}

	//Parse usrl by exploding and sanitizing, .ie controller, methods and parameters
	public function parseUrl(){
		//GET works because of .htaccess file
		
		if(isset($_GET['url'])){
			//trim this whitespace and if there is forward slash remove that too
			return $url = explode("/", filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
}