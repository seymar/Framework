<?php

class Database {
	public $db;

	public function __construct() {
		$this->db = new MySQLi('localhost', '', '', '');
	}
}