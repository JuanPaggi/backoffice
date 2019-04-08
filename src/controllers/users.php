<?php


_::define_controller('users_all', function(){
    _::$view->assign('menu_seleccionado', 'users');
    _::$view->assign('sub_menu_seleccionado', 'all');
    _::$view->assign('js_file', 'users'); // cargar js, el codigo que lo hace está en el footer.html
    _::$view->assign('users', users::getAllObjects('id_user'));
    _::$view->show('users');    
});
_::define_controller('users_premium', function(){
    _::$view->assign('menu_seleccionado', 'users');
    _::$view->assign('sub_menu_seleccionado', 'premium');
    _::$view->assign('js_file', 'users'); // cargar js, el codigo que lo hace está en el footer.html
    _::$view->assign('users', users::getAllObjects('id_user', 'WHERE is_premium = TRUE'));
    _::$view->show('users');
});
_::define_controller('users_free', function(){
    _::$view->assign('menu_seleccionado', 'users');
    _::$view->assign('sub_menu_seleccionado', 'free');
    _::$view->assign('js_file', 'users'); // cargar js, el codigo que lo hace está en el footer.html
    _::$view->assign('users', users::getAllObjects('id_user', 'WHERE is_premium = FALSE'));
    _::$view->show('users');
});
_::define_controller('users_linkedin', function(){
    _::$view->assign('menu_seleccionado', 'users');
    _::$view->assign('sub_menu_seleccionado', 'linkedin');
    _::$view->assign('js_file', 'users'); // cargar js, el codigo que lo hace está en el footer.html
    _::$view->assign('users', users::getAllObjects('id_user', 'WHERE linkedin_id IS NOT NULL'));
    _::$view->show('users');
});
_::define_controller('users_bloqueados', function(){
    _::$view->assign('menu_seleccionado', 'users');
    _::$view->assign('sub_menu_seleccionado', 'locked');
    _::$view->assign('js_file', 'users'); // cargar js, el codigo que lo hace está en el footer.html
    _::$view->assign('users', users::getAllObjects('id_user', 'WHERE locked = TRUE'));
    _::$view->show('users');
});
_::define_controller('users_profile', function(){
    _::$view->assign('menu_seleccionado', 'users');
    _::$view->assign('sub_menu_seleccionado', 'profile');
    _::$view->assign('js_file', 'users'); // cargar js, el codigo que lo hace está en el footer.html
    $id_usuario = _::$get['page']->int();
    _::$view->assign('user_profile', new users($id_usuario));
    _::$view->assign('perfil', new profile($id_usuario));
    _::$view->show('perfil');
});

// PETICIONES AJAX //

_::define_controller('jx_user_unlock', function() {
    $id = _::$post['id']->int();
    $user = new users($id);
    if(!$user->void){
        $user->locked = 0;
        $user->save();
        _::$view->ajax(array('status' => 'ok'));
    } else {
        _::$view->ajax(array('status' => 'err'));
    }
});
_::define_controller('jx_user_rem_admin', function() {
    $id = _::$post['id']->int();
    $user = new users($id);
    if(!$user->void){
        $user->is_admin = 0;
        $user->save();
        _::$view->ajax(array('status' => 'ok'));
    } else {
        _::$view->ajax(array('status' => 'err'));
    }
});
_::define_controller('jx_user_add_admin', function() {
    $id = _::$post['id']->int();
    $user = new users($id);
    if(!$user->void){
        $user->is_admin = 1;
        $user->save();
        _::$view->ajax(array('status' => 'ok'));
    } else {
        _::$view->ajax(array('status' => 'err'));
    }
});
_::define_controller('jx_user_do_premium', function() {
    $id = _::$post['id']->int();
    $user = new users($id);
    if(!$user->void){
        $user->is_premium = 1;
        $user->save();
        _::$view->ajax(array('status' => 'ok'));
    } else {
        _::$view->ajax(array('status' => 'err'));
    }
});
_::define_controller('jx_user_rem_premium', function() {
    $id = _::$post['id']->int();
    $user = new users($id);
    if(!$user->void){
        $user->is_premium = 0;
        $user->save();
        _::$view->ajax(array('status' => 'ok'));
    } else {
        _::$view->ajax(array('status' => 'err'));
    }
});
_::define_controller('jx_user_delete', function() {
    $id = _::$post['id']->int();
    $user = new users($id);
    if(!$user->void){
        $error = null;
        stands::deleteAll('WHERE id_user_organizer = ?', array($id), $error);
        stands_checkin::deleteAll('WHERE id_user = ?', array($id), $error);
        codigos_externos_usados::deleteAll('WHERE id_user = ?', array($id), $error);
        remember_tokens::deleteAll('WHERE id_user = ?', array($id), $error);
        configuration::deleteAll('WHERE id_user = ?', array($id), $error);
        friendships::deleteAll('WHERE id_user_requester = ? OR id_user_target = ?', array($id, $id), $error);
        cached_users_close::deleteAll('WHERE id_user_searcher = ? OR id_user_finded = ?', array($id, $id), $error);
        gps_data_users::deleteAll('WHERE id_user = ?', array($id), $error);
        profile::deleteAll('WHERE id_user = ?', array($id), $error);
        // chats
        chats::deleteAll('WHERE id_user_requester = ? OR id_user_sender = ?', array($id, $id), $error);
        mensajes::deleteAll('WHERE id_user_requester = ? OR id_user_sender = ?', array($id, $id), $error);
        
        $user->delete();
        _::$view->ajax(array('status' => 'ok'));
    } else {
        _::$view->ajax(array('status' => 'err'));
    }
});