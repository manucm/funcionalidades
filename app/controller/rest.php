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
		
		Kint::dump($registros);
		
		foreach ($registros as $key => $value) {
			
			//$host = $app->request()->getHost(); 
			$url = $app->urlFor('show-one', array('rested'=>$rested, 'id'=>$value[$columnas[0]]));
			$url_edit = $app->urlFor('edit', array('rested'=>$rested, 'id'=>$value[$columnas[0]]));
			$url_delete = $app->urlFor('delete', array('id'=>$value[$columnas[0]]));
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
		$app->render('layout.html.twig', array('registros'=>$registros, 'columnas'=>$columnas));	
	});
	
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
	 * Mostrar un elemento
	 */
	$app->get("/rest/:rested/:id", function($rested, $id) use ($app) {
		
		$datos = new Acceso_datos($rested);
		
		$elemento = $datos->getById($id);
		
		Kint::dump($elemento);
	})->name('show-one');
	
	/**
	 * Enviar al formulario de creación
	 */
	$app->get("/rest/:rested/new", function() use ($app) {
		
	});
	
	/**
	 * Enviar al formulario de edición
	 */
	$app->get("/rest/:rested/:id/edit", function() use ($app) {
		echo "formulario edicion";
	})->name('edit');
	
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
	$app->delete("/rest/:id", function($id) use ($app) {
		echo "Borrado $id";
	})->name('delete');
