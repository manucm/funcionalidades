<?php
	
	require_once __DIR__."/rest.php";
	
	$app->get("/", function() use ($app) {
		
		$objProducto = new Productos();
		
		$producto = $objProducto->getById('ES101');
		//$producto = Productos::factory()->find_array();
		Kint::dump($producto);
		
		
		
		$app->render("layout.html.twig", array('title'=>"titulo"));
	});
	
