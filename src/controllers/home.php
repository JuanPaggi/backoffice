<?php

_::define_controller('login', 'login');
function login(){
    if(_::$isPost){
        
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