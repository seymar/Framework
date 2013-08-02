<?php

class IndexController extends Controller {
	public function index() {
		$this->set('contentTitle', 'List of items');

		$items = array('Item1', 'Item2', 'Item3');
		
		$this->set('items', $items);
		
		$this->render();
	}
}