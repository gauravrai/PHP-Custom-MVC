<?php

class User extends Controller
{
	public function index(){
		$this->view('login/index');
	}
	public function register(){
		$this->view('login/register');
	}
	public function logout(){
		session_destroy();
		Helper::redirect('/');
	}
}