<?php

	// Incluimos los ficheros que son necesarios
	include_once __DIR__."/../vendor/autoload.php";
	include_once __DIR__."/../autoloads/autoload_class.php";
	include_once __DIR__."/../autoloads/autoload_models.php";
	require_once __DIR__."/../app/config/config.php";

	// Cargamos el motor de plantillas
	Twig_Autoloader::register();
	
	// Configuramos la base de datos
	/*ORM::configure("mysql:host=".dbhost);
	ORM::configure("mysql:dbname=".dbdatabase);
	ORM::configure("charset=utf8");*/
	ORM::configure(dbconf);
	ORM::configure("username", dbuser);
	ORM::configure("password", dbpass);
	
	// Obtenemos la instancia de Slim
	$app = new SlimExt(array(
		"templates.path"=>"../app/templates",
		"view"=>new \Slim\Views\Twig()
	));

	require_once __DIR__."/../app/controller/rutas.php";
	
	$app->run();
