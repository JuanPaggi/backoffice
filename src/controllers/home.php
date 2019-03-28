<?php

_::define_controller('login', 'login');
function login(){
    if(_::$isPost){
        $email = (string)_::$post['user'];
        $pass = (string)_::$post['pass'];
        // $user = new users();
        $userObj = users::getByEmail($email);
        if(!$userObj->void && $userObj->password == $pass) {
            _::$view->ajax(array('status' => 'ok'));
        } else {
            _::$view->ajax(array('status' => 'err'));
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