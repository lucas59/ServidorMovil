<?php 
/**
  * 
  */
 class comentario{
 	private $titulo;
 	private $texto;
 	private $usuario;
 	private $contenido; 

 	public function IngresarComentario($texto,$titulo,$capitulo_id,$contenido_id,$usuario){
		$sql = DB::conexion()->prepare("INSERT INTO `comentario` (`texto`, `titulo`, `capitulo_id`, `contenido_id`, `usuario_correo`) VALUES (?,?,?,?,?)");
    if ($sql === false) {
        return [ 'ok' => 'false' ];
    }
		$sql->bind_param('ssiis',$texto,$titulo,$capitulo_id,$contenido_id,$usuario);
		if($sql->execute()){
			return "1";
		}else{
			return "0";
		}
	}
 }
  ?>