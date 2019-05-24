<?php 

/**
  * 
  */
require_once '../src/Clases/comentarios.php';

 class ctr_contenido {
	public function Comentario($texto,$titulo,$capitulo_id,$contenido_id,$usuario){
		$comentario = comentarios::IngresarComentario($texto,$titulo,$capitulo_id,$contenido_id,$usuario);
		if($existe == "1"){
			return "1";
		}else{
			return "0";
		}
	}

}

 ?>