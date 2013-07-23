<?php 

/**
 * Dispatch
 */
if(!isset($_GET['controller'])) {
	$controllerName = 'index';
} else {
	$controllerName = $_GET['controller'];
}

$controllerName = ucfirst($controllerName) . 'Controller';

require_once 'application/Controller/Controller.php';
require_once 'application/Controller/' . $controllerName . '.php';

$controller = new $controllerName;

//Action
$controller->action = 'index';

$controller->execute();

?>