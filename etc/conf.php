<?php
error_reporting(0);
session_start();
define('APP_STAGE','production');
//define('APP_STAGE','stage');
define('APP_VERSION','1.1.0');
define('APP_LANG','en');

$appconf = [];
$appconf['apiendpoint'] = 'https://en.wikipedia.org/w/api.php';
$appconf['categories'] = []; 

$appconf['categories']['sheldon'] = [
	'label' => 'Sheldon Cooper selections',
	'values' => [
		'Linux',
		'Robots',
		'Cryptozoology',
		'American science fiction television series',
		'Space in fiction',
		'Star Trek',
		'Star Wars',
		'Nerd culture',
		'Role-playing games',
		'Role-playing',
		'Marvel Cinematic Universe',
		'The Lord of the Rings',
		'Fantasy books by series',
		'String theory',
		'Concepts in physics',
		'DimensionMulti-dimensional geometry',
		'Particle physicsPhysical cosmology',
		'Physics beyond the Standard Model',
		'Theoretical physics',
		'Nobel laureates in Physics',
		'Physics awards',
		'Operating systems',
		'Computing timelines',
		'DC Comics superheroes',
		'Superhero film characters',
		'Marvel Comics superheroes',
		'Spider-Man',
		'Leonard Nimoy',
		'Fictional scientists',
		'Star Trek: The Original Series characters',
		'Star Trek: The Next Generation characters',
		'Vulcans',
		'Time travelers',
		'Star Trek: The Original Series',
		'Trains',
		'Flags',
		'National symbols',
		'Vexillology'

	]
];

$appconf['categories']['tecnology'] = [
	'label' => 'Tecnology and applied science',
	'values' => [
		'Aerospace engineering','Agriculture','Agronomy','Applied sciences','Architecture','Artificial intelligence','Automation',
		'Automobiles','Aviation','Avionics','Bioengineering','Biotechnology','Cartography','Chemical engineering','Civil engineering',
		'Classes of computers','Communication','Computer architecture','Computer data','Computer engineering','Computer languages',
		'Computer networks','Computer programming','Computer science','Computer security','Computing','Computing and society','Computing by company',
		'Computing by computer model','Computing platforms','Construction','Consumer electronics','Control theory','Cycling','Design','Digital divide',
		'Digital electronics','Digital media','Earthquake engineering','Electrical components','Electrical connectors','Electrical engineering',
		'Electronic circuits','Electronic design','Electronics','Electronics companies','Electronics manufacturing','Electronics terminology',
		'Embedded systems','Energy','Engineering','Environmental engineering','Ergonomics','Firefighting','Fire prevention','Forensics','Forestry',
		'Free software','Human–computer interaction','Industry','Information science','Information systems','Information technology','Integrated circuits',
		'Internet','Management','Manufacturing','Marketing','Materials science','Mechanical engineering','Media studies','Medicine','Metalworking',
		'Microtechnology','Microwave technology','Military science','Mining','Mobile Web','Molecular electronics','Multimedia','Nanotechnology',
		'Nuclear technology','Operating systems','Optics','Optoelectronics','Plumbing','Product lifecycle management','Public transport','
		Quantum electronics','Radio electronics','Radio-frequency identification','Rail transport','Real-time computing','Road transport','Robotics',
		'Semiconductors','Shipping','Signal cables','Software','Software engineering','Sound technology','Spaceflight','Structural engineering','Surveillance',
		'Systems engineering','Technology','Technology forecasting','Telecommunications','Tools','Transport','Transport by country','Unsolved problems in computer science',
		'Unsolved problems in neuroscience','Vehicles','Water technology','Water transport'
	]
];

$appconf['categories']['culture'] = [
	'label' => 'Culture and the arts',
	'values' => [
		'Air sports','American football','Animation','Architecture','Arts','Arts and crafts','Association football','Auto racing','Baseball','Basketball',
		'Board games','Boating','Boxing','Broadcasting','Canoeing','Card games','Celebrity','Censorship in the arts','Circus','Classical studies','Comics',
		'Crafts','Cricket','Critical theory','Cultural anthropology','Culture','Cycling','Dance','Design','Dolls','Drawing','Entertainment','Festivals','Film',
		'Fishing','Folklore','Food and drink','Food culture','Games','Golf','Gymnastics','Hobbies','Horse racing','Humanities','Humor','Ice hockey','Internet',
		'Lacrosse','Languages','Literature','Magazines','Mass media','Museology','Museums','Music','Mythology','New media art','Newspapers','Olympic games','Opera',
		'Painting','Parties','Performing arts','Philosophy','Photography','Physical exercise','Poetry','Popular culture','Publications','Publishing','Puppetry',
		'Puzzles','Radio','Recreation','Role-playing games','Rugby league','Rugby union','Sailing','Science and culture','Sculpture','Skiing','Sports','Storytelling',
		'Swimming','Television','Tennis','Theatre','Toys','Track and field','Traditions','Video games','Visual arts','Walking','Water sports','Whitewater sports'
	]
];

