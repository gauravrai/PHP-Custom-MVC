<?php

/*
	This file is going to load models and  render views i.e handling them
*/
class Controller 
{
	protected function model($model){
		require_once ('../app/models/' . $model . '.php');
		return new $model();
	}

	protected function view($view, $data=[]){
		//data will be automatically be available for the view file included
		require_once('../app/views/' . $view . '.php');
	}
}