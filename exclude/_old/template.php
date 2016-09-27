<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Culture corner</title>

<style>
html,body {
	margin:0; 
	padding:0;
	font:16px/1.4 Arial,sans-serif;
	color:#333;
	background: #f2f2f2;
}
body > header { 
	overflow: auto; 
	background: #512da8;
	color:rgba(255,255,255,.8);
	padding: 0;
	position: fixed; top:0;
	width: 100%;
}
body > header h1, body > header div {
	font-size:0.8rem;
	float:left;
	line-height: 3.8rem;
	margin: 0;
	padding:0;
	text-transform: uppercase;
	font-weight: bold;
}
body > header div { float: right; }
body > header a {
	color:rgba(255,255,255,.9);
	text-decoration: none;
	display: inline-block;
	line-height: 3.8rem;
	padding: 0 1rem;
}
body > header a:hover {
	background:#673ab7;
}

#t { 
	text-align: center; 
	margin-top: 7.6rem;
}

section.tt {
	margin: 0 auto 3rem auto;
	max-width: 864px;
	background: #fff;
	padding:0;
	box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);	
	text-align: left;
}

section.tt header { background: #ff4081; display: block; height: .5rem; }
section.tt div.body { padding: 3rem; border-bottom: solid 1px #ddd; }
section.tt div.body h1 { 
	margin:0; 
	font-weight: normal;
	font-size: 2.6rem;
}
section.tt div.body h2 { 
	margin:0;
	font-weight: normal;
	font-size: 1rem;
	color:#666;
}

section.tt div.body div.text {
	line-height: 1.6rem;
	color:#111;
	margin-top:2rem;
} 

section.tt div.body div.text > * {
	margin: 0 0 1.6rem 0;
}

section.tt div.body div.text :last-child {
	margin-bottom: 0;
}

section.tt div.body div.text a:link, section.tt div.body div.text a:active { color: #0645AD; text-decoration: none;}
section.tt div.body div.text a:visited { color: #0B0080; text-decoration: none;}
section.tt div.body div.text a:hover { text-decoration: underline;}

section.tt div.body div.text h3 {
	font-size: 1.2rem;
	color:#333;
	border-bottom: solid 1px #ddd;
}

section.tt div.body div.text ul.rel { 
    -webkit-column-count: 2;
    -moz-column-count: 2;	
	column-count: 2; 
	list-style:none; 
	padding:0; 
}

section.tt div.body div.text ul.rel li { 
	line-height: 1.5rem;
}

section.tt div.foot { 
	padding: .5rem 3rem; 
	text-transform: uppercase;
	font-size: 0.9rem;
}
section.tt div.foot a {
	text-decoration: none;
	color:#0645AD;
	font-weight: bold;
}
section.tt div.foot a:hover {
	text-decoration: underline;
}

@media screen and (max-width: 864px) {
	#t { margin-top: calc(3.8rem - 2px); }
}

@media screen and (max-width: 600px) {
	html,body { font-size: 14px; }
	.large { display: none; }
	section.tt { margin: 0 0 1rem 0;}
	section.tt div.body { padding:1rem; }
	section.tt div.foot { padding: .5rem 1rem; 	}
	section.tt { width: 100%; }

	/**
	 * Colonne su smartphone
	 */
	section.tt div.body div.text ul.rel { 
	    -webkit-column-count: 1;
	    -moz-column-count: 1;	
		column-count: 1; 

	}
	section.tt div.body div.text ul.rel li {
		padding: .4rem 0; 
		border-top: solid 1px #ddd;
		line-height: 2rem;
	}
}

</style>

</head>
<body>
<header>
	<h1><a href="./">Culture corner <span class="large">- A bit of Wikipedia for your spare time</span></a></h1>
	<div><a href="./?get=1" id="btn">@</a></div>
</header>


<div id="t">

	<section class="tt">
		<header></header>
		<div class="body">
			<h1>Culture corner</h1>
			<h2>A bit of Wikipedia from your spare time</h2>
			<div class="text">				
			</div>
		</div>
		<div class="foot"><a href="#">Continue on Wikipedia</a></div>
   </section>

	<section class="tt">
		<header></header>
		<div class="body">
			<h1>Not enough?</h1>
			<div class="text">
				<ul class="rel"><li><a href="javascript:void(0)" onclick="APP.get('Alcanivorax borkumensis')">Alcanivorax borkumensis</a></li><li><a href="javascript:void(0)" onclick="APP.get('Antibiotics')">Antibiotics</a></li><li><a href="javascript:void(0)" onclick="APP.get('Antimicrobial resistance')">Antimicrobial resistance</a></li><li><a href="javascript:void(0)" onclick="APP.get('Auxotrophy')">Auxotrophy</a></li><li><a href="javascript:void(0)" onclick="APP.get('Digital object identifier')">Digital object identifier</a></li><li><a href="javascript:void(0)" onclick="APP.get('Efflux (microbiology)')">Efflux (microbiology)</a></li><li><a href="javascript:void(0)" onclick="APP.get('Folic acid')">Folic acid</a></li><li><a href="javascript:void(0)" onclick="APP.get('International Standard Serial Number')">International Standard Serial Number</a></li><li><a href="javascript:void(0)" onclick="APP.get('Ion transporter')">Ion transporter</a></li><li><a href="javascript:void(0)" onclick="APP.get('Lipid bilayer')">Lipid bilayer</a></li><li><a href="javascript:void(0)" onclick="APP.get('Membrane transport protein')">Membrane transport protein</a></li><li><a href="javascript:void(0)" onclick="APP.get('Michaelis–Menten kinetics')">Michaelis–Menten kinetics</a></li><li><a href="javascript:void(0)" onclick="APP.get('Neisseria gonorrhoeae')">Neisseria gonorrhoeae</a></li><li><a href="javascript:void(0)" onclick="APP.get('Orientations of Proteins in Membranes database')">Orientations of Proteins in Membranes database</a></li><li><a href="javascript:void(0)" onclick="APP.get('PDBsum')">PDBsum</a></li><li><a href="javascript:void(0)" onclick="APP.get('P aminobenzoate')">P aminobenzoate</a></li><li><a href="javascript:void(0)" onclick="APP.get('Pfam')">Pfam</a></li><li><a href="javascript:void(0)" onclick="APP.get('Protein Data Bank')">Protein Data Bank</a></li><li><a href="javascript:void(0)" onclick="APP.get('PubMed Central')">PubMed Central</a></li><li><a href="javascript:void(0)" onclick="APP.get('PubMed Identifier')">PubMed Identifier</a></li><li><a href="javascript:void(0)" onclick="APP.get('Sulfadiazine')">Sulfadiazine</a></li><li><a href="javascript:void(0)" onclick="APP.get('Sulfonamide (medicine)')">Sulfonamide (medicine)</a></li><li><a href="javascript:void(0)" onclick="APP.get('TCDB')">TCDB</a></li><li><a href="javascript:void(0)" onclick="APP.get('Transporter Classification Database')">Transporter Classification Database</a></li></ul>					
			</div>
		</div>
		<div class="foot"><a href="#">Pick another page</a></div>
   </section>   

</div>
<div id="fb"></div>
</body>
</html>