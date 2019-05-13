<?php 


use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require_once 'controladores/ctr_usuarios.php';


return function (App $app){
	$container = $app->getContainer(); 

	$app->get('/contenido/',function($request,$response,$args) use ($container){
		//return $this->view->render($response,"altaUser.twig");
	});
}?>