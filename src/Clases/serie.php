<?php 
require_once 'cine.php';
class serie extends cine
{
	private $cant_temporadas;
	private $temporadas = array();


	function __construct(argument)
	{
 		# code...
	}
	
	public function getCant_Temporadas(){
		return $this->cant_temporadas;
	}

	public function setTemporadas($temporadas){
		$this->cant_temporadas=$temporadas;
	}

	public function getTemporadas(){
		return $this->temporadas;
	}

	public function setTemporadas($temporadas){
		$this->temporadas=$temporadas;
	}
} ?>