$appconf['categories']['geography'] = [
	'label' => 'Geography and places',
	'values' => [
		'Bodies of water','Cities','Communities','Continents','Countries','Deserts','Earth','Geography','Lakes','Landforms','Mountains','Navigation','Oceans','Places',
		'Populated places','Protected areas','Regions','Rivers','Subterranea (geography)','Territories','Towns','Villages','World'
	]
];

$appconf['categories']['health'] = [
	'label' => 'Health and fitness',
	'values' => [
		'Aerobics','Alternative medicine','Amino acids','Beauty','Bodyweight exercise','Cardiology','Cleaning','Clinical research','Cycling',
		'Dance','Dentistry','Dietary minerals','Dietary supplements','Dietetics','Diseases and disorders','Endocrinology',
		'Epidemiology','Exercise equipment','Exercise instructors','Exercise physiology','Forensics','Gastroenterology',
		'Genetics','Geriatrics','Gerontology','Gynecology','Health','Health by country','Health law','Health promotion',
		'Health sciences','Health standards','Healthcare','Healthcare occupations','Hematology','Hiking','Hospitals',
		'Hygiene','Life extension','Medicine','Mental health','Midwifery','Nephrology','Neurology','Nootropics','Nursing','Nutrients','Nutrition',
		'Nutritional advice pyramids','Obstetrics','Occupational safety and health','Oncology','Ophthalmology','Optometry','Oral hygiene',
		'Orthodontics','Orthopedic surgical procedures','Pathology','Pediatrics','Pharmaceutical industry','Pharmaceuticals policy','Pharmacy',
		'Physical exercise','Phytochemicals','Pilates','Positive psychology','Prevention','Psychiatry','Psychotherapy','Public health','Rheumatology',
		'Running','Safety','Self care','Sexual health','Sleep','Sports','Surgery','Swimming','T\'ai chi ch\'uan','Urology','Veterinary medicine',
		'Vitamins','Walking','Weight training','Weight training exercises','Yoga'
	]
];

$appconf['categories']['history'] = [
	'label' => 'History and events',
	'values' => [
		'Empires','Events','Historiography','History','History by city','History by continent','History by country','History by location',
		'History by period','History by region','History by topic','History of africa','History of asia','History of central europe',
		'History of europe','History of north america','History of oceania','History of religion','History of science','History of south america',
		'History of the americas','History of the middle east','Timelines'
	]
];

$appconf['categories']['math'] = [
	'label' => 'Mathematics and logic',
	'values' => [
		'Algebra','Analysis of variance','Arithmetic','Bayesian statistics','Calculus','Categorical data','Computational science',
		'Covariance and correlation','Data analysis','Decision theory','Deductive reasoning','Design of experiments','Equations',
		'Fields of mathematics','Formal sciences','Geometry','Heuristics','History of logic','Inductive reasoning','Logic','Logic and statistics',
		'Logical fallacies','Mathematical analysis','Mathematical proofs','Mathematical sciences','Mathematics','Mathematics education','Measurement',
		'Metalogic','Multivariate statistics','Non-parametric statistics','Numbers','Operations research','Parametric statistics','Philosophy of logic',
		'Regression analysis','Sampling (statistics)','Statistical theory','Statistics','Stochastic processes','Summary statistics','Survival analysis',
		'Theorems','Theoretical physics','Time series analysis','Trigonometry','Uncertainty of numbers'
	]
];

$appconf['categories']['nature'] = [
	'label' => 'Natural and physical sciences',
	'values' => [
		'Animals','Astronomy','Atmospheric sciences','Biology','Botany','Chemistry','Climate','Earth sciences','Ecology','Geography','Geology',
		'Geophysics','Health sciences','Humans','Life','Medicine','Natural environment','Natural resources','Natural sciences','Nature',
		'Neuroscience','Oceanography','Physical sciences','Physics','Plants','Pollution','Science','Scientific method','Scientists','Space',
		'Universe','Zoology'
	]
];

