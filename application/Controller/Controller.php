<?php

class Controller {
	public $name;
	public $action;
	
	public $View;
	
	public function __construct() {
		$this->name = str_replace('Controller', '', get_class($this));
		
		/**
		 * Initialize new View
		 */
		require_once 'application/View/View.php';
		$this->View = new View($this->name);
	}
	
	public function render($viewName = null) {
		if(is_null($viewName)) {
			$this->View->name = $this->action;
		}
		
		$this->View->render();
		
		return true;
	}
	
	public function execute() {
		$this->{$this->action}();
		
		return true;
	}
}