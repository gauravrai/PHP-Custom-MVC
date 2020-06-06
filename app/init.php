<?php
session_start();
/*
	Initialization starts in this file
	Lets bootstrap
*/
function autoloadCoreClasses($className){
	require_once('core/' . $className . '.php');
}
spl_autoload_register('autoloadCoreClasses');
/*require_once('core/Session.php');
require_once('core/Database.php');
require_once('core/App.php');
require_once('core/Controller.php');*/

$app = new App();
