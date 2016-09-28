<?php
$HTML = [];
$HTML[] = '<!DOCTYPE html>';
$HTML[] = '<html lang="en">';
$HTML[] = '<head>';
$HTML[] = '<meta charset="utf-8">';
$HTML[] = '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
$HTML[] = '<title>Culture corner</title>';
$HTML[] = sprintf('<link rel="stylesheet" href="%s">',$appconf['assets']['css']);
$HTML[] = '</head>';
$HTML[] = sprintf('<body id="btn" rel="%s">',$_SESSION['CATEGORY']);
$HTML[] = '<img src="/1x.jpg" srcset="/1.0x.jpg 1x, /1.5x.jpg 1.5x, /2.0x.jpg 2x, /3.0x.jpg 3x" style="display:none" rel="https://goo.gl/HrU247"/>';
$HTML[] = '<header>';
$HTML[] = '<h1><a href="/">Culture corner <span class="large">- A bit of Wikipedia for your spare time</span></a></h1>';
$HTML[] = '</header>';
$HTML[] = '<div id="t">';
if($frontpage){
	$HTML[] = $app->render_section([
		'class' => 'frontpage',
		'h1' => 'Culture corner',
		'h2' => 'A bit of Wikipedia from your spare time',
		'text' => '<p><em>Learning never exhausts the mind.</em> (<a href="/w/Leonardo_da_Vinci" class="start" rel=\'["Leonardo_da_Vinci","p"]\'>cit</a>)<br>So, press start or choose a topic below and learn something.<br>Have fun!</p>'.
				  '<p><a href="/c/null?get=1" class="starter start" rel=\'["","lc"]\'>START</a></p>'.
				  '<ul class="rel">'.
				  $app->callback($appconf['categories'],function($i){
				  		$o = [];
				  		ksort($i);
					foreach($i as $k => $v) {
						$o[] = sprintf("<li><a href=\"/c/%s?get=1\" class=\"start\" rel='[\"%s\",\"c\"]'>%s</a></li>",$k,$k,$v['label']);
					}   
					return implode('',$o);					  		
				  }).
				  '</ul>',
		'foot' => null
	]);
}
if($nojs && $payload){
	$data = [
		'class' => null,
		'h1' => $json['data'][0]['title'],
		'h2' => $json['data'][0]['terms']['description'],
		'text' => sprintf('<p>%s</p>',$json['data'][0]['extract']),
		'foot' => sprintf(
					'<a href="/c/random?get=1" class="nx">Next</a> <a href="https://en.wikipedia.org/wiki/%s"><span class="large">Full article</span> on Wikipedia</a>',
					urlencode($json['data'][0]['title'])
				)
	];
	if(!is_numeric($json['data'][0]['pageid'])){
		$data['text'] = "<p>I'm sorry, Wikipedia does not have an article with this exact name.</p>";
		$date['foot'] = '<a href="/c/random?get=1">Please, pick a new page</a>';
	}
	$HTML[] = $app->render_section($data);
	$HTML[] = $app->render_section_rights([
		'title' => $json['data'][0]['title'],
		'title_url' => urlencode($json['data'][0]['title']),
		'url' => $json['data'][0]['rights']['url'],
		'text' => $json['data'][0]['rights']['text']
	]);
}
$HTML[] = '</div>';
$HTML[] = '<div id="fb"></div>';
$HTML[] = sprintf('<script src="%s"></script>',$appconf['assets']['js']);
if(trim($payload) && $_GET['get'] != 1){
	$HTML[] = sprintf("<script>window.onload = function(){ APP.get('%s','p'); };</script>",$payload);
}
$HTML[] = "<script>";
$HTML[] = "var xscreen = new Image();";
$HTML[] = "xscreen.src = '/screen.'+window.screen.width+'x'+window.screen.height+'.jpg';";
$HTML[] = "xscreen.style.display = 'none';";
$HTML[] = "document.body.appendChild(xscreen);";
$HTML[] = "</script>";
$HTML[] = "</body>";
$HTML[] = "</html>";

echo $app->waterfall($HTML,[
	function($i){ return implode(PHP_EOL,$i); },
	//function($i){ return str_replace(["\n",PHP_EOL], null, $i); },
	//function($i){ return preg_replace('/\s+/', "\040", $i); }
]);
die();