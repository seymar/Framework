<?php

error_reporting(E_ALL);

/**
 * Router
 */
require_once 'library/Router.php';

$route = new Router();

/**
 * Dispatch
 */
$controllerClassName = ucfirst($route->controller) . 'Controller';

require_once 'library/Controller/Controller.php';
require_once 'application/Controller/BaseController.php';
require_once 'application/Controller/' . $controllerClassName . '.php';

$controller = new $controllerClassName();

//Action
$controller->setAction($route->action);

$controller->execute($route->parameters);

?>