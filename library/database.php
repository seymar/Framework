<?php

class Database extends MySQLi {
	protected $MySQLi;

	protected $currentQuery = '';

	public function __construct() {
	}
}