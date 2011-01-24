<?php
/**
 * Copyright 2010, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Testing Controller
 *
 * @package users
 * @subpackage users.tests.cases.controllers.components
 */
class UsersAuthTestController extends Controller {

/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Cookie',
		'Session',
		'Users.UsersAuth',
	);

/**
 * Models
 *
 * @var array
 */
	public $uses = array('Users.User');

/**
 * Empty login function
 *
 * @return void
 */
	public function login() {
		
	}

/**
 * Prevent actual redirection
 *
 * @param mixed $url URL To redirect to
 * @param string $status Status code to use
 * @param string $exit Exit after redirect
 * @return string URL to redirect to
 */
	public function redirect($url, $status = null, $exit = true) {
		return Router::url($url);
	}
}

/**
 * UsersAuth Component Tests
 *
 * @package users
 * @subpackage users.tests.cases.controllers.components
 */
class UsersAuthTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.users.user');

/**
 * Setup for testing
 *
 * @return void
 */
	public function setUp() {
		$request = new CakeRequest('users_auth_test/login');
		$response = new CakeResponse(); 
		$this->Users = new UsersAuthTestController($request, $response);
		$this->Users->constructClasses();

		$this->Users->Session->delete('Auth');
		$this->Users->Session->delete('Message.auth');

		Router::reload();
	}

/**
 * Tear Down
 *
 * @return void
 */
	public function tearDown() {
		$this->Users->Session->delete('Auth');
		$this->Users->Session->delete('Message.auth');
		ClassRegistry::flush();
	}

/**
 * Test setting the cookie
 *
 * @return void
 */
	public function testSetCookie() {
		$this->Users->request->params['action'] = 'login';
		$this->Users->request->data = array(
			'User' => array(
				'remember_me' => 1,
				'email' => 'larry.masters@cakedc.com',
				'passwd' => 'test'));

		$this->Users->startupProcess();
		$this->Users->Auth->login();

		$result = $this->Users->Cookie->read('User');
		$this->assertEqual($result, array(
			'email' => 'larry.masters@cakedc.com',
			'passwd' => 'test'));
	}
}