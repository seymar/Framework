<?php

class View {
	public $controller;
	public $name;
	
	private $cms;
	
	public function __construct($controller) {
		$this->controller = $controller;
		
		/**
		 * CMS
		 */
		require_once 'cms/cms.php';
		$this->cms = $cms;
		$this->cms->page($this->controller);
	}
	
	public function render() {
		ob_start();
		require_once 'application/View/' . $this->controller . '/' . $this->name . '.php';
		if(!isset($layout)) {
			if(!file_exists('application/View/Layouts/default.php')) {
				ob_flush();
				
				return true;
			}
			
			$layout = 'default';
		}
		
		$content = ob_get_contents();
		ob_clean();
		
		require_once 'application/View/Layouts/' . $layout . '.php';
		
		return true;
	}
	
	public function element($elementName) {
		require_once 'application/View/Elements/' . $elementName . '.php';
		
		return true;
	}
}