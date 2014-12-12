<?php 
class Controller{
	var $vars = array();
	
	function set($d)
	{
		$this->vars = array_merge($this->vars,$d);
	}
	
	function render($filename)
	{
		$vars = array();

		extract($this->vars);
		require($filename.'.php');
	}
}
?>