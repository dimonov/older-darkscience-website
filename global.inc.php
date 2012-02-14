<?php
/**
 * darkscience.ws
 * global.inc.php - Global configuration and initialization
 *
 * @package		DarkScience website
 * @author		fiftysixer <fiftysixer@gmail.com>
 */

define('SITE_ROOT', '/var/www/darkscience.ws');

$config = array(
	// General site settings:
	'site_name'	=> 'DarkScience',			 // Site name
	'site_url'	=> 'http://www.darkscience.ws/',	 	 // URL to the site

	// Structure:
	'site_root'	=> SITE_ROOT . '/',			 // Full path to web-accessable root
	'includes_dir'	=> SITE_ROOT . '/includes/',		 // Full path to PHP Includes dir

	// PHP settings:
	'error_reporting'    => E_NONE,			 	 // PHP Error Notices (use E_NONE when live)
	'date_format'        => 'M d, Y \a\t g:iA',		 // Format string for date()

	// MySQL database settings:
	'db_hostname'        => 'localhost',			 // MySQL server hostname
	'db_username'        => '',			 // MySQL user name
	'db_password'        => '',		 // MySQL password
	'db_database'        => '',			 // MySQL database name
	'db_prefix'		=> 'prefix_',				 // Database table prefix
);

// Set this to '1' to lock, '0' to unlock:
define('SITE_LOCKDOWN',	 	0);
define('FORUM_LOCKDOWN',	0);


/* * * * * * END OF CONFIG SECTION * * * * * */ 

// Start timing stuff...
$start_execution_time = microtime(true);

// PHP settings...
ini_set('include_path', ini_get('include_path') . ':' . $config['includes_dir']);
error_reporting($config['error_reporting']);

session_start();

// Load and instantiate classes
function __autoload($classname) {
	if(!require_once(preg_replace('/[^\w]/', '', $classname) . '.class.php')) {
		die("<b>ERROR:</b> Could not load {$classname} object.");
	}
}

// See if we can connect to the database, and get the DB auth data out of the way...
$DB = new mysql($config['db_hostname'], $config['db_username'], $config['db_password'], $config['db_database']);

//unset($config['db_hostname'], $config['db_username'], $config['db_password'], $config['db_database']);

// Make sure we're ready to go:
$db_err = $DB->error();
if($db_err['error_no']) {
	//print_r($db_err);
	die('Site error - can not connect to database!');
}

// Start templating:
$Template = new template();

// Make sure we're actually open for business:
if(SITE_LOCKDOWN) {
	$Template->disable();

	die('
		<div style="text-align:center;padding:5px;background:#d00;font-weight:bold;color:white;">
			This site is currently closed for maintenance. Please check back later.
		</div>
	');
}

/* * * * * * Done - all good and ready to roll! * * * * * */
?>
