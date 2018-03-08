<?php

	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	define('__DEBUG__', false);
	define('__ROOT__', __DIR__);
	define('DS', DIRECTORY_SEPARATOR);
	define('_CLASSES_', __DIR__.'/lib/Classes');
	define('_CLASSDIR_', glob(_CLASSES_ . '/*' , GLOB_ONLYDIR));

	session_start();

	function ClassLoader(string $className) 
	{
		$className = str_replace('\\', '/', $className);
		if(file_exists($className)){
			require_once($className);
		} else {
			echo 'ERROR:'. $className;
		}
	}

	foreach(_CLASSDIR_ as $direc)
	{
		foreach(glob($direc.'/*.class.php') as $file) {
			ClassLoader($file);
		}
	}

	foreach(Config::LocateFiles(__ROOT__ . DS . 'config' . DS) as $configFile)
    {
        require_once $configFile;
	}
	
