<?php
class AllUsersPluginTest extends PHPUnit_Framework_TestSuite {

/**
 * Suite define the tests for this suite
 *
 * @return void
 */
	public static function suite() {
		$suite = new PHPUnit_Framework_TestSuite('All Users Plugin Tests');

		$basePath = APP . 'plugins' . DS . 'users' . DS . 'tests' . DS . 'cases' . DS;
		// controllers
		$suite->addTestFile($basePath . 'controllers' . DS . 'users_controller.test.php');
		$suite->addTestFile($basePath . 'controllers' . DS . 'details_controller.test.php');

		// models
		$suite->addTestFile($basePath . 'models' . DS . 'user.test.php');
		$suite->addTestFile($basePath . 'models' . DS . 'detail.test.php');

		return $suite;
	}
}