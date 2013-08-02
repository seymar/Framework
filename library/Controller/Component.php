<?php

class Component {
	public $components = array();
	
	public function __construct() {
		$this->initializeComponents();

		$this->initializeModels();
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
}