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

	public function IngresarContenido($id,$temporada,$capitulo,$capitulo_id,$fecha,$genero,$titulo,$tipo){
		$sql = DB::conexion()->prepare("INSERT INTO `contenido` (`id`,`fecha`, `genero`, `titulo`) VALUES (?,?,?,?)");
		/*if ($sql === false) {
			return [ 'ok' => 'false' ];
		}*/
		$sql->bind_param('isss',$id,$fecha,$genero,$titulo);
		if($sql->execute()){
			if(comentarios::insertarIdEnCine($id)){
			if ($tipo == 1) {
				return comentarios::insertarPelicula($id);
			}else{
				$serie = comentarios::insertarSerie($id);
				$temp = comentarios::insertarTemporada($id,$temporada,$capitulo);
				$cap = comentarios::insertarCapitulo($temporada,$capitulo_id);
				if($serie == 1 && $cap == 1 && $temp == 1){
					return "1";
				}
				else{
					return "0";
				}
			}
			 }
		}else{
			return "0";
		}
	}


      public static function insertarIdEnCine($id){
        $sql = DB::conexion()->prepare("INSERT INTO `cine` (`id`) VALUES (?)");
        $sql->bind_param("i",$id);
        if ($sql->execute()) {
        	return true;
        }else{
        	return false;
        }
    }


	 public static function insertarPelicula($id){
		$sql = DB::conexion()->prepare("INSERT INTO `pelicula` (`id`) VALUES (?)");
		$sql->bind_param("i",$id);
		if($sql->execute()){
			return "1";
		}else{
			return "0";
		}
	}



	public static  function insertarSerie($id){
		$sql = DB::conexion()->prepare("INSERT INTO `serie` (`id`) VALUES (?)");
		$sql->bind_param("i",$id);
		if($sql->execute()){
			return "1";
		}else{
			return "0";
		}
	}

		public static  function insertarCapitulo($temporada,$id_capitulo){
		$sql = DB::conexion()->prepare("INSERT INTO `capitulo` (`id`,`temporada_id`) VALUES (?,?)");
		$sql->bind_param("ii",$id_capitulo,$temporada);
		if($sql->execute()){
			return "1";
		}else{
			return "0";
		}
	}

	public static  function insertarTemporada($id,$temporada,$capitulo){
		$sql = DB::conexion()->prepare("INSERT INTO `temporada` (`id`,`capitulo`,`serie_id`) VALUES (?,?,?)");
		$sql->bind_param("iii",$temporada,$capitulo,$id);
		if($sql->execute()){
			return "1";
		}else{
			return "0";
		}
	}



	public function Lista_Contenido($id){
		$estado = 0;
		$sql = DB::conexion()->prepare("SELECT * FROM comentario WHERE contenido_id = ? AND estado = ?");
		$sql->bind_param('ii',$id,$estado);
		$sql->execute();
		
		$result = $sql->get_result();
		$outp = $result->fetch_all(MYSQLI_ASSOC);

		return json_encode(array('Comentarios' => $outp));
	}

		public function Lista_ContenidoSerie($id){
		$estado = 0;
		$sql = DB::conexion()->prepare("SELECT * FROM comentario WHERE capitulo_id = ? AND estado = ?");
		$sql->bind_param('ii',$id,$estado);
		$sql->execute();
		
		$result = $sql->get_result();
		$outp = $result->fetch_all(MYSQLI_ASSOC);

		return json_encode(array('Comentarios' => $outp));
	}
	
	public static function Reportar($comentario){
		$sql = DB::conexion()->prepare("UPDATE comentario SET estado = 1 WHERE comentario.id = ?");
		$sql->bind_param('i',$comentario);
		if($sql->execute()){
			return "1";
		}else{
			return "0";
		}
	}

	public static function puntuar($comentario,$usuario,$puntuacion){
		$sql = DB::conexion()->prepare("INSERT INTO usuario_puntuaciones (usuario_correo, comentario_id, puntuacion) VALUES (?,?,?)");
		$sql->bind_param('sii',$usuario,$comentario,$puntuacion);
		if($sql->execute()){
			return "1";
		}else{
			return "0";
		}
	}
}
?>