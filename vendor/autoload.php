<?php
use GDO\Util\Strings;

/**
 * GDO compatible autoloader for JpGraph.
 * @see https://github.com/R0L/Jpgraph/blob/master/autoload.php
 */
spl_autoload_register(function($classname) {
	
	# JPGraph basedir
	$baseDir = dirname(__DIR__) . '/jpgraph/src/';
	
	if ($classname = Strings::substrFrom($classname, "Amenadiel\\JpGraph\\"))
	{
		$file = $baseDir . $classname . '.php';
		if (is_file($file))
		{
			require $file;
		}
	}
});
