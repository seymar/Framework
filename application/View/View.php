<?php

class View {
	public $controllerName;
	public $name;
	
	private $cms;
	
	public function __construct($controllerName) {
		$this->controllerName = $controllerName;
	}
	
	/**
	 * Output the view to the screen
	 */
	public function render() {
		// Don't print anything to the screen yet
		ob_start();

		// Include the template
		require_once 'application/View/' . $this->controllerName . '/' . $this->name . '.php';

		// Check for a requested layout
		if(!isset($layout)) {
			// Check for a default layout, if not: print just the template to the screen
			if(!file_exists('application/View/Layouts/default.php')) {
				ob_flush();
				
				return true;
			}
			
			// Default layout exists, use it
			$layout = 'default';
		}
		
		// Save the template to be printed in the layout
		$content = ob_get_contents();
		ob_clean();
		
		// Print the layout to the screen, the layout will use the $content variable to print the template
		require_once 'application/View/Layouts/' . $layout . '.php';
		
		return true;
	}
	
	/**
	 * Load an Element
	 */
	public function element($elementName) {
		require_once 'application/View/Elements/' . $elementName . '.php';
		
		return true;
	}
}