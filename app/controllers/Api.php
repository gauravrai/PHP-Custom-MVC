<?php

class Api extends Controller
{
	private $json;

	private function setJson(){
		header("Content-Type: application/json; charset=UTF-8");
	}
	private function getRawRequest(){
		$this->setJson();
		return json_decode(file_get_contents('php://input'));
	}
	protected function sendResponse(array $body, $status=200){
		header(Helper::getHeaders($status));
		echo json_encode([
			'message' => $body[0],
			'data' => isset($body[1]) ? $body[1] : [],
			'status' => $status
		]);
	}
	public function profile($id=0){
		$this->setJson();
		//if(Helper::isLoggedIn()){
			$user = $this->model('User');
			$result = $user->getUser($id);
			$array = [
				'username' => Helper::decode($result[0]['username']),
				'password' => $result[0]['password'],
				'email' => $result[0]['email'],
				'contact' => $result[0]['contact'],
			];
			$this->sendResponse(["Record Found", $array]);
		//}
	}
	public function login(){
		$request = $this->getRawRequest();
		if($request->username == '' || $request->password == ''){
			$this->sendResponse(["Please fill the required fields"], 500);
		}

		$user = $this->model('User');
		$profile = $user->auth([
			'username' => Helper::encode($request->username),
			'password' => $request->password,
		]);
		
		if(is_array($profile) && count($profile)>0){
			$_SESSION['userLoggedIn'] = $profile[0]['id'];
			$this->sendResponse(["Matched", ['error'=>0]]);
		}
		else{
			$this->sendResponse(["Invalid credentials", ['error'=>1]]);
		}
	}
	
	public function register(){
		$request = $this->getRawRequest();
		
		if($request->username == '' || $request->password == '' || $request->email == ''){
			$this->sendResponse(["Please fill the required fields", ['error'=>1]]);
			exit;
		}
		
		
		$user = $this->model('User');
		$result = $user->create([
			'username' => Helper::encode($request->username),
			'password' => $request->password,
			'email' => $request->email,
			'contact' => $request->contact
		]);

		if(!$result){
			$this->sendResponse(["User already exists", ['error'=>1]]);
		}
		else{
			$_SESSION['userLoggedIn'] = $result;
			$this->sendResponse(["Thank You for registering with us", ['error'=>0]], 201);
		}
	}
}