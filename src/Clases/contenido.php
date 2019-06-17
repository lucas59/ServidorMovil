<?php 
/**
  * 
  */
class contenido {

	private $id;
	private $titulo;
	private $fecha;
	private $genero;
	private $comentarios = array();

	

	public function getId(){
		return $this->id;
	}
	public function getTitulo(){
		return $this->titulo;
	}
	public function getFecha(){
		return $this->fecha;
	}
	public function getGenero(){
		return $this->genero;
	}

	public function getComentarios(){
		return $this->comentarios;
	}
	public function setId($id){
		$this->id=$id;
	}

	public function setTitulo($titulo){
		$this->titulo=$titulo;
	}

	public function setFecha($id){
		$this->fecha=$fecha;
	}

	public function setGenero($genero){
		$this->genero=$genero;
	}

	public function setComentarios($comentarios){
		$this->comentarios=$comentarios;
	}

	public function Buscar_contenido($id){
		$respuesta=null;
		$consulta = DB::conexion()->prepare("SELECT * FROM contenido WHERE id = '" . $id . "'");
		$consulta->execute();
		$resultado = $consulta->get_result();
		if (mysqli_num_rows($resultado) >= 1) {
			return true;
		} else {
			return false;
		}
	}

public function	verificarFavorito($email,$id){
	$consulta = DB::conexion()->prepare("SELECT * FROM usuario_contenido WHERE Usuario_correo=? AND sigue_id =?");
	$consulta->bind_param("ss",$email,$id);
	$consulta->execute();
	$resultado = $consulta->get_result();
		if ( mysqli_num_rows($resultado) >= 1 ) {
			return "1";
		} else {
			return "0";
		}
	}

public function SeguirElemento($correo,$id){
		$sql=DB::conexion()->prepare("INSERT INTO usuario_contenido (Usuario_correo,sigue_id) VALUES (?,?)");
		$sql->bind_param("si",$correo,$id);
		if ($sql->execute()) {
			return "1";
		}else{
			return "0";
		}
	}
	
	public function DejarSeguirElemento($correo,$id){
		$sql=DB::conexion()->prepare("DELETE FROM usuario_contenido WHERE Usuario_correo = ? AND sigue_id = ?");
		$sql->bind_param("si",$correo,$id);
		if ($sql->execute()) {
			return "1";
		}else{
			return "0";
		}
	}


} 


?>