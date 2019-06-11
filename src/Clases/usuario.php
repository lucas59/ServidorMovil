<?php /**
 * 
 */

class usuario{
	
	private $correo;
	private $nombre;
	private $edad;
	private $pass;
	private $comentarios = array();
	private $contenido = array();
	
	public static function verificarExistencia($email){
		$retorno=null;
		$consulta = DB::conexion()->prepare("SELECT * FROM usuario WHERE correo = ?");
		$consulta->bind_param('s',$email);		
		$consulta->execute();
		$resultado = $consulta->get_result();
		if (mysqli_num_rows($resultado) == 1) {
			$retorno = "1";
		} else if($resultado->num_rows == 0) {
			$retorno = "0";
		}
		return $retorno;
	}

	public static function nuevoUsuario($email,$contrasenia){
		$apellido = null;
		$nombre = null;
		$apellido = null;
		$edad = null;
		$estado = 0;
		$sql = DB::conexion()->prepare("INSERT INTO `usuario` (`correo`, `apellido`, `contrasenia`, `edad`, `nombre`, `estado`) VALUES (?,?,?,?,?,?)");
		if ($sql === false) {
			return [ 'ok' => 'false' ];
		}
		$sql->bind_param('sssisi',$email,$apellido,$contrasenia,$edad,$nombre,$estado);
		if($sql->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function login($email,$pass){
		$sql = DB::conexion()->prepare("SELECT * FROM usuario WHERE correo = ?");
		$sql->bind_param("s",$email);
		$sql->execute();
		$resultado = $sql->get_result();
		$usuario=$resultado->fetch_object();
		if($usuario->estado){
			if(sha1($pass)==$usuario->contrasenia){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function activarUsuario($email){
		$estado = 1;
		$sql=DB::conexion()->prepare("UPDATE `usuario` SET `estado` = ? WHERE `usuario`.`correo` = ?");
		$sql->bind_param('is',$estado,$email);
		if ($sql->execute()) {
			return true;
		}else{
			return false;
		} 
	}

	public function obtenerUsuario($correo){
		$sql=DB::conexion()->prepare("SELECT COUNT(*) AS Numero_comentario,correo,nombre,apellido,estado,edad,foto FROM usuario,comentario WHERE correo = ?  AND comentario.usuario_correo = ?");
		$sql->bind_param('ss',$correo,$correo);
		$sql->execute();
		$resultado = $sql->get_result();
		return $resultado->fetch_object();
	}

	public function desactivarUsuario($email){
		$sql=DB::conexion()->prepare("UPDATE usuario SET estado = 0 WHERE correo = ?");
		$sql->bind_param("s",$email);
		if ($sql->execute()) {
			return true;
		}else{
			return false;
		}
	}
	public function obtenerUsuarioPorToken($token){
		$sql=DB::conexion()->prepare("SELECT U.* FROM usuario AS U, validacion AS V WHERE U.correo=V.correo AND V.token=?");
		$sql->bind_param("s",$token);
		$sql->execute();
		$resultado = $sql->get_result();
		return $resultado->fetch_object();
	}
	public function nuevoUsuario2($nombre,$apellido,$edad,$correo,$foto){
		$sql=DB::conexion()->prepare("UPDATE `usuario` SET `foto` = ?, `apellido` = ?, `edad` = ?, `nombre` = ? WHERE correo = ? ");
		$sql->bind_param("ssiss",$foto,$apellido,$edad,$nombre,$correo);
		return $sql->execute();

	}

	public function obtenerUsuarioParaNotificacion($email){

		$sql = DB::conexion()->prepare("SELECT * FROM usuario WHERE correo = ?");
		$sql->bind_param('s', $email);
		$sql->execute();

		$resultado = $sql->get_result();
		return $resultado->fetch_object();

	public function SeguirElemento($correo,$id){
		$sql=DB::conexion()->prepare("INSERT INTO usuario_contenido (Usuario_correo,sigue_id) VALUES (?,?)");
		$sql->bind_param("si",$correo,$id);
		if ($sql->execute()) {
			return 1;
		}else{
			return 0;
		}
	}

	public function DejarSeguirElemento($correo,$id){
		$sql=DB::conexion()->prepare("DELETE FROM usuario_contenido WHERE Usuario_correo = ? AND sigue_id = ?");
		$sql->bind_param("si",$correo,$id);
		if ($sql->execute()) {
			return 1;
		}else{
			return 0;
		}
	}

} ?>