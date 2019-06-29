<?php


use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require_once 'controladores/ctr_usuario.php';
require_once '../src/Clases/console.php';

return function (App $app){
	$container = $app->getContainer();

	$app->post('/usuario/nuevo',function($request,$response,$args) use ($container){
		$data = $request->getParams();
		$email=$data['correo'];
		$pass=$data['pass'];
		$myObj = new \stdClass();
		$alta = ctr_usuario::altaUser($email,$pass);
		echo Console::log("ads",$alta);
		if($alta==true){
			$myObj->retorno = true;
		}else{
			$myObj->retorno = false;
		}
		$algo=json_encode($myObj);
		return $algo;

	})->setName("NuevoUsuario");



	$app->post('/usuario/nuevo2',function($request,$response,$args) use ($container){
		$data = $request->getParams();
		$nombre=$data['nombre'];
		$apellido=$data['apellido'];
		$edad=$data['edad'];
		$token=$data['token'];
		$foto = $data['foto'];

		$myObj = new \stdClass();

		if(ctr_usuario::altaUser2($nombre,$apellido,$edad,$token,$foto)){
			$myObj->retorno = true;
		}else{
			$myObj->retorno = false;
		}
		return json_encode($myObj);

	})->setName("NuevoUsuario2");


	$app->get('/validacion/{token}',function($request,$response,$args){
		$token = $args['token'];
		$myObj = new \stdClass();
		if (ctr_usuario::activarUsuario($token)) {
			$myObj->retorno = true;
		}else{
			$myObj->retorno = false;
		}
		return json_encode($myObj);
	});

	$app->post('/usuario/login',function($request,$response,$args) use ($container){
		$data = $request->getParams();
		$email=$data['correo'];
		$pass=$data['pass'];
		$myObj = new \stdClass();

		if(ctr_usuario::login($email,$pass)){
			$myObj->retorno = true; //o false
		}else{
			$myObj->retorno = false; //o false
		}
		return json_encode($myObj);

	})->setName("NuevoUsuario");

	$app->get('/usuario/SeguirElemento',function($request,$response,$args) use ($container){
		$correo=$request->getQueryParam("correo");
		$id=$request->getQueryParam("id");
		$insertar = ctr_usuario::SeguirElemento($correo,$id);
		$myObj = new \stdClass();
		if($insertar == "1"){
			$myObj->retorno = true;
		}else{
			$myObj->retorno = false;
		}
		return json_encode($myObj);
	})->setName("SeguirElemento");

	$app->get('/usuario/DejarSeguirElemento',function($request,$response,$args) use ($container){
		$correo=$request->getQueryParam("correo");
		$id=$request->getQueryParam("id");
		$insertar = ctr_usuario::DejarSeguirElemento($correo,$id);
		$myObj = new \stdClass();
		if($insertar == "1"){
			$myObj->retorno = true;
		}else{
			$myObj->retorno = false;
		}
		return json_encode($myObj);
	})->setName("DejarSeguirElemento");

	$app->get('/usuario/{correo}',function($request,$response,$args){
		$email = $args['correo'];
		$myObj = new \stdClass();
		return json_encode(ctr_usuario::obtenerUsuario($email));
	});

	$app->get('/usuario/desactivar/{correo}',function($request,$response,$args){
		$email = $args['correo'];
		$myObj = new \stdClass();

		if(ctr_usuario::desactivarUsuario($email)){
			$myObj->retorno = true; //o false
		}else{
			$myObj->retorno = false; //o false
		}
		return json_encode($myObj);
	});

	$app->post('/usuario/editar',function($request,$response,$args) use ($container){
		$data = $request->getParams();
		$nombre=$data['nombre'];
		$apellido=$data['apellido'];
		$edad=$data['edad'];
		$email=$data['correo'];
		$foto = $data['foto'];

		$myObj = new \stdClass();

		if(ctr_usuario::actualizarUsuario($email,$nombre,$apellido,$edad,$foto)){
			$myObj->retorno = true;
		}else{
			$myObj->retorno = false;
		}
		return json_encode($myObj);
	});

	$app->get('/usuario/notificaciones/{correo}', function($request,$response,$args){
		$correo = $args['correo'];
		$notificaciones = ctr_usuario::listarNotificaciones($correo);
		return $notificaciones;
	})->setName("Listar_Notificaciones");


}?>
