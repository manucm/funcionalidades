<?php
	
	require_once __DIR__."/rest.php";
	require_once __DIR__."/get_data.php";
	
	$app->get("/", function() use ($app) {
		
		
		
		
		$app->render("layout.html.twig", array('title'=>"titulo"));
	});
	
