--TEST--
Bug #28817 testcase (properties)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
	include "connect.inc";
	
	class my_mysql extends mysqli {
		public $p_test;

		function __construct() {
			$this->p_test[] = "foo";
			$this->p_test[] = "bar";
		}
	}


	$mysql = new my_mysql();

	var_dump($mysql->p_test);
	@var_dump($mysql->errno);

	$mysql->connect($host, $user, $passwd);
	$mysql->select_db("nonexistingdb");

	var_dump($mysql->errno > 0);

	$mysql->close();	
?>
--EXPECTF--
array(2) {
  [0]=>
  %s(3) "foo"
  [1]=>
  %s(3) "bar"
}
NULL
bool(true)
