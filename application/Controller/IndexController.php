<?php

class IndexController extends BaseController {
	public function index() {
		// Check for a post request
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Try to login with posted credentials
			if($this->Auth->login()) {
				// Rederict to logged in page
			} else {
				// Show error message
				$this->Session->setFlash('Invalid credentials');
			}
		}
		
		$this->render('login');
	}
}