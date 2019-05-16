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
	
	public function verificarExistencia($email){
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

	public function nuevoUsuario($email,$contrasenia){
		$apellido = null;
		$nombre = null;
		$apellido = null;
		$edad = null;
		$estado = 0;
		$sql = DB::conexion()->prepare("INSERT INTO `usuario` (`correo`, `apellido`, `contrasenia`, `edad`, `nombre`, `estado`) VALUES (?,?,?,?,?,?)");
		$sql->bind_param('sssisi',$email,$apellido,$contrasenia,$edad,$nombre,$estado);
		if($sql->execute()){
			return true;
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

} ?>