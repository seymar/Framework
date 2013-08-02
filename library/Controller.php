<?php

class Controller {
	public $name;
	public $action;

	public $variables = array();
	
	public function __construct() {
		$this->name = str_replace('Controller', '', get_class($this));

		return $this;
	}

	public function beforeFilter() {}

	/**
	 * Sets a variable that will be available in the view
	 */
	public function set($variableName, $value) {
		$this->variables[$variableName] = $value;

		return true;
	}
	
	/**
	 * Create a new view and render it
	 */
	public function render($templateName = null) {
		// Include class View
		require_once 'library/View.php'
		require_once 'application/View/BaseView.php';

		// Use action name as default template name
		if(is_null($templateName)) {
			$templateName = $this->action;
		}


		$view = new View($this->name, $templateName);
		
		$view->render($this->variables);
		
		return true;
	}
	
	public function execute() {
		$this->beforeFilter();

		$this->{$this->action}();
		
		return true;
	}
}