$appconf['categories']['people'] = [
	'label' => 'People and self',
	'values' => [
		'Activists','Actors','Alter egos','Astronauts','Beginners and newcomers','Billionaires','Biography','Births by year',
		'Chief executives','Children','Clothing','Colonial people','Composers','Consciousness studies','Cyborgs',
		'Deaths by year','Defectors','Employment','Entertainment','Food and drink','Games','Gender','Generals','Heads of state',
		'Health','Hobbies','Home','Human sexuality','Humanitarians','Humans','Income','Innovators','Interpersonal relationships',
		'Inventors','Legal categories of people','Leisure','Lgbt people','Lists of people','Love','Men','Monarchs','Motivation',
		'Musical groups','Musicians','Old age','People','People associated with war','People by city','People by company','People by continent',
		'People by educational institution','People by ethnic or national descent','People by ethnic or national origin','People by ethnicity',
		'People by medical or psychological condition','People by nationality','People by occupation','People by political orientation',
		'People by religion','People by revolution','People by status','Personal development','Personal life','Personal timelines',
		'Personality','Pets','Philosophers','Photographers','Political people','Politicians','Presidents','Princes','Princesses',
		'Revolutionaries','Rivalry','Scientists','Self','Settlers','Sexual orientation','Singers','Slaves','Social groups','Subcultures',
		'Surnames','Terms for males','Victims','Women','Writers'
	]
];

$appconf['categories']['philosophy'] = [
	'label' => 'Philosophy and thinking',
	'values' => [
		'Aesthetics','Attention','Branches of philosophy','Cognition','Cognitive biases','Creativity','Decision theory','Emotion','Epistemology',
		'Error','Ethics','History of philosophy','Imagination','Intelligence','Intelligence researchers','Learning','Logic','Memory',
		'Memory biases','Metaphysics','Mnemonics','Nootropics','Perception','Philosophers','Philosophical arguments','Philosophical concepts',
		'Philosophical literature','Philosophical movements','Philosophical schools and traditions','Philosophical theories','Philosophy',
		'Philosophy by period','Philosophy by region','Problem solving','Psychological adjustment','Psychometrics','Qualities of thought',
		'Social philosophy','Strategic management','Thought'
	]
];

$appconf['categories']['religion'] = [
	'label' => 'Religion and belief systems',
	'values' => [
		'Abrahamic mythology','Agnosticism','Allah','Animism','Atheism','Ayyavazhi','Bahá\'í faith',
		'Belief','Bible','Buddhas','Buddhism','Buddhist mythology','Cao dai','Chinese folk religion',
		'Christian mythology','Christianity','Confucianism','Criticism of religion','Deism',
		'Deities','Demons','Determinism','Druidry','Esotericism','Exorcism','Falun gong','Gnosticism',
		'God','Hindu mythology','Hinduism','Humanism','Islam','Islamic mythology','Jainism','Jesus','Jewish mythology',
		'Judaism','Monism','Monotheism','Mormonism','Mysticism','Mythology','Mythology by culture','Neo-druidism','Neopaganism','New age',
		'Occult','Paganism','Pantheism','Polytheism','Prayer','Prophecy','Quran','Rastafarianism','Religion','Religious ethics',
		'Religious faiths, traditions, and movements','Religious law','Ritual','Satanism','Scientology','Shamanism','Shinto',
		'Sikhism','Skepticism','Spiritism','Spiritualism','Spirituality','Taoism','Tenrikyo','Theology','Theosophy','Transcendentalism',
		'Unitarian universalism','Unitarianism','Wicca','Zoroastrianism'
	]
];

$appconf['categories']['society'] = [
	'label' => 'Society and social sciences',
	'values' => [
		'Activism','Anthropology','Archaeology','Business','Communication','Crime','Cultural studies','Demographics','Economics','Education',
		'Ethnic groups','Family','Finance','Globalization','Government','Health','Home','Industries','Information science','Infrastructure',
		'International relations','Law','Linguistics','Mass media','Media studies','Military','Money','Organizations','Peace','Political science',
		'Politics','Psychology','Public administration','Real estate','Rights','Sexology','Social sciences','Social scientists','Social work','Society',
		'Sociology','Systems theory','War'
	]
];

if(APP_STAGE == 'production'){
	$appconf['assets']['js'] = '/a/s.js';
	$appconf['assets']['css'] = '/a/s.css';
}else{
	$appconf['assets']['js'] = '/exclude/a/script.js?'.time();
	$appconf['assets']['css'] = '/exclude/a/style.css?'.time();	
}