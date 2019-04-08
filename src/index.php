<?php

// Developer mode, active errors, and others.
define('DEVMODE', false);
define('VERSION', '1.0.0');
define('REDIRECT_WWW', false);
// show cost of execution
define('PQ_VIEW_COST', false);
// probably big problem:
ini_set('memory_limit', '-1');
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http").'://'.$_SERVER['HTTP_HOST'];
define('ENDPOINT', $actual_link);
define('PHPQUERY54', false);

require('phpquery/loader.php');

coreData::$default_404_controller = 'e404';
//coreData::$default_500_controller = 'e500';
coreData::$v = 'views/';

// this set new values for the default configuration of DB
// see default config in phpquery/default_config/dbData.php
if(file_exists('settings.php'))
	include('settings.php');

// extension of view
// if you don't like .tpl extension in views, you set do you want
// you see default config in phpquery/default_config/tplData.php

tplData::$extension = '.html';	

// the important, you need declare the controllers that exist
// first declare file (example.php), later you declare the controllers in the file
require('routes.php');

// initialize the framework using debug mode (you can change the constant if like)
_::init(DEVMODE);
_::declare_component('userErrorHandler');

if(!file_exists('install.log'))
{
	_::declare_controller('installer', 'install', 'install_ajax');
} else {
	require('others/headers.php');
	require('others/footer.php');
	require('others/functions.php');
}

// then set the variable for select controller (in this case "action")
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

//if(isset($_GET['topic']) && $_GET['topic']=='payment') $action = 'mercadopago';

// ya lo instalamos?
if(!file_exists('install.log'))
{
	if($action !== 'install_ajax')
		$action = 'install';
} elseif($action == 'install' || $action == 'install_ajax') $action = 'home';

// execute the action (that is, call controller set in $action if exist)
_::execute($action);

// to end, show all views seted using _::$view->show();
_::$view->execute();

// PHPQuery Hiper Cache. New technology implemented at: 25/06/2016
//$PHPQuery_hiperCache->save_HQ_cache();
// END OF PHPQueryHiperCache

// SHOW TIME COST
if(defined('PQ_VIEW_COST') && PQ_VIEW_COST == TRUE)
	var_dump(_::get_cost());