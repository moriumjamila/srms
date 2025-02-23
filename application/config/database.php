<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
*/
$active_group = 'default';
$query_builder = TRUE;

// $db['default'] = array(
	// 'dsn'	=> '',
	// 'hostname' => 'localhost',
	// 'username' => 'phpcoder_srms',
	// 'password' => 'dd%ob8inkjba',
	// 'database' => 'phpcoder_srms_db',
	// 'dbdriver' => 'mysqli',
	// 'dbprefix' => '',
	// 'pconnect' => FALSE,
	// 'db_debug' => (ENVIRONMENT !== 'production'),
	// 'cache_on' => FALSE,
	// 'cachedir' => '',
	// 'char_set' => 'utf8',
	// 'dbcollat' => 'utf8_general_ci',
	// 'swap_pre' => '',
	// 'encrypt' => FALSE,
	// 'compress' => FALSE,
	// 'stricton' => FALSE,
	// 'failover' => array(),
	// 'save_queries' => TRUE
// );

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'srms_database',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
