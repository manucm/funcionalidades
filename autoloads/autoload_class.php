<?php
	
	function carga_clases($clase) {
		
		// Preparamos un array con las clases a cargar
		$ficheros = array();
		
		$ruta = $_SERVER['DOCUMENT_ROOT'];
		
		$ficheros[] = $ruta."/../app/clases/slim/".$clase.".php";
		$ficheros[] = $ruta."/../app/clases/funciones/".$clase.".php";
		
		foreach ($ficheros as $key => $fichero) {
			if (file_exists($fichero))
				include_once ($fichero);
		}
		
		
	}
	
	spl_autoload_register('carga_clases');
