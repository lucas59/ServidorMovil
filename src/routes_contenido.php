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


	$app->get('/contenido/comentario',function($request,$response,$args) use ($container){
		$texto=$request->getQueryParam("comentario");
		$capitulo_id=$request->getQueryParam("capitulo_id");
		$contenido_id=$request->getQueryParam("contenido_id");
		$usuario=$request->getQueryParam("usuario");
		$fecha=$request->getQueryParam("fecha");
		$genero=$request->getQueryParam("genero");
		$titulo_elemento=$request->getQueryParam("titulo_elemento");
		$myObj = new \stdClass();
		$validacion = ctr_contenido::Comentario($texto,$capitulo_id,$contenido_id,$usuario,$fecha,$genero,$titulo_elemento);
		if($validacion == "1"){
			$myObj->retorno = true; 
		}else{
			$myObj->retorno = false; 
		}
		return json_encode($myObj);

	})->setName("Comentario");

	$app->get('/contenido/lista_comentario',function($request,$response,$args) use ($container){
		$id=$request->getQueryParam("id");
		$validacion = ctr_contenido::Lista_Comentario($id);
		return $validacion;
	})->setName("Lista_comentario");



}
?>