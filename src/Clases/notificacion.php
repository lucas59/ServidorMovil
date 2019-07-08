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
		$sql = DB::conexion()->prepare("SELECT * FROM `comentario` WHERE comentario.contenido_id IN (SELECT usuario_contenido.sigue_id FROM usuario_contenido WHERE usuario_contenido.Usuario_correo = ?)");
		$sql->bind_param('s',$correo);
		$sql->execute();
		
		$result = $sql->get_result();
		$retorno = $result->fetch_all(MYSQLI_ASSOC);

		return json_encode(array('Comentarios' => $retorno));
	}

	public function realizarNotificacion($notificado ,$contenido_id,$capitulo_id, $tipo, $notificador){
		$accion = null;
		$visto = 0;
		if($tipo == "comentario"){
			$accion = "Un contenido que usted sigue fue comentado.";
		}else if ($tipo == "reporte"){
			$accion = "Su comentario fue reportado.";
		}

		$sql = DB::conexion()->prepare("INSERT INTO notificacion(accion, visto, notificado_id, notificador_id, capitulo_id, contenido_id) VALUES (?,?,?,?,?,?)");
		$sql->bind_param('sisi',$accion,$visto,$notificado,$notificador,$capitulo_id,$contenido_id);

		$sql->execute();
	}
}
 ?>