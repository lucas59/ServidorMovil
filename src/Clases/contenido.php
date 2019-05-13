<?php 
/**
  * 
  */
class contenido {

	private $id;
	private $titulo;
	private $fecha;
	private $genero;
	private $comentarios = array();

	function __construct(argument)
	{
 		# code...
	}

	public function getId(){
		return $this->id;
	}
	public function getTitulo(){
		return $this->titulo;
	}
	public function getFecha(){
		return $this->fecha;
	}
	public function getGenero(){
		return $this->genero;
	}

	public function getComentarios(){
		return $this->comentarios;
	}
	public function setId($id){
		$this->id=$id;
	}

	public function setTitulo($titulo){
		$this->titulo=$titulo;
	}

	public function setFecha($id){
		$this->fecha=$fecha;
	}

	public function setGenero($genero){
		$this->genero=$genero;
	}

	public function setComentarios($comentarios){
		$this->comentarios=$comentarios;
	}

	
	
} ?>