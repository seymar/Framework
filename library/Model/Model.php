<?php

class Model {
	protected $tableName = '';

	protected $MySQLi;

	public function __construct() {
		$this->tableName = strtolower(get_class($this)) . 's';

		$this->MySQLi = new MySQLi('localhost', '', '', '');
	}
}