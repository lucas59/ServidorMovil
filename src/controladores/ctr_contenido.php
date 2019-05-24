<?php 

/**
  * 
  */
require_once '../src/Clases/comentarios.php';
require_once '../src/Clases/contenido.php';

class ctr_contenido {
	public function Comentario($texto,$titulo,$capitulo_id,$contenido_id,$usuario,$fecha,$genero,$titulo_elemento){
		$resultado = contenido::Buscar_contenido($contenido_id);
		$contenido = '1';
		if(!$resultado){
			$contenido = comentarios::IngresarContenido($contenido_id,$fecha,$genero,$titulo_elemento);
		}
		$comentario = comentarios::IngresarComentario($texto,$titulo,$capitulo_id,$contenido_id,$usuario);
		if($comentario == "1" && $contenido == "1"){
			return "1";
		}else{
			return "0";
		}
	}

}

?>