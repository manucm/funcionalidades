<?php
	
	/**
	 * Petición get, mostrar elementos
	 */
	$app->get("/rest/:rested", function($rested) use ($app) {
		
		// Obtenemos los datos de la clase Metadatos
		$datos = new Acceso_datos($rested); $array = array('opciones');
		$columnas = $datos->add_optionsTocolumnas_tabla($array);
		
		// Obtenemos todos los datos de la tabla
		$registros = $datos->all_dates();
		
		
		foreach ($registros as $key => $value) {
			
			//$host = $app->request()->getHost(); 
			$url = $app->urlFor('show-one', array('rested'=>$rested, 'id'=>$value[$columnas[0]]));
			$url_edit = $app->urlFor('edit', array('rested'=>$rested, 'id'=>$value[$columnas[0]]));
			$url_delete = $app->urlFor('delete', array('rested'=>$rested, 'id'=>$value[$columnas[0]]));
			$borrado = "'Desea borrar la pregunta'";
			
			$registros[$key]['opciones']= '<a href="'.$url.'"><i class="fa fa-search cursor"></i></a>   '.
										   '<a href="'.$url_edit.'"><i class="fa fa-pencil cursor"></i></a>   '.  
										   '<form class="in-line" method="post" action="'.$url_delete.'"> '.
										   '<input type="hidden" name="_METHOD" value="DELETE"/>'.
										   '<label for="borrar'.$value[$columnas[0]].'"><i class="fa fa-trash-o"></i></label>'.
										   '<button style="display:none" id="borrar'.$value[$columnas[0]].'" type="submit" onClick="return confirm('.$borrado.');"></button>'.
										   '</form>   ';
		}
		
		// Enviamos los datos a la vista
		$app->render('rest/index.html.twig', array('registros'=>$registros, 
													'columnas'=>$columnas,
													'rested'=>$rested));	
	})->name('index');
	
	/**
	 * Petición, enviamos json
	 */
	$app->get("/rest/:rested/json", function($rested) use ($app) {
		// Obtenemos los datos de la clase Metadatos
		$datos = new Acceso_datos($rested); $array = array('opciones');
		$columnas = $datos->columnas_tabla();
		
		// Obtenemos todos los datos de la tabla
		$registros = $datos->all_dates();
		
		$enviar_datos = array('columnas'=>$columnas,
							  'registros'=>$registros);
							  
		echo json_encode($enviar_datos);
	});
	
	/**
	 * Enviar al formulario de creación
	 */
	$app->get("/rest/:rested/new", function($rested) use ($app) {
		
		// Obtenemos la instancia del acceso a datos
		$datos = new Acceso_datos($rested);
		
		// Obtenemos las columnas de la tabla
		$columnas = $datos->columnas_tabla();
		
		// Pasamos a la vista
		$app->render('rest/new.html.twig', array('title'=>'Crear '.$rested,
												  'rested'=>$rested,
												  'columnas'=>$columnas));
	});
	
	/**
	 * Mostrar un elemento
	 */
	$app->get("/rest/:rested/:id", function($rested, $id) use ($app) {
		
		// Obtenemos la instancia del acceso a datos
		$datos = new Acceso_datos($rested);
		
		// Obtenemos las columnas de la tabla
		$columnas = $datos->columnas_tabla();
		
		// Obtenemos los datos del elemento
		$elemento = $datos->getArrayById($id);
		
		// Pasamos a la vista
		$app->render('rest/show.html.twig', array('title'=>'Visualizar '.$rested,
												  'elemento'=>$elemento,
												  'columnas'=>$columnas));
	})->name('show-one');
	
	/**
	 * Enviar al formulario de edición
	 */
	$app->get("/rest/:rested/:id/edit", function($rested, $id) use ($app) {
		// Obtenemos la instancia del acceso a datos
		$datos = new Acceso_datos($rested);
		
		// Obtenemos las columnas de la tabla
		$columnas = $datos->columnas_tabla();
		
		// Obtenemos los datos del elemento
		$elemento = $datos->getArrayById($id);
		
		// Pasamos a la vista
		$app->render('rest/edit.html.twig', array('title'=>'Editar '.$rested,
												  'rested'=>$rested,
												  'id'=>$id,
												  'elemento'=>$elemento,
												  'columnas'=>$columnas));
	})->name('edit');
	
	/**
	 * Actualizar
	 */
	$app->put("/rest/:rested/:id/update", function($rested, $id) use ($app) {
		// Obtenemos la instancia del acceso a datos
		$datos = new Acceso_datos($rested);
		
		// Guardamos los datos que se han enviado por post
		$datos->save($_POST, $id);
		
		$app->redirect($app->urlFor('index', array('rested'=>$rested)));
	});
	
	/**
	 * Crear
	 */
	$app->post("/rest/:rested/create", function($rested) use ($app) {
		// Obtenemos la instancia del acceso a datos
		$datos = new Acceso_datos($rested);
		
		// Guardamos los datos que se han enviado por post
		$datos->save($_POST);
		
		$app->redirect($app->urlFor('index', array('rested'=>$rested)));
	});
	
	/**
	 * Borrado
	 */
	$app->delete("/rest/:rested/:id", function($rested, $id) use ($app) {
		$datos = new Acceso_datos($rested);
		
		// Guardamos los datos que se han enviado por post
		$datos->delete($id);
		
		$app->redirect($app->urlFor('index', array('rested'=>$rested)));
	})->name('delete');
