<?php

class Model extends Database {
	private $tableName = '';

	public function __construct() {
		parent::__construct();

		$this->tableName = strtolower(get_class($this)) . 's';
	}
}