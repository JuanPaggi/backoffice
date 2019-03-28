<?php

_::define_controller('login', 'login');
function login(){
    if(_::$isPost){
        $email = (string)_::$post['user'];
        $pass = (string)_::$post['pass'];
        // $user = new users();
        $userObj = users::getByEmail($email);
        $salt = base64_decode(explode('$', $userObj->password)[0]);
        $originalPass = explode('$', $userObj->password)[1];
        $accessEncryptedPassword = base64_encode(pbkdf2('SHA1', $pass, $salt, 20000, 256, true));
        // TODO: quitar este dump.
        $outDump = array(
            'OS' => str_split($originalPass, 42)[0],
            'SessData' => str_split($accessEncryptedPassword, 42)[0],
            'Valid' => str_split($originalPass, 42)[0] == str_split($accessEncryptedPassword, 42)[0]
        );
        if(!$userObj->void && 
            str_split($originalPass, 42)[0] == str_split($accessEncryptedPassword, 42)[0]) {
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
    _::$view->show('index');
}