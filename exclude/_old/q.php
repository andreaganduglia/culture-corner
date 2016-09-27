<?php
include('etc/conf.php');
include('libs/3p.httpful.phar');
include('libs/app.helper.php');
include('libs/app.base.php');

$app = new Appbase;

if(trim($_GET['q'])){
	if($page = $app->api_get_page($_GET['q'],'title')){
		$json = [
			'ok' => true,
			'timestamp' => time(),
			'uuid' => $app->uuidgen(),
			'data' => [$page]
		];
		header('Content-Type: application/json');
		echo json_encode($json);
	}else{
		header("HTTP/1.1 500 Internal Server Error");
	}
}else{

	$pageid = null; $i=0;
	while(!is_numeric($pageid)){
		$pageid = $app->api_get_pageid_from_category($app->extract_category_from_group($_GET['c']));
		$i++;
		if($i > 3){ $pageid = 0; break; }
	}

	if($page = $app->api_get_page($pageid,'pageid')){
		$json = [
			'ok' => true,
			'timestamp' => time(),
			'uuid' => $app->uuidgen(),
			'data' => [$page]
		];
		header('Content-Type: application/json');
		echo json_encode($json);
	}else{
		header("HTTP/1.1 500 Internal Server Error");
	}
}
die();