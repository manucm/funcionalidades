<?php
	
	/**
	 * Petición get, mostrar elementos
	 */
	$app->get("/rest/:rested", function($rested) use ($app) {
		
		// Obtenemos los datos de la clase Metadatos
		$datos = new Metadatos($rested); $array = array('opciones');
		$columnas = $datos->add_optionsTocolumnas_tabla($array);
		
		// Obtenemos todos los datos de la tabla
		$registros = $datos->all_dates();
		
		// Enviamos los datos a la vista
		$app->render('layout.html.twig', array('registros'=>$registros, 'columnas'=>$columnas));	
	});
	
	/**
	 * Petición, enviamos json
	 */
	$app->get("/rest/:rested/json", function($rested) use ($app) {
		// Obtenemos los datos de la clase Metadatos
		$datos = new Metadatos($rested); $array = array('opciones');
		$columnas = $datos->columnas_tabla();
		
		// Obtenemos todos los datos de la tabla
		$registros = $datos->all_dates();
		
		$enviar_datos = array('columnas'=>$columnas,
							  'registros'=>$registros);
							  
		echo json_encode($enviar_datos);
	});
	
	/**
	 * Mostrar un elemento
	 */
	$app->get("/rest/:rested/:id", function() use ($app) {
		
	});
	
	/**
	 * Enviar al formulario de creación
	 */
	$app->get("/rest/:rested/new", function() use ($app) {
		
	});
	
	/**
	 * Enviar al formulario de edición
	 */
	$app->get("/rest/:rested/:id/edit", function() use ($app) {
		
	});
	
	/**
	 * Actualizar
	 */
	$app->put("/rest/:rested/:id/update", function() use ($app) {
		
	});
	
	/**
	 * Crear
	 */
	$app->post("/rest/created", function() use ($app) {
		
	});
	
	/**
	 * Borrado
	 */
	$app->delete("/rest", function() use ($app) {
		
	});
