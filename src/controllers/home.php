<?php

_::define_controller('login', 'login');
function login(){
    if(_::$isPost){
        $email = (string)_::$post['user'];
        $pass = (string)_::$post['pass'];
        // $user = new users();
        $userObj = users::findByEmail($email);
        $storedPassword = $userObj->password;
        $encryptedAccess = hash('sha512', $pass);
        $outDump = array(
            'storedPassword' => $storedPassword,
            'accessPassword' => $pass,
            'encryptedAccess' => $encryptedAccess
        );
        if(!$userObj->void && $storedPassword == $encryptedAccess && $userObj->is_admin) {
            $sess = new sessionVar('userID');
            $sess->set($userObj->id_user);
            _::$view->ajax(array('status' => 'ok'));
        } else {
            _::$view->ajax(array('status' => 'err', $outDump));
        } 
    } else { 
        _::$view->show('login');
    }
}

_::define_controller('logout', 'logout');
function logout(){
    session_destroy();
    _::redirect('/login', false);
}

_::define_controller('dashboard', 'dashboard');
function dashboard(){
    _::$view->assign('menu_seleccionado', 'home');
    _::$view->assign('sub_menu_seleccionado', 'home');
    _::$view->assign('total_users', users::count('id_user'));
    _::$view->assign('total_premium', users::count('id_user', 'WHERE is_premium = TRUE'));
    _::$view->assign('total_eventos', events::count('id_event'));
    _::$view->assign('amistades', friendships::count('id_user_requester'));
    _::$view->assign('checkins', stands_checkin::count('*'));
    _::$view->assign('codigos_vendidos', codigos_externos_usados::count('id_codigo'));
    _::$view->show('index');
}