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
		$fecha=$data['fecha'];
		$genero=$data['genero'];
		$titulo_elemento=$data['titulo_elemento'];
		$myObj = new \stdClass();
		$validacion = ctr_contenido::Comentario($texto,$titulo,$capitulo_id,$contenido_id,$usuario,$fecha,$genero,$titulo_elemento);
		if($validacion == "1"){
			$myObj->retorno = true; 
		}else{
			$myObj->retorno = false; 
		}
		return json_encode($myObj);

	})->setName("Comentario");



}
?>