<?php

function loadModel($name) {
	$name = ucfirst(strtolower($name));
	
	require_once 'application/Model/' . $name . '.php';
	
	return $name;
}