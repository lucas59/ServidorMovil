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


	public function activarUsuario($token){
		$validacion = validacion::obtenerValidacion($token);
		if($validacion){
			return usuario::activarUsuario($validacion->correo);
		}else{
			return false;
		}
	}


} ?>