<?php

// header autocall
_::define_autocall(function(){
    if(isset(_::$get['action']) && strpos((string)_::$get['action'], 'login') === false && !isset(_::$globals['404']))
    {
		// header
        if(isset(_::$session['userID'])) {

            _::$view->assign('user', new users(_::$session['userID']->int()));
    		_::$view->assign('menu_pos', 'inicio');
    		_::$view->assign('submenu', '');
    		//_::$view->assign('meAdm', new administradores(_::$session['userID']->int()));
    		//las conversaciones se muestran en orden, primero las que tienen mensajes mas recientes 
            _::$view->show('partials/header');
        } else {
            _::redirect('/login', false);
            die();
        }
    }
});
