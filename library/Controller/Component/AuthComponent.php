<?php

class AuthComponent extends Component {
	// Use the User model
	public $uses = array('User');

	/**
	 * Try to login with the posted credentials
	 */
	public function login() {
		// Encrypt password
		$password = $this->password($password);

		// Find user
		if(!$user = $this->User->findByEmailAndPassword($_POST['email'], $password)) {
			return false;
		}

		// Log the user in
		$this->createSession($user);

		return true;
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