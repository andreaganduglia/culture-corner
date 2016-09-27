var APP = APP || {};

APP = {
	h: (window.ActiveXObject) ? new ActiveXObject("Microsoft.XMLHTTP") : (XMLHttpRequest && new XMLHttpRequest()) || null,
	misc: {timeout:{},response:{}},
	el: function(id){ return document.getElementById(id); },
	get: function(q,t){
		APP.h.onreadystatechange = function() {
			/**
			 * IE DO NOT SUPPORT THIS, SO USE APP.h
			 */
			var tt = APP.h;		
			if (APP.h.readyState != 4) {
				APP.fb('wait','Loading...');	
				if(!APP.misc.timeout.a){
					APP.misc.timeout.a = setTimeout(function(){ if(APP.h.readyState != 4){ APP.fb('wait','Still loading...'); } },2000);
				}
				if(!APP.misc.timeout.b){
					APP.misc.timeout.b = setTimeout(function(){ if(APP.h.readyState != 4){ APP.fb('wait','Still still loading ... :-('); } },4000);
				}
				if(!APP.misc.timeout.c){
					APP.misc.timeout.c = setTimeout(function(){ if(APP.h.readyState != 4){ APP.fb('err','Something is wrong. Try again!'); } },8000);		
				}
			}else{
				clearTimeout(APP.misc.timeout.a);
				clearTimeout(APP.misc.timeout.b);
				clearTimeout(APP.misc.timeout.c);		
				APP.misc.timeout = {};		
			}
			if (APP.h.readyState == 4 && APP.h.status == 200) {
				var r = JSON.parse(APP.h.responseText);
				APP.w(r);				
				APP.fb('ok','');
			}
			if (APP.h.readyState == 4 && APP.h.status != 200) {
				APP.fb('err','Something is wrong. Try again!');
			}
		};
		if(t == 'p'){
			APP.h.open("GET", "/q/"+q, true); // page
		}else if(t == 'c'){
			APP.h.open("GET", "/c/"+q, true); // category
		}else if(t == 'lc'){
			APP.h.open("GET", "/c/"+APP.el('btn').getAttribute('rel'), true); // last category
		}else{
			APP.h.open("GET", "/c/random", true); // fallback random
		}
		APP.h.send();
	},
	fb: function(st,msg) {
		APP.el('fb').setAttribute('class',st);
		APP.el('fb').innerHTML = msg;
	},
	w: function(r) {
		APP.misc.response = r;
		var _html = [];
		var i = 0;
		var wtitle = r.data[i].title.replace(/\s/g,'_');

		// TITLE PAGE
		document.getElementsByTagName('title')[0].innerHTML = r.data[i].title;
		window.history.replaceState({}, wtitle, '/w/'+wtitle);

		if(r.data[i].pageid == null){ // handle null pages (do not exists on wikipedia)
			var maintext = "<p>I'm sorry, Wikipedia does not have an article with this exact name.</p>";
			var mainlink = '<a href="javascript:void(0)" onclick="APP.get()">Please, pick a new page</a>';
		}else{
			var maintext = '<p>'+r.data[i].extract+'</p>';
			var mainlink =  '<a href="javascript:void(0)" onclick="APP.get(null,\'lc\')" class="nx">Next</a> '+
							'<a href="https://en.wikipedia.org/wiki/'+wtitle+'"><span class="large">Full article</span> on Wikipedia</a>';
			if(!r.data[i].extract){
				var maintext = "Not abstract available :-(";
			}			
		}	

		// Render elements
		_html.push('<section class="tt">');
			_html.push('<header></header>');
			_html.push('<div class="body">');
				_html.push('<h1>'+r.data[i].title+'</h1>');
				_html.push('<h2>'+r.data[i].terms.description+'</h2>'); 
				_html.push('<div class="text">');
				if(r.data[i].image){
					_html.push('<figure class="filter">');
					_html.push('<img class="pic" src="" style="display:none;">');
					//_html.push('<img class="pic" src="'+r.data[i].image.source+'" style="display:none;">');
					_html.push('<div class="pic">Image loading...</div>');
					_html.push('</figure>');
				}
				_html.push(maintext);
				_html.push('</div>');
			_html.push('</div>'); // body
			_html.push('<div class="foot">');
			_html.push(mainlink);
			_html.push('</div>');
		_html.push('</section>');


		// Suggestions
		if(r.data[i].links && r.data[i].links.length > 5){
			_html.push('<section class="tt">');
				_html.push('<header></header>');
				_html.push('<div class="body">');
					_html.push('<h3>Not enougth?</h3>');
					//_html.push('<h2></h2>'); // TODO breve spiega
					_html.push('<div class="text">');
						_html.push('<ul class="rel">');
						for(l=0;l<r.data[i].links.length;l++){
							_html.push('<li><a href="javascript:void(0)" onclick="APP.get(\''+encodeURI(r.data[i].links[l].title)+'\',\'p\')">'+r.data[i].links[l].title+'</a></li>');
						}
						_html.push('</ul>');
					_html.push('</div>');
				_html.push('</div>'); // body
				_html.push('<div class="foot">');
				_html.push('<a href="javascript:void(0)" onclick="APP.get(null,\'lc\')" class="nx">Next</a>&nbsp;');
				_html.push('</div>');
			_html.push('</section>');						
		}

		// HTML out
		APP.el('t').innerHTML = _html.join('');
		APP.setcat();
		window.scrollTo(0,0);

		if(r.data[i].image){
			var img = new Image();
			img.onload = function(){
				var pic = document.querySelectorAll('img.pic');
				pic[0].src = img.src;
				pic[0].style.display = 'block';
				var nopic = document.querySelectorAll('div.pic');
				nopic[0].style.display = 'none';
			}
			img.onerror = function(){
				var nopic = document.querySelectorAll('div.pic');
				nopic[0].innerHTML = 'Sorry. Image cannot be load at this time.';				
			}
			img.src = r.data[i].image.source;
		}

	},
	setcat : function(){
		var curcat = null;
		if(APP.misc.response.data){
			var curcat = APP.misc.response.data[0].category;
		}
		APP.el('btn').setAttribute('rel',curcat);
	},
	getcat : function(){
		return APP.el('btn').getAttribute('rel');
	}
}

window.onload = function(){
	if(APP.h && window.JSON){
		APP.setcat();	
		var els = document.querySelectorAll('a.start');
		for(i=0;i<els.length;i++){
			els[i].removeAttribute('href');
			els[i].addEventListener("click", 
				function(){ 
					var r = JSON.parse(this.getAttribute('rel'));
					if(r[1]=='f'){
						r[0]=APP.getcat();
						r[1]='c';
					}			
					APP.get(r[0],r[1]); 
				}, 
				false
			);
		}
	}		
};