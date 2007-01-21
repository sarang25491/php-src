--TEST--
Phar::mapPhar invalid file (gzipped file length is too short)
--SKIPIF--
<?php if (!extension_loaded("phar")) print "skip";?>
<?php if (!extension_loaded("zlib")) print "skip zlib not present"; ?>
--INI--
phar.require_hash=0
--FILE--
<?php
$fname = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.phar.php';
$pname = 'phar://' . $fname;
$file = "<?php __HALT_COMPILER(); ?>";
// file length is too short

$files = array();
$files['a'] = array('cont'=>'a','comp'=>chr(75)/*. chr(4) . chr(0): 'a' gzdeflated */,'flags'=>0x00001000);
$files['b'] = $files['a'];
$files['c'] = array('cont'=>'*');
$files['d'] = $files['a'];
include 'phar_test.inc';

var_dump(file_get_contents($pname . '/a'));
var_dump(file_get_contents($pname . '/b'));
var_dump(file_get_contents($pname . '/c'));
var_dump(file_get_contents($pname . '/d'));
?>
--CLEAN--
<?php unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.phar.php'); ?>
--EXPECTF--
Warning: file_get_contents(phar://%s/a): failed to open stream: phar error: internal corruption of phar "%s" (actual filesize mismatch on file "a") in %s on line %d
bool(false)

Warning: file_get_contents(phar://%s/b): failed to open stream: phar error: internal corruption of phar "%s" (actual filesize mismatch on file "b") in %s on line %d
bool(false)
string(1) "*"

Warning: file_get_contents(phar://%s/d): failed to open stream: phar error: internal corruption of phar "%s" (actual filesize mismatch on file "d") in %s on line %d
bool(false)
