<?php 
/**
  * 
  */
class comentarios{
	private $titulo;
	private $texto;
	private $usuario;
	private $contenido; 

	public function IngresarComentario($texto,$capitulo_id,$contenido_id,$usuario){
		if(!$capitulo_id){
			$capitulo_id = null;
		}
		$sql = DB::conexion()->prepare("INSERT INTO `comentario` (`texto`, `capitulo_id`, `contenido_id`, `usuario_correo`) VALUES (?,?,?,?)");
		$sql->bind_param('siis',$texto,$capitulo_id,$contenido_id,$usuario);
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

	public function Lista_Contenido($id){
		$sql = DB::conexion()->prepare("SELECT * FROM comentario WHERE contenido_id = ?");
		$sql->bind_param('i',$id);
		$sql->execute();
		
		$result = $sql->get_result();
		$outp = $result->fetch_all(MYSQLI_ASSOC);

		return json_encode(array('Comentarios' => $outp));
	} 	
}
?>