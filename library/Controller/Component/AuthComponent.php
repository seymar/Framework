<?php

class AuthComponent extends Component {
	public $uses = array('User');

	/**
	 * Try to login with the posted credentials or login given user
	 */
	public function login($user = null) {
		if(is_null($user)) {
			return $this->identify($_POST['email'], $_POST['password']);
		}

		// Log the user in
		createSession($user);

		return true;
	}

	/**
	 * Check for valid credentials
	 */
	protected function identify($email, $password) {
		// Encrypt password
		$password = $this->password($password);

		// Find user
		if(!$user = $this->User->findByEmailAndPassword($email, $password)) {
			return false;
		}
	}

	/**
	 * Logs the user in
	 */
	protected function createSession($user) {
		$this->Session->set('email', $user->email)->set('password', $user->password);

		return $this;
	}

	/**
	 * Password encryption function
	 */
	protected function password($password) {
		return sha1(md5($password));
	}
}