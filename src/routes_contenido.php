<?php 


use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require_once 'controladores/ctr_contenido.php';


return function (App $app){
	$container = $app->getContainer(); 

	$app->get('/contenido/',function($request,$response,$args) use ($container){
		//return $this->view->render($response,"altaUser.twig");
	});


$app->post('/contenido/comentario',function($request,$response,$args) use ($container){
		$data = $request->getParams();
		$texto=$data['comentario'];
		$titulo=$data['titulo'];
		$capitulo_id=$data['capitulo_id'];
		$contenido_id=$data['contenido_id'];
		$usuario=$data['usuario'];
		$myObj = new \stdClass();
		if(ctr_contenido::Comentario($texto,$titulo,$capitulo_id,$contenido_id,$usuario)){
			$myObj->retorno = true; 
		}else{
			$myObj->retorno = false; 
		}
		return json_encode($myObj);

	})->setName("NuevoUsuario");



}
?>