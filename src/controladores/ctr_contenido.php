<?php

/**
  *
  */
require_once '../src/Clases/comentarios.php';
require_once '../src/Clases/contenido.php';
require_once '../src/Clases/notificacion.php';
require_once '../src/Clases/console.php';

class ctr_contenido {
	public function Comentario($texto,$serie_id,$temporada,$capitulo,$capitulo_id,$contenido_id,$usuario,$fecha,$genero,$titulo_elemento){

		$resultado_serie = contenido::Buscar_contenido($serie_id);
		$resultado_pelicula = contenido::Buscar_contenido($contenido_id);
		$contenido = '1';
		if(!$resultado_pelicula){
			if($contenido_id){
			$contenido = comentarios::IngresarContenido($contenido_id,$temporada,$capitulo,$capitulo_id,$fecha,$genero,$titulo_elemento,1);
		}
	}
	if(!$resultado_serie){
		if($serie_id){
			$contenido = comentarios::IngresarContenido($serie_id,$temporada,$capitulo,$capitulo_id,$fecha,$genero,$titulo_elemento,0);
		}
		}
		$comentario = comentarios::IngresarComentario($texto,$capitulo_id,$contenido_id,$usuario);
		if($comentario == "1" && $contenido == "1"){
			return "1";
			generarNotificacion($usuario, $contenido_id, $capitulo_id,"comentario");
		}else{
			return "0";
		}
	}

	public function Lista_Comentario($id){
		return $comentario = comentarios::Lista_Contenido($id);
	}

	public function puntuacion_comentario($id_comentario,$id_persona){
		return $comentario = comentarios::puntuacion_comentario($id_comentario,$id_persona);
	}


	public function Lista_ComentarioSerie($id){
		return $comentario = comentarios::Lista_ContenidoSerie($id);

	}

	public function Lista_elementousuario_peli($id){
		return $usuario = usuario::Lista_elementousuario_peli($id);
	}

	public function verificarFavorito($email,$id){
		return contenido::verificarFavorito($email,$id);
	}


	public function seguir($email,$id,$fecha,$genero,$titulo,$tipo){//$email,$id,$fecha,$genero,$titulo
		$resultado = contenido::Buscar_contenido($id);
		if(!$resultado){
		 comentarios::IngresarContenido($id,null,null,null,$fecha,$genero,$titulo,$tipo);
		}
		return contenido::SeguirElemento($email,$id);
	}

	public function contenido_num($id){
		return contenido::numero_contenido($id);
	}

	public function dejarDeSeguir($email,$id){//$email,$id,$fecha,$genero,$titulo
		return contenido::DejarSeguirElemento($email,$id);
	}
	public function ReportarComentario($comentario){
		$reportes = comentarios::numero_reportes($comentario);
		return $comentario = comentarios::Reportar($comentario,$reportes);	
	}

	public function PuntuarComentario($comentario,$usuario,$puntuacion){
		return $comentario = comentarios::puntuar($comentario,$usuario,$puntuacion);
	}

	public function Lista_contenido_usuario($id){
		return $contenido = contenido::Lista_contenido_usuario($id);
	}

	public function generarNotificacion($notificador, $contenido_id, $capitulo_id, $tipo){
		$usuarios = usuario::obtenerUsuariosParaNotificacion($contenido_id);

		while ($notificado = $usuario->fetch_array(MYSQLI_ASSOC)) {
			notificacion::realizarNotificacion($notificado ,$contenido_id,$capitulo_id, $tipo, $notificador);
		}
		
	}

	public function listarNotificaciones($correo){
		return notificacion::listarnotificaciones($correo);
	}
}

?>
