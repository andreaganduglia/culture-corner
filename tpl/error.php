<?php

switch ($app->error) {
	case '404':
		$error = [
			'code' => '404',
			'name' => 'Not found',
			'link' => '/w/HTTP_404'
		];
		break;

	case '403':
		$error = [
			'code' => '403',
			'name' => 'Forbidden',
			'link' => '/w/HTTP_403'
		];
		break;		

	case '500':
		$error = [
			'code' => '500',
			'name' => 'Internal Server Error',
			'link' => '/w/List_of_HTTP_status_codes'
		];
		break;		
	
	default:
	case '400':
		$error = [
			'code' => '400',
			'name' => 'Bad Request',
			'link' => '/w/List_of_HTTP_status_codes'
		];
		break;
}


header(sprintf("HTTP/1.1 %d %s",$error['code'],$error['name']));
$template = '<!DOCTYPE html><head><title>${CODE} ${NAME}</title></head><body style="text-align:center"><h1>${CODE} ${NAME}</h1><p><a href="${LINK}">What is that mean?</a></p></body></html>';
echo $app->microtemplate($template,$error);
die();