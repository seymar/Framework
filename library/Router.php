<?php

class Router {
	public $controller = 'index';
	public $action = 'index';
	public $parameters = array();

	public function __construct() {
		if(!isset($_GET['query'])) {
			return true;
		}

		// Resolve query
		$query = $_GET['query'];
		$querySeparated = explode('/', $query);

		// Set controller if available
		if(!$querySeparated[0] OR empty($querySeparated[0])) {
			return true;
		}
		$this->controller = array_shift($querySeparated);

		// Set action if available
		if(!$querySeparated[0] OR empty($querySeparated[0])) {
			return true;
		}
		$this->action = array_shift($querySeparated);

		// Set parameters
		foreach($querySeparated as $parameter) {
			$this->parameters[] = $parameter;
		}

		return true;
	}
}