<?php

// header autocall
_::define_autocall(function(){
    if(isset(_::$get['action']) && strpos((string)_::$get['action'], 'login') === false && !isset(_::$globals['404']))
    {
		_::$view->assign('menu_pos', 'inicio');
		_::$view->assign('submenu', '');
		_::$view->assign('ucount', niveles_activos_usuario::countLicences());
        _::$view->show('partials/header');
    }
});


function iploc($ip) {
	$html = file_get_contents("http://ipinfodb.com/ip_locator.php?ip=".$ip);
	preg_match("/<li>Country : (.*?) <img/",$html,$data);
	@$d['pais'] = $data[1];
	preg_match("/<li>State\/Province : (.*?)<\/li>/",$html,$data);
	@$d['state'] = $data[1];
	preg_match("/<li>City : (.*?)<\/li>/",$html,$data);
	@$d['city'] = $data[1];
	return ($d);
}
function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
 
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
 
    return $_SERVER['REMOTE_ADDR'];
}
