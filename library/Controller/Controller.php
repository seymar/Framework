<?php

class Controller {
	private $name;
	private $action;

	public $components = array();

	// Models the controller uses
	public $uses = array();

	public $variables = array();
	
	public function __construct() {
		$this->name = str_replace('Controller', '', get_class($this));

		$this->initializeComponents();

		$this->initializeModels();

		return $this;
	}

	/**
	 * Loads all components given in $this->components
	 */
	protected function initializeComponents() {
		foreach($this->components as $component) {
			$componentClassName = $component . 'Component';

			require_once 'library/Controller/Component.php';
			require_once 'library/Controller/Component/' . $componentClassName . '.php';

			// Set variable for component
			$this->$component = new $componentClassName();
		}
	}

	/**
	 * Loads all models given in $this->uses
	 */
	protected function initializeModels() {
		foreach($this->uses as $modelName) {
			require_once 'library/Database.php';
			require_once 'library/Model/Model.php';
			require_once 'application/Model/BaseModel.php';
			require_once 'application/Model/' . $modelName . '.php';

			// Set variable for model
			$this->$modelName = new $modelName();
		}
	}

	/**
	 * Sets a variable that will be available in the view
	 */
	public function set($variableName, $value) {
		$this->variables[$variableName] = $value;

		return $this;
	}

	/**
	 * To be extended by (base) controller.
	 * Will be executed just before action is executed.
	 */
	private function beforeAction() {}

	/**
	 * To be extended by (base) controller.
	 * Will be executed just before the view renders.
	 */
	private function beforeRender() {}
	
	/**
	 * Create a new view and render it
	 */
	public function render($templateName = null) {
		// Include class View
		require_once 'library/View.php';
		require_once 'application/View/BaseView.php';

		// Use action name as default template name
		if(is_null($templateName)) {
			$templateName = $this->action;
		}

		$view = new View($this->name, $templateName);
		
		$this->beforeRender();

		$view->render($this->variables);
		
		return $this;
	}

	public function setAction($actionName) {
		if(!method_exists($this, $actionName)) {
			exit('Action `' . $actionName . '` does not exist');
		}

		$this->action = $actionName;

		return $this;
	}
	
	public function execute() {
		$this->beforeAction();

		$this->{$this->action}();
		
		return $this;
	}
}