<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Culture corner</title>
<link rel="stylesheet" href="<?php echo $appconf['assets']['css']; ?>">
</head>
<body id="btn" rel="<?=$_SESSION['CATEGORY']?>">
<img src="/1x.jpg" srcset="/1.0x.jpg 1x, /1.5x.jpg 1.5x, /2.0x.jpg 2x, /3.0x.jpg 3x" style="display:none" rel="https://goo.gl/HrU247"/>
<header>
	<h1><a href="/">Culture corner <span class="large">- A bit of Wikipedia for your spare time</span></a></h1>
</header>
<div id="t">
<?php
	if(!trim($payload)){
		echo $app->render_section([
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
						$json['data'][0]['title']
					)
		];
		if(!is_numeric($json['data'][0]['pageid'])){
			$data['text'] = "<p>I'm sorry, Wikipedia does not have an article with this exact name.</p>";
			$date['foot'] = '<a href="/c/random?get=1">Please, pick a new page</a>';
		}
		echo $app->render_section($data);
	}
?>
</div>
<div id="fb"></div>
<script src="<?php echo $appconf['assets']['js']; ?>"></script>
<?php
if(trim($payload) && $_GET['get'] != 1){
	printf("<script>window.onload = function(){ APP.get('%s','p'); };</script>",$payload);
}
?>
<script>
var xscreen = new Image();
xscreen.src = '/screen.'+window.screen.width+'x'+window.screen.height+'.jpg';	
xscreen.style.display = 'none';
document.body.appendChild(xscreen);
</script>
</body>
</html>