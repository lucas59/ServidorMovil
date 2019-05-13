<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {

	$routesUsus = require_once __DIR__ . "/../src/routes_usuarios.php";
	$routesProyectos = require_once __DIR__ . "/../src/routes_contenido.php";
	$container = $app->getContainer();

	$routesUsus($app);
	$routesProyectos($app);

	$container = $app->getContainer();

	$app->get('/', function (Request $request, Response $response, array $args) use ($container) {
       
		
	});
};
