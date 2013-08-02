<?php

class IndexController extends BaseController {
	public function index() {
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			if($this->Auth->login()) {
				$this->redirect('');
			} else {
				$this->Session->setFlash('Invalid credentials');
			}
		}
		
		$this->render('login');
	}
}