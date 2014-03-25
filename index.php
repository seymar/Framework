<?php

// Include config
require_once './config.php';

// Client root directory
define('CR', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

// Router
require_once 'library/Router.php';

$route = new Router();

// Initialize functions
require_once 'library/functions/pluralize.php';
require_once 'library/functions/loadModel.php';
require_once 'library/functions/__.php';
require_once 'library/functions/ago.php';

// Intialize controller
$controllerClassName = ucfirst($route->controller) . 'Controller';

require_once 'library/Controller/Controller.php';
require_once 'application/Controller/BaseController.php';
require_once 'application/Controller/' . $controllerClassName . '.php';

$controller = new $controllerClassName();

//Action
$controller->setAction($route->action);

$controller->execute($route->parameters);

?>