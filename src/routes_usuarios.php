<?php 


use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require_once 'controladores/ctr_usuario.php';

return function (App $app){
	$container = $app->getContainer(); 

	$app->post('/usuario/nuevo',function($request,$response,$args) use ($container){
		$data = $request->getParams();
		$email=$data['correo'];
		$pass=$data['pass'];

		$myObj = new \stdClass();
		
		if(ctr_usuario::altaUser($email,$pass)){
			$myObj->retorno = true; 
		}else{
			$myObj->retorno = false;
		}
		return json_encode($myObj);

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




}?>