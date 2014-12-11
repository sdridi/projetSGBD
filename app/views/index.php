<?php
	$params = explode('/',$_GET['p']);
	$controller = $params[0];
	$action = isset($params[1]) ? $params[1] : 'index';
	
	require('../controllers/'.$controller.'.php');
	$controller = new $controller();
	if(method_exists($controller,$action))
		$controller->$action();
	else 
		echo("erreur 404");
?>