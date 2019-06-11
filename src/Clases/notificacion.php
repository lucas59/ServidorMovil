<?php 

/**
* 
*/
class notificacion {
	private $contenido_id;
	private $nickUsuario;
	private $fecha;	

	
	function __construct($contenido, $usuario, $fecha){
		$this->contenido_id = $contenido;
		$this->nickUsuario = $usuario;
		$this->fecha = $fecha;
	}

	public function setContenido($contenido){
		$this->contenido_id = $contenido;
	}

	public function setUsuario($usuario){
		$this->nickUsuario = $usuario;
	}

	public function setFecha($fecha){
		$this->fecha = $fecha;
	}

}
 ?>