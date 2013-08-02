<?php

class View {
	public $controllerName;
	public $templateName;

	public function __construct($controllerName, $templateName) {
		$this->controllerName = $controllerName;
		$this->templateName = $templateName;
	}
	
	/**
	 * Output templates to the screen
	 */
	public function render($variables) {
		// Set variables to be used in templates
		foreach($variables as $name => $value) {
			${$name} = $value;
		}

		// Start output buffering
		ob_start();

		// Include the template
		require_once 'application/View/' . $this->controllerName . '/' . $this->templateName . '.php';

		// Check for a requested layout
		if(!isset($layout)) {
			// Check for a default layout, if not: print just the template to the screen
			if(!file_exists('application/View/Layouts/default.php')) {
				// Output everything in the buffer
				ob_flush();
				
				return true;
			}
			
			// Default layout exists, use it
			$layout = 'default';
		}
		
		// Save output to be used in the layout and empty buffer
		$page = ob_get_contents();
		ob_clean();
		
		// Print the layout to the screen, the layout will use the $content variable to print the template
		require_once 'application/View/Layouts/' . $layout . '.php';
		
		return true;
	}
	
	/**
	 * Include an Element
	 */
	public function element($elementName) {
		require_once 'application/View/Elements/' . $elementName . '.php';
		
		return true;
	}
}