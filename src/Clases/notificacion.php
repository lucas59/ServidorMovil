<?php 

/**
* 
*/
class notificacion {
	private $contenido_id;
	private $usuario_correo;
	private $visto;	
	private $accion;
	
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

	public function listarnotificaciones($correo){
		$sql = DB::conexion()->prepare("SELECT * FROM notificacion WHERE usuario_correo = ? ");
		$sql->bind_param('s',$correo);
		$sql->execute();
		
		$result = $sql->get_result();
		$retorno = $result->fetch_all(MYSQLI_ASSOC);

		return json_encode(array('notificaciones' => $retorno));
	}

	public function realizarNotificacion($usuario_id ,$contenido_id, $tipo){
		$accion = null;
		$visto = 0;
		if($tipo == "comentario"){
			$accion = "respondio su comentario";
		}else if ($tipo == "reporte"){
			$accion = "Su comentario fue reportado por";
		}

		$sql = DB::conexion()->prepare("INSERT INTO notificacion(accion,contenido_id, usuario_correo, visto) VALUES (?,?,?,?)");
		$sql->bind_param('sisi',$accion,$contenido,$correo,$visto);

		$sql->execute();
	}
}
 ?>