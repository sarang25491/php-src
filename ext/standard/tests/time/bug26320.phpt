--TEST--
Bug #26320 (strtotime handling of XML Schema/ISO 6801 format)
--SKIP--
if (!@putenv("TZ=GMT0") || getenv("TZ") != 'GMT0') {
	die("skip unable to change TZ enviroment variable\n");
}
--FILE--
<?php
    putenv("TZ=GMT0");
	echo date("Y-m-d H:i:s\n", strtotime("2003-11-19T12:30:42"));
	echo date("Y-m-d H:i:s\n", strtotime("2003-11-19T12:30:42Z"));
?>
--EXPECT--
2003-11-19 12:30:42
2003-11-19 12:30:42