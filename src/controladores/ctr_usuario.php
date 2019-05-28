<?php 
/**
  * 
  */

require_once '../src/Clases/usuario.php';
require_once '../src/Clases/validacion.php';
require_once '../src/conexion/abrir_conexion.php';
class ctr_usuario {



	public function altaUser($email,$pass){
		$existe = usuario::verificarExistencia($email);
		if($existe == "0"){
			$inserUsu = usuario::nuevoUsuario($email,sha1($pass));
			if($inserUsu){

				$token = validacion::generarToken(10);
				if(validacion::registrarValidacion($email,$token)){
					return validacion::enviarMail($email,$token);
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function altaUser2($nombre,$apellido,$edad,$token,$foto){
		$usuario = usuario::obtenerUsuarioPorToken($token);
		if($usuario){
			return usuario::nuevoUsuario2($nombre,$apellido,$edad,$usuario->correo,$foto);
		}else{
			return false;
		}
	}

	public function login($email,$pass){
		$existe = usuario::verificarExistencia($email);
		if($existe == "1"){
			return usuario::login($email,$pass);
		}else{
			return false;
		}
	}

	public function obtenerUsuario($correo){
		return usuario::obtenerUsuario($correo);
	}




	public function activarUsuario($token){
		$validacion = validacion::obtenerValidacion($token);
		if($validacion){
			return usuario::activarUsuario($validacion->correo);
		}else{
			return false;
		}
	}

	public function desactivarUsuario($email){
		return usuario::desactivarUsuario($email);

	}


} ?>