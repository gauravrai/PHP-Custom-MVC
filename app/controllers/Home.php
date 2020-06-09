<?php
/*
	This is the default controller
*/
class Home extends Controller 
{
	protected $user;

	public function __construct(){
		Helper::redirecIfNotLoggedIn();
		$this->user = $this->model('User');
	}
	//default controller
	public function index($name=''){

		$data['user'] = $this->user->getUser();
		$this->view('home/index', $data);
	}
}
