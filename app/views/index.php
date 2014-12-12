<?php

	if(isset($_GET['p']))
		$params = $_GET['p'];
	else
		$params = 'ControllerMember';

	if(isset($_GET['action']))
		$action = $_GET['action'];
	else
		$action = 'index';
		
	$id = 0;
	if(isset($_GET['id']))
		$id = $_GET['id'];
	$controller = $params;
	

	require('../controllers/'.$controller.'.php');
	$controller = new $controller();
	if(method_exists($controller,$action))
		{
			if(isset($id)){
				$controller->$action($id);}
			else
				$controller->$action();
		}

	else 
		echo("erreur 404");
?>