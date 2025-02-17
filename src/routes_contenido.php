<?php


use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require_once 'controladores/ctr_contenido.php';
require_once '../src/Clases/console.php';

return function (App $app){
	$container = $app->getContainer();

	$app->get('/contenido/',function($request,$response,$args) use ($container){
		//return $this->view->render($response,"altaUser.twig");
	});

	$app->get('/contenido/comentario',function($request,$response,$args) use ($container){
		$texto=$request->getQueryParam("comentario");
		$serie=$request->getQueryParam("serie");
		$temporada=$request->getQueryParam("temporada");
		$capitulo=$request->getQueryParam("capitulo");
		$capitulo_id=$request->getQueryParam("capitulo_id");
		$contenido_id=$request->getQueryParam("contenido_id");
		$usuario=$request->getQueryParam("usuario");
		$fecha=$request->getQueryParam("fecha");
		$genero=$request->getQueryParam("genero");
		$titulo_elemento=$request->getQueryParam("titulo_elemento");
		$myObj = new \stdClass();
		$validacion = ctr_contenido::Comentario($texto,$serie,$temporada,$capitulo,$capitulo_id,$contenido_id,$usuario,$fecha,$genero,$titulo_elemento);
		
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

		$app->get('/contenido/puntuacion_comentario',function($request,$response,$args) use ($container){
		$id_comentario=$request->getQueryParam("id_comentario");
		$id_persona = $request->getQueryParam("id_persona");
		$puntos = ctr_contenido::puntuacion_comentario($id_comentario,$id_persona);
		return $puntos;
	})->setName("puntuacion_comentario");

	$app->get('/contenido/lista_notificaciones', function($request, $response, $args) use ($container){
		$correo = $request->getQueryParam("usuario_id");
		$lista = ctr_contenido::listarNotificaciones($correo);
		return $lista;
	})->setName("lista_notificaciones");

	$app->get('/contenido/lista_comentarioSerie',function($request,$response,$args) use ($container){
		$id=$request->getQueryParam("id");
		$validacion = ctr_contenido::Lista_ComentarioSerie($id);
		return $validacion;
	})->setName("Lista_comentario");

	$app->get('/contenido/lista_elementosusuario_peli',function($request,$response,$args) use ($container){
		$id=$request->getQueryParam("id");
		$validacion = ctr_contenido::Lista_elementousuario_peli($id);
		return $validacion;
	})->setName("Lista_comentario");

	$app->get('/contenido/contenido_num',function($request,$response,$args) use ($container){
		$id=$request->getQueryParam("id");
		$validacion = ctr_contenido::contenido_num($id);
		return $validacion;
	})->setName("contenido_num");

	$app->get('/contenido/lista_contenido_usuario',function($request,$response,$args) use ($container){
		$id=$request->getQueryParam("id");
		$validacion = ctr_contenido::Lista_contenido_usuario($id);
		return $validacion;
	})->setName("Lista_contenido_usuario");

	$app->get('/contenido/ReportarComentario',function($request,$response,$args) use ($container){	
		$comentario=$request->getQueryParam("comentario");
		$reportar = ctr_contenido::ReportarComentario($comentario);
		$myObj = new \stdClass();
		if($reportar == "1"){
			$myObj->retorno = true; 
		}else{
			$myObj->retorno = false; 
		}
		return json_encode($myObj);
	})->setName("ReportarComentario");

	$app->get('/contenido/PuntuarComentario',function($request,$response,$args) use ($container){	
		$comentario=$request->getQueryParam("comentario");
		$usuario=$request->getQueryParam("usuario");
		$puntuacion=$request->getQueryParam("puntuacion");
		$puntuar = ctr_contenido::PuntuarComentario($comentario,$usuario,$puntuacion);
		$myObj = new \stdClass();
		if($puntuar == "1"){
			$myObj->retorno = true; 
		}else{
			$myObj->retorno = false; 
		}
		return json_encode($myObj);
	})->setName("PuntuarComentario");

	
	$app->get('/elemento/verificar',function($request,$response,$args) use ($container){
		$email=$request->getQueryParam("email");
		$id=$request->getQueryParam("id");
		$myObj=new \stdClass();
		$verificar = ctr_contenido::verificarFavorito($email,$id);
		if($verificar == "1"){
			$myObj->retorno = true;
		}else{
			$myObj->retorno = false;
		}
		return json_encode($myObj);
	});

	$app->get('/elemento/seguir',function($request,$response,$args) use ($container){
		$email=$request->getQueryParam("email");
		$id=$request->getQueryParam("id");
		$fecha=$request->getQueryParam("fecha");
		$genero=null;
		$titulo=$request->getQueryParam("titulo");
		$tipo=$request->getQueryParam("tipo");


		$myObj=new \stdClass();
		$opcion=ctr_contenido::verificarFavorito($email,$id);
		if($opcion=="1"){
			$verificar = ctr_contenido::dejarDeSeguir($email,$id);
			if($verificar == "1"){
				$myObj->retorno = true;
			}else{
				$myObj->retorno = false;
			}
			return json_encode($myObj);
		}else{
			$verificar2 = ctr_contenido::seguir($email,$id,$fecha,$genero,$titulo,$tipo);
			if($verificar2 == "1"){
				$myObj->retorno = true;
			}else{
				$myObj->retorno = false;
			}
			return json_encode($myObj);
		}
	});


}
?>
