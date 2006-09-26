--TEST--
mysqli fetch char/text long 
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
	include "connect.inc";
	
	/*** test mysqli_connect 127.0.0.1 ***/
	$link = mysqli_connect($host, $user, $passwd);

	mysqli_select_db($link, "test");

  	mysqli_query($link,"DROP TABLE IF EXISTS test_bind_fetch");
  	mysqli_query($link,"CREATE TABLE test_bind_fetch(c1 char(10), c2 text)");

	$a = str_repeat("A1", 32000);

	mysqli_query($link, "INSERT INTO test_bind_fetch VALUES ('1234567890', '$a')");

	$stmt = mysqli_prepare($link, "SELECT * FROM test_bind_fetch");
	mysqli_bind_result($stmt, $c1, $c2);
	mysqli_execute($stmt);
	mysqli_fetch($stmt);

	$test[] = $c1;
	$test[] = ($a == $c2) ? "32K String ok" : "32K String failed";

	var_dump($test);

	mysqli_stmt_close($stmt);
	mysqli_close($link);
?>
--EXPECTF--
array(2) {
  [0]=>
  %s(10) "1234567890"
  [1]=>
  %s(13) "32K String ok"
}
