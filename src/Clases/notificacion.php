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

	public function listarNotificaciones($correo){
		$sql = DB::conexion()->prepare("SELECT * FROM notificacion WHERE correo = ? ");
		$sql->bind_param('s',$correo);
		$sql->execute();
		
		$result = $sql->get_result();
		$retorno = $result->fetch_all(MYSQLI_ASSOC);

		return json_encode(array('notificaciones' => $retorno));
	}

	public function realizarNotificacion($correo, $contenido, $tipo){

		$accion = null;
		if($tipo == "notificacion"){
			$accion = "Alguien respondio su comentario";
		}else if ($tipo == "reporte"){
			$accion = "Su comentario fue reportado";
		}

		$sql = DB::conexion()->prepare("INSERT INTO notificacion () VALUES () ");
		$sql->bind_param();

		if($sql->execute()){
			return 1;
		}else{
			return 0;
		}
	}
}
 ?>