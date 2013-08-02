<?php

class SessionComponent extends Component {
	public function __construct() {
		if(!session_start()) {
			exit('Could not start session');
		}

		return $this;
	}

	public function setFlash($value) {
		$this->set('flash', $value);

		return $this;
	}

	public function set($name, $value) {
		$_SESSION[$name] = $value;

		return $this;
	}

	public function get($name) {
		return $_SESSION[$name];
	}
}