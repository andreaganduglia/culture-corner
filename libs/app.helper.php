<?php

trait Apphelper {

	/**
	 * Load $appconf from conf.php
	 */
	public function __construct()
	{
		global $appconf;
		$this->appconf = $appconf;
		unset($appconf);
	}

	/**
	 * Apply and array of fuctions to $input
	 * 
	 * @param  mix $input The input
	 * @param  array  $fns   List of functions
	 * @return The result!        
	 */
	function waterfall($input=NULL,$fns=array())
	{
	   $input = array_reduce($fns, function($result, $fn) {
	     return $fn($result);
	   }, $input);
	   return $input;
	}

	/**
	 * callback is a short way to $this->waterfall
	 * 
	 */
	function callback($input=NULL,$function='empty')
	{
		return $this->waterfall($input,array($function));
	}


	function pp($array)
	{
		if(PHP_SAPI == 'cli'){
			print_r($array);
			echo "\n";
			return TRUE;
		}
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}

	function uuidgen()
	{
		$y = ['8','9','a','b'];
		$uuid = md5(uniqid(mt_rand(),true));
		$uuid = substr($uuid,0,8)."-".substr($uuid,8,4)."-".substr($uuid,12,4)."-".substr($uuid,16,4)."-".substr($uuid,20,12);
		$uuid[14] = 4;
		$uuid[19] = $y[rand(0,3)];
		return $uuid;
	}

	/**
	 * HTTP GET WRAPPER
	 * @param  string $url  End point
	 * @param  array  $pars Parameters
	 * @return RESPONSE
	 */
	public function http_get($url,$pars=array())
	{
		$body = null; 
		$response = [];
		$headers = [];

		$body = file_get_contents($url);
		$headers = $this->callback($http_response_header,function($i){
			$o = [];
			foreach($i as $k => $v) {
				switch (true) {
					case preg_match('/^HTTP\/([0-9\.]+)\s+([0-9]{3})\s+(.*?)$/',$v,$r):
						$o['http'] = $r[1];
						$o['code'] = $r[2];
						$o['name'] = $r[3];
					break;
					case preg_match('/^(.*?):\s+(.*?)$/',$v,$r):
						$o[strtolower(trim($r[1]))] = trim($r[2]);
					break;
				}
			}
			return $o;
		});

		if($body){
			$response = [
				'body' => $body,
				'code' => $headers['code'],
				'status' => 'ok',
				'error' => [],
				'headers' => $headers
			];
		}else{
			$response = [
				'body' => null,
				'code' => $headers['code'],
				'status' => 'err',
				'error' => ['msg' => 'Filed to open stream'],
				'headers' => $headers
			];			
		}

		if($pars['flushout'] == 1){
			return $response;
		}else{
			$this->http_get_response = $response;
			$this->http_last_responde = $response;
			unset($response);			
		}
	}

    /**
     * Elebora un template in linea, basato su testo
     * @param  str 	  $template 
     * @param  array  $vars     ['key' => 'value']
     * @return str 	  HTML elaborato
	 *
	 * es.
     * <strong>${KEY}</strong>
     * IF{KEY}<strong>${KEY}</strong>END{KEY}
     * 
     * Le KEY possono essere composte di lettere e numeri e devono essere maiuscole
     * ${KEY} IF{KEY}...END{KEY}
     */    
    public function microtemplate($template=null,$vars=array()){
    	foreach($vars as $k => $v){
    		$regex = sprintf('/IF{%s}(.*?)END{%s}/sim',strtoupper($k),strtoupper($k));
    		if(trim($v)){
    			$template = preg_replace($regex, '\\1', $template);
    		}else{
    			$template = preg_replace($regex, null, $template);
    		}
    	}
    	foreach($vars as $k => $v) {
    		$template = str_replace(sprintf('${%s}',strtoupper($k)), $v, $template);
    	}
    	$template = preg_replace('/\${(\w|\d)+}/sim', null, $template);
    	return $template;
    }	

}