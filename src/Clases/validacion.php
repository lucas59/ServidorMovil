<?php 
use PHPMailer\PHPMailer\PHPMailer;

/**
  * 
  */
class validacion {
	private $correo;
	private $token;

	public function generarToken($longitud) {
		$caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$cadenaAleatoria = '';
		for ($i = 0; $i < $longitud; $i++) {
			$cadenaAleatoria .= $caracteres[rand(0, strlen($caracteres) - 1)];
		}
		return $cadenaAleatoria;
	} 


	public function registrarValidacion($email,$token){
		$id=null;
		$consulta=DB::conexion()->prepare("INSERT INTO `validacion` (`id`, `correo`, `token`) VALUES (?,?,?)");
		$consulta->bind_param("iss",$id,$email,$token);
		/*
		$consulta->bind_param('s',$email);		
		$consulta->execute();
		*/
		if ($consulta->execute()){
			return true;
		}else{
			return false;
		}

	}

	public function obtenerValidacion($token){
		//SELECT * FROM `validacion` 
		$sql = DB::conexion()->prepare("SELECT * FROM `validacion` WHERE token = ?");
		$sql->bind_param("s",$token);
		$sql->execute();
		$resultado = $sql->get_result();
		$validacion=$resultado->fetch_object();
		return $validacion;
	}


	public function enviarMail($email,$token){
		$hash = "Codigo de validacion: ";
		$hash .= $token;
//Create a new PHPMailer instance
		$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
		$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
		$mail->SMTPDebug = 0;
//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "idevelopcomunidad@gmail.com";
//Password to use for SMTP authentication
		$mail->Password = "idevelop2019";
//Set who the message is to be sent from
		$mail->setFrom("idevelopcomunidad@gmail.com", 'IDevelop');
//Set an alternative reply-to address
//		$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
		$mail->addAddress($email, 'Nuevo Usuario');
//Set the subject line
		$mail->Subject = 'Validacion de nueva cuenta';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
	//	$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
//Replace the plain text body with one created manually
		$mail->Body = $hash;
//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
		if ($mail->send()) {
			return true;
		}else{
			return false;
		}

	}

} ?>