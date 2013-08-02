<?php

class Controller {
	private $name;
	private $action;

	// Being set in (base) controller to determine which components must be loaded 
	public $components = array();

	// Being set (base) model to determine which models must be loaded
	public $uses = array();

	// Holds the variables that must be passed to the view
	public $variables = array();
	
	public function __construct() {
		// Set controller name
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
		// Include classes
		require_once 'library/View.php';
		require_once 'application/View/BaseView.php';

		// Use action name as default template name
		if(is_null($templateName)) {
			$templateName = $this->action;
		}

		// Create the instance
		$view = new View($this->name, $templateName);
		
		// Execute beforeRender() just before the view is rendered
		$this->beforeRender();

		// Render the view
		$view->render($this->variables);
		
		return $this;
	}

	/**
	 * Sets the current acion
	 */
	public function setAction($actionName) {
		if(!method_exists($this, $actionName)) {
			exit('Action `' . $actionName . '` does not exist');
		}

		$this->action = $actionName;

		return $this;
	}
	
	/**
	 * Executes the currently selected action
	 */
	public function execute() {
		// Execute beforeAction() just before the action is executed
		$this->beforeAction();

		// Execute the action
		$this->{$this->action}();
		
		return $this;
	}
}