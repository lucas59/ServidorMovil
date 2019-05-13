<?php 
require_once 'cine.php.php';
class pelicula extends cine{
	private $duraccion;

	function __construct(argument)
	{
 		# code...
	}
	public function getDuraccion(){
		return $this->duraccion;
	}

	public function setDuraccion($duraccion){
		$this->duraccion=$duraccion;
	}
	
} ?>