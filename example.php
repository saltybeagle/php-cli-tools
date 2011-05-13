<?php

if (php_sapi_name() != 'cli') {
	die('Must run from command line');
}

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
ini_set('log_errors', 0);
ini_set('html_errors', 0);

function autoload($class)
{
	$file = str_replace(array('_', '\\'), DIRECTORY_SEPARATOR, $class) . '.php';
	include $file;
}

set_include_path(__DIR__ . '/src');
spl_autoload_register('autoload');
require_once 'PEAR2/Console/Tools/Main.php';

$menu = array(
	'out_out' => 'PEAR2\Console\Tools\out Example',
	'out_err' => 'PEAR2\Console\Tools\err Example',
	'out_line' => 'PEAR2\Console\Tools\line Example',
	'notify_dots' => 'PEAR2\Console\Tools\notify\Dots Example',
	'notify_spinner' => 'PEAR2\Console\Tools\notify\Spinner Example',
	'progress_bar' => 'PEAR2\Console\Tools\progress\Bar Example',
	'table' => 'PEAR2\Console\Tools\Table Example',
	'colors' => 'PEAR2\Console\Tools\Colors example',
	'quit' => 'Quit',
);
$headers = array('First Name', 'Last Name', 'City', 'State');
$data = array(
	array('Maryam',   'Elliott',    'Elizabeth City',   'SD'),
	array('Jerry',    'Washington', 'Bessemer',         'ME'),
	array('Allegra',  'Hopkins',    'Altoona',          'ME'),
	array('Audrey',   'Oneil',      'Dalton',           'SK'),
	array('Ruth',     'Mcpherson',  'San Francisco',    'ID'),
	array('Odessa',   'Tate',       'Chattanooga',      'FL'),
	array('Violet',   'Nielsen',    'Valdosta',         'AB'),
	array('Summer',   'Rollins',    'Revere',           'SK'),
	array('Mufutau',  'Bowers',     'Scottsbluff',      'WI'),
	array('Grace',    'Rosario',    'Garden Grove',     'KY'),
	array('Amanda',   'Berry',      'La Habra',         'AZ'),
	array('Cassady',  'York',       'Fulton',           'BC'),
	array('Heather',  'Terrell',    'Statesboro',       'SC'),
	array('Dominic',  'Jimenez',    'West Valley City', 'ME'),
	array('Rhonda',   'Potter',     'Racine',           'BC'),
	array('Nathan',   'Velazquez',  'Cedarburg',        'BC'),
	array('Richard',  'Fletcher',   'Corpus Christi',   'BC'),
	array('Cheyenne', 'Rios',       'Broken Arrow',     'VA'),
	array('Velma',    'Clemons',    'Helena',           'IL'),
	array('Samuel',   'Berry',      'Lawrenceville',    'NU'),
	array('Marcia',   'Swanson',    'Fontana',          'QC'),
	array('Zachary',  'Silva',      'Port Washington',  'MB'),
	array('Hilary',   'Chambers',   'Suffolk',          'HI'),
	array('Idola',    'Carroll',    'West Sacramento',  'QC'),
	array('Kirestin', 'Stephens',   'Fitchburg',        'AB'),
);

function test_notify(\PEAR2\Console\Tools\Notify $notify, $cycle = 1000000, $sleep = null) {
	for ($i = 0; $i <= $cycle; $i++) {
		$notify->tick();
		if ($sleep) usleep($sleep);
	}
	$notify->finish();
}

while (true) {
	$choice = \PEAR2\Console\Tools\menu($menu, null, 'Choose an example');
	\PEAR2\Console\Tools\line();

	switch ($choice) {
	case 'quit':
		break 2;
	case 'out_out':
		\PEAR2\Console\Tools\out("  \\PEAR2\Console\Tools\\out sends output to STDOUT\n");
		\PEAR2\Console\Tools\out("  It does not automatically append a new line\n");
		\PEAR2\Console\Tools\out("  It does accept any number of %s which are then %s to %s for formatting\n", 'arguments', 'passed', 'sprintf');
		\PEAR2\Console\Tools\out("  Alternatively, {:a} can use an {:b} as the second argument.\n", array('a' => 'you', 'b' => 'array'));
		break;
	case 'out_err':
		\PEAR2\Console\Tools\err('  \PEAR2\Console\Tools\err sends output to STDERR');
		\PEAR2\Console\Tools\err('  It does automatically append a new line');
		\PEAR2\Console\Tools\err('  It does accept any number of %s which are then %s to %s for formatting', 'arguments', 'passed', 'sprintf');
		\PEAR2\Console\Tools\err('  Alternatively, {:a} can use an {:b} as the second argument.', array('a' => 'you', 'b' => 'array'));
		break;
	case 'out_line':
		\PEAR2\Console\Tools\line('  \PEAR2\Console\Tools\line forwards to \PEAR2\Console\Tools\out for output');
		\PEAR2\Console\Tools\line('  It does automatically append a new line');
		\PEAR2\Console\Tools\line('  It does accept any number of %s which are then %s to %s for formatting', 'arguments', 'passed', 'sprintf');
		\PEAR2\Console\Tools\line('  Alternatively, {:a} can use an {:b} as the second argument.', array('a' => 'you', 'b' => 'array'));
		break;
	case 'notify_dots':
		test_notify(new \PEAR2\Console\Tools\notify\Dots('  \PEAR2\Console\Tools\notify\Dots cycles through a set number of dots'));
		test_notify(new \PEAR2\Console\Tools\notify\Dots('  You can disable the delay if ticks take longer than a few milliseconds', 5, 0), 10, 100000);
		\PEAR2\Console\Tools\line('    All progress meters and notifiers extend \PEAR2\Console\Tools\Notify which handles the interval above.');
		break;
	case 'notify_spinner':
		test_notify(new \PEAR2\Console\Tools\notify\Spinner('  \PEAR2\Console\Tools\notify\Spinner cycles through a set of characters to emulate a spinner'));
		break;
	case 'progress_bar':
		test_notify(new \PEAR2\Console\Tools\progress\Bar('  \PEAR2\Console\Tools\progress\Bar displays a progress bar', 1000000));
		test_notify(new \PEAR2\Console\Tools\progress\Bar('  It sizes itself dynamically', 1000000));
		break;
	case 'table':
		$table = new \PEAR2\Console\Tools\Table();
		$table->setHeaders($headers);
		$table->setRows($data);
		$table->display();
		break;
	case 'colors':
	    \PEAR2\Console\Tools\line('  %C%5All output is run through %Y%6\PEAR2\Console\Tools\Colors::colorize%C%5 before display%n');
		break;
	}

	\PEAR2\Console\Tools\line();
}
