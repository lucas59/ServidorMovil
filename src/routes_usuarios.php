<?php 


use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require_once 'controladores/ctr_usuario.php';

return function (App $app){
	$container = $app->getContainer(); 

	$app->post('/usuario/nuevo',function($request,$response,$args) use ($container){
		/*$data = $request->getParams();
		$email=$data['correo'];
		$pass=$data['pass'];
		return  ctr_usuario::altaUser($email,$pass);	*/
		return "true";
	});

	$app->get('/validacion/[{token}]',function($request,$response,$args){
		$params=$request->getParams();
		$token = $params['token'];

		echo ctr_usuario::activarUsuario($token);
		echo "string";
	});

}?>