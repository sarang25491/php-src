--TEST--
Bug #39602 (Invalid session.save_handler crashes PHP)
--INI--
session.save_handler=qwerty
--FILE--
<?php
ini_set("session.save_handler","files");
$x = new stdClass();
echo "ok";
?>
--EXPECT--
ok
Fatal error: Unknown: Cannot find save handler qwerty in Unknown on line 0
