<?php

/**
 * Router
 */
require_once 'library/Router.php';

$route = new Router();

/**
 * Dispatch
 */
$controllerClassName = ucfirst($route->controller) . 'Controller';

require_once 'application/Controller/Controller.php';
require_once 'application/Controller/' . $controllerClassName . '.php';

$controller = new $controllerClassName();

//Action
$controller->action = $route->action;

$controller->execute($route->parameters);

?>