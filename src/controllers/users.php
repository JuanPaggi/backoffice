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
    _::$view->assign('user', new users($id_usuario));
    _::$view->assign('perfil', new profile($id_usuario));
    _::$view->show('perfil');
});