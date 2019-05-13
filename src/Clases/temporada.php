<?php 
/**
  * 
  */
class temporada{
	private $numero;
	private $cant_capitulos;
	private $capitulos = array();
	private $serie;

	function __construct(argument)
	{
 		# code...
	}

	public function getNumero(){
		return $this->numero;
	}

	public function setNumero($numero){
		$this->numero=$numero;
	}
	public function getCapitulos(){
		return $this->capitulos;
	}

	public function setCapitulos($capitulos){
		$this->capitulos=$capitulos;
	}
	public function getSerie(){
		return $this->serie;
	}

	public function serie($serie){
		$this->serie=$serie;
	}

} ?>