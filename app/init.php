<?php
session_start();
/*
	Initialization starts in this file
	Lets bootstrap
*/
function autoloadCoreClasses($className){
	require_once($_SERVER['DOCUMENT_ROOT'] . '/../app/core/' . $className . '.php');
}
spl_autoload_register('autoloadCoreClasses');

$app = new App();
