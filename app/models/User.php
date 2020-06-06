<?php

class User extends Database
{
	private $model_table = 'users';
	

	public function __construct(){
		parent::__construct();
		$this->table = $this->model_table;
	}
	public function getUser($id=0){
		$id = ($id==0) ? $_SESSION['userLoggedIn'] : $id;
		return $this->find([
			'id' => $id
		]);
	}
	public function auth($request){
		return $this->find([
			'username' => $request['username'],
			'password' => $request['password']
		]);
	}
	public function create($request){
		$data = $this->find(['username'=>$request['username']]);
		
		if(count($data)){
			return false;
		}

		return $this->insert([
				'username'=>$request['username'], 
				"email"=>$request['email'],
				"password"=>$request['password'],
				"contact"=>$request['contact'],
			]);
		
	}
}