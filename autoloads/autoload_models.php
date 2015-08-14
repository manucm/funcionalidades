<?php
	
	function carga_modelos($modelo) {
		
		$ruta = $_SERVER['DOCUMENT_ROOT'];
		
		$fichero = $ruta."/../app/models/".$modelo.".php";
		
		if (file_exists($fichero))
			include_once ($fichero);
	}
	
	spl_autoload_register('carga_modelos');
