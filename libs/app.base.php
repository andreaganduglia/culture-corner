<?php

Class Appbase {

	use Apphelper;

	/**
	 * Build Wikipedia API query string 
	 * @param  array $p 
	 * @return string   Query string
	 */
	public function build_api_url($p) 
	{
		return urldecode(sprintf('%s?%s',$this->appconf['apiendpoint'],http_build_query($p)));
	}	


	/**
	 * GET RANDOM PAGEID FROM CATEGORY
	 * https://en.wikipedia.org/wiki/?curid={ID}
	 *
	 * @param string $category Category name
	 * @return int PageID (or false)
	 */
	public function api_get_pageid_from_category($category)
	{

		if(!trim($category)){
			return $this->api_get_pageid_from_random();
		}

		$APIURL = $this->build_api_url(array(
			'action' => 'query',
			'list' => 'categorymembers',
			'cmlimit' => 500,
			'cmtitle' => sprintf('Category:%s',urlencode($category)),
			'format' => 'json',
			'cmnamespace' => 0
		));		

		$this->http_get($APIURL);

		if($this->http_get_response['status'] == 'ok' && $this->http_get_response['code'] == 200){
			$set = json_decode($this->http_get_response['body'],TRUE);
			$index = array_rand($set['query']['categorymembers'],1);
			return $set['query']['categorymembers'][$index]['pageid'];
		}

		return false;
	}

	/**
	 * GET RANDOM PAGEID 
	 * https://en.wikipedia.org/wiki/?curid={ID}
	 *
	 * @return int PageID (or false)
	 */
	public function api_get_pageid_from_random()
	{
	
		$APIURL = $this->build_api_url(array(
			'action' => 'query',
			'list' => 'random',
			'rnlimit' => 1,
			'format' => 'json',
			'rnnamespace' => 0
		));		

		$this->http_get($APIURL);

		if($this->http_get_response['status'] == 'ok' && $this->http_get_response['code'] == 200){
			$set = json_decode($this->http_get_response['body'],TRUE);
			return $set['query']['random'][0]['id'];
		}

		return false;
	}	

	/**
	 * GET PAGE FROM TITLE OR PAGEID
	 *
	 * @param int|string $token PageID or TitlePage
	 * @param string $from ['title','pageid']
	 *
	 * @return array Page info: title, extracts, links, categories, image
	 */
	public function api_get_page($token,$from)
	{

		if(!(($from == 'pageid' && is_numeric($token) && $token > 0) || ($from == 'title' && is_string($token)))){
			return false;
		}

		// Common parameters
		$api_parameters = [
			'action' => 'query',
			'format' => 'json',
			//'prop' => 'extracts|links|categories|pageterms|pageimages',
			'prop' => 'extracts|pageterms|pageimages|links',
			'exintro' => 'false',
			'exsentences' => '3',
			'explaintext' => 'true',
			'exsectionformat' => 'plain',
			'plnamespace' => '0',
			'pllimit' => '100',
			'clcategories' => $this->callback($this->appconf['categories'],function($i){
				$o = []; 
				foreach(explode(',', $i) as $k => $v){
					$o[] = sprintf('Category:%s',trim($v));
				}
				return implode('|',$o);
			}),
			'wbptterms' => 'description',
			'pithumbsize' => $this->callback(600,function($i){
				$DPR = 1; $SIZE = $i;
				if(is_numeric($_SESSION['DPR']) && $_SESSION['DPR'] > 0){
					$DPR = $_SESSION['DPR'];
				}
				$SIZE = $SIZE*$DPR;
				// prevent nonsense big image!
				if(is_numeric($_SESSION['SCREEN-X']) && $SIZE > ($_SESSION['SCREEN-X']*$DPR)){
					$SIZE = $_SESSION['SCREEN-X']*$DPR;
				}
				return $SIZE;
			})
		];

		// Set pageids
		if($from == 'pageid' && is_numeric($token)){
			$api_parameters['pageids'] = sprintf('%d',$token);
		}

		// Set titles
		if($from == 'title' && is_string($token)){
			$api_parameters['titles'] = str_replace("\040", '_', $token);	
		}

		// Build the query
		$APIURL = $this->build_api_url($api_parameters);

		// Run the query
		$this->http_get($APIURL);

		if($this->http_get_response['status'] == 'ok' && $this->http_get_response['code'] == 200){
			$set = json_decode($this->http_get_response['body'],TRUE);
			$set = current($set['query']['pages']);

			// I want 10 links random
			shuffle($set['links']);
			$set['links'] = array_slice($set['links'],0,10);

			return [
				'pageid' => $set['pageid'],
				'title' => $set['title'],
				'extract' => $set['extract'],
				'links' => $set['links'],
				'categories' => $set['categories'],
				'terms' => $this->callback($set['terms'],function($i){
					if(!isset($i['description'])){
						return ['description' => ''];
					}
					return $i;
				}),
				'category' => $this->callback($this->currentCategory,function($i){
					if(trim($i)){ return $i; }
					return $_SESSION['CATEGORY'];
				}),
				'image' => $set['thumbnail']
			];
		}
		return false;
	}

	/**
	 *	GET RANDOM CATEGORY FROM A GROUP OF CATEGORY
	 *	
	 *	@return string Name of category
	*/
	public function extract_category_from_group($gcat)
	{
		if(is_array($this->appconf['categories'][$gcat])){
			$thisCat = $this->appconf['categories'][$gcat]['values'][array_rand($this->appconf['categories'][$gcat]['values'])];
		}
		if(trim($thisCat)){
			$this->currentCategory = $gcat;
			return $thisCat;
		}
		return null;
	}

	public function render_section($a=[])
	{
		$template = 
			'<section class="ttIF{CLASS} ${CLASS}END{CLASS}">
			<header></header>
			<div class="body">
			<h1>${H1}</h1>
			IF{H2}<h2>${H2}</h2>END{H2}
			<div class="text">${TEXT}</div>
			</div>IF{FOOT}
			<div class="foot">${FOOT}</div>END{FOOT}
			</section>';
		return $this->microtemplate($template,$a);
	}

	public function helper_title2url($title){
		$title = str_replace("\040", "_", $title);
		$title = urlencode($title);
		return $title;
	}

}