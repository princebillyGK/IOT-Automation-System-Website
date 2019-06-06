<!-- init.php -->
<?php 
	require 'config.php';
	spl_autoload_register(function($className){
		require_once 'lib/'.str_replace('\\', '/', $className).'.php';
	});

	
 ?>