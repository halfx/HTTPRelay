<?php
/*
 * Test code for pear_HTTPRelay
 * $Id$
 */

$iniget = function_exists ('___ini_get') ? '___ini_get' : 'ini_get';
$iniset = function_exists ('___ini_set') ? '___ini_set' : 'ini_set';

$cwd = getcwd ();
$ccwd = basename ($cwd);
if ( $ccwd == 'tests' ) {
	$oldpath = $iniget ('include_path');
	$newpath = preg_replace ("!/{$ccwd}!", '', $cwd);
	$iniset ('include_path', $newpath . ':' . $oldpath);
}

require_once 'HTTPRelay.php';

try {
	$http = new HTTPRelay;

	$buf = $http->head ('https://raw.github.com/twbs/bootstrap/master/bower.json', 3);

	if ( $buf === false ) {
		echo 'ERROR:  ' . $http->error . "\n";
		exit;
	}

	print_r ($http->info);
	print_r ($buf);
} catch ( myException $e ) {
	echo $e->Message () . "\n";
	print_r ($e->TraceAsArray ()) . "\n";
	$e->finalize ();
}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim: set filetype=php noet sw=4 ts=4 fdm=marker:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
?>
