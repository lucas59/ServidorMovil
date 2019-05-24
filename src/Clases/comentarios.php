<?php 
/**
  * 
  */
class comentarios{
	private $titulo;
	private $texto;
	private $usuario;
	private $contenido; 

	public function IngresarComentario($texto,$titulo,$capitulo_id,$contenido_id,$usuario){
		if(!$capitulo_id){
			$capitulo_id = null;
		}
		$sql = DB::conexion()->prepare("INSERT INTO `comentario` (`texto`, `titulo`, `capitulo_id`, `contenido_id`, `usuario_correo`) VALUES (?,?,?,?,?)");
		$sql->bind_param('ssiis',$texto,$titulo,$capitulo_id,$contenido_id,$usuario);
		if($sql->execute()){
			return "1";
		}else{
			return "0";
		}
	}

	public function IngresarContenido($id,$fecha,$genero,$titulo){
		$sql = DB::conexion()->prepare("INSERT INTO `contenido` (`id`,`fecha`, `genero`, `titulo`) VALUES (?,?,?,?)");
		if ($sql === false) {
			return [ 'ok' => 'false' ];
		}
		$sql->bind_param('isss',$id,$fecha,$genero,$titulo);
		if($sql->execute()){
			return "1";
		}else{
			return "0";
		}
	}
}
?>