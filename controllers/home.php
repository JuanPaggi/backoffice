<?php

_::define_controller('login', 'login');
function login(){
    if(_::$isPost){
        // _::$view->assign('error', null);
        // $pass = (string)_::$post['pass'];
        // $user = (string)_::$post['user'];
        // try{
        //     //if(strlen($pass) < 8) throw new Exception('Contrase&ntilde;a inv&aacute;lida');
        //     $user = administradores::getByNick($user);
        //     if($user->void || empty($user)) throw new Exception('El usuario no existe');
        //     if($user->intentos > 3) throw new Exception('Cuenta bloqueada por bruteforce');
        //     $user->intentos++;
        //     $user->save();
        //     if($pass != $user->password || empty($pass)) throw new Exception('Contrase&ntilde;a incorrecta');
        //     $user->intentos = 0;
        //     $user->last_login = time();
        //     $user->save();
        //     $sess = new sessionVar('userID');
        //     $sess->set($user->id_administrador);
        //     if($user->rol<5){
        //         _::redirect('/licencias_demo', false);
        //     }else{
        //         _::redirect('/dashboard_prof', false);
        //     }
           
        // } catch(Exception $e) {
        //     _::$view->assign('error', $e->getMessage());
        //     _::$view->show('login');
        // }
    } else _::$view->show('login');
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