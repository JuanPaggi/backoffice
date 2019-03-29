<?php

_::define_controller('events_all', function(){
    _::$view->assign('menu_seleccionado', 'events');
    _::$view->assign('sub_menu_seleccionado', 'all');
    _::$view->assign('js_file', 'eventos'); // cargar js, el codigo que lo hace está en el footer.html
    _::$view->assign('eventos', events::getAllObjects('id_event'));
    _::$view->show('eventos');
});
_::define_controller('code_gen', function(){
    // no se recibió el id
    _::$view->assign('menu_seleccionado', 'events');
    _::$view->assign('sub_menu_seleccionado', 'all');
    _::$view->assign('js_file', 'eventos'); // cargar js, el codigo que lo hace está en el footer.html
    $codigos = codigos_externos::getCodes(_::$get['page']->int());
    _::$view->assign('codes', $codigos);
    _::$view->show('codes');
    
});
_::define_controller('events_stands', function(){
    _::$view->assign('menu_seleccionado', 'events');
    _::$view->assign('sub_menu_seleccionado', 'stands');
    _::$view->assign('js_file', 'eventos'); // cargar js, el codigo que lo hace está en el footer.html
    $id_evento = _::$get['page']->int();
    _::$view->assign('stands', stands::getAllObjects('id_stand', 'WHERE id_event = ?', array($id_evento)));
    _::$view->show('stands');
});

_::define_controller('events_checkins', function() {
    _::$view->assign('menu_seleccionado', 'events');
    _::$view->assign('sub_menu_seleccionado', 'checkins');
    _::$view->assign('js_file', 'eventos'); // cargar js, el codigo que lo hace está en el footer.html
    $id_stand = _::$get['page']->int();
    _::$view->assign('users', stands_checkin::getUsersOfCheckin($id_stand));
    _::$view->show('users');
});