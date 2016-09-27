<?php
include('etc/conf.php');
include('libs/app.helper.php');
include('libs/app.base.php');


$app = new Appbase;
$request = current(explode('?',$_SERVER['REQUEST_URI'],2));

$nojs = false;
if($_GET['get'] == 1){
	$nojs = true;
}

switch (true):


	/**
	 * Render page title
	 */
	case $request == '/':
	case preg_match('/^\/w\/(.*?)$/',$request,$q):

		$payload = $q[1];
		if($nojs || $payload){
			if($page = $app->api_get_page($payload,'title')){
				$json = [
					'ok' => true,
					'timestamp' => time(),
					'uuid' => $app->uuidgen(),
					'data' => [$page]
				];
				$nojs = true;
				include('tpl/main.php');
			}else{
				$app->error = 500;
				include('tpl/error.php');
			};			
		}else{
			include('tpl/main.php');
		}
		
		break;


	/**
	 * Query page title
	 */
	case preg_match('/^\/q\/(.*?)$/',$request,$q):

		$payload = $q[1];
		if($page = $app->api_get_page($payload,'title')){
			$json = [
				'ok' => true,
				'timestamp' => time(),
				'uuid' => $app->uuidgen(),
				'data' => [$page]
			];
			header('Content-Type: application/json');
			echo json_encode($json);
		}else{
			$app->error = 500;
			include('tpl/error.php');
		}
		
		break;		

	/**
	 * Query category
	 */
	case preg_match('/^\/c\/(.*?)$/',$request,$q):

		$payload = $q[1];
		$_SESSION['CATEGORY'] = $payload;

		$pageid = null; $i=0;
		while(!is_numeric($pageid)){
			$pageid = $app->api_get_pageid_from_category($app->extract_category_from_group($payload));
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
			if($nojs){
				header(sprintf('Location: /w/%s',$app->helper_title2url($json['data'][0]['title'])));
				die();
			}
			header('Content-Type: application/json');
			echo json_encode($json);
		}else{
			$app->error = 500;
			include('tpl/error.php');
		}		
		
		break;
		
	case preg_match('/\/([0-9\.]{1,})x\.jpg/', $request, $q):

		if(is_numeric($q[1])){
			$_SESSION['DPR'] = $q[1];
		}else{
			$_SESSION['DPR'] = 1;
		}
		header('Content-type: image/jpeg');
		header('X-MHZ-DPR: '.$_SESSION['DPR']);

		break;

	case preg_match('/^\/screen\.([0-9]{1,})x([0-9]{1,})\.jpg$/', $request, $q):
		header('Content-type: image/jpeg');
		if(is_numeric($q[1]) && is_numeric($q[2])){
			header('X-MHZ-SCREEN-X: '.$q[1]);
			header('X-MHZ-SCREEN-Y: '.$q[2]);
			$_SESSION['SCREEN-X'] = $q[1];
			$_SESSION['SCREEN-Y'] = $q[2];
		}
		break;		

	default:
		$app->error = 404;
		include('tpl/error.php');
		break;

endswitch;

die();