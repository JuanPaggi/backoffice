<?php

_::define_controller('conversaciones', function(){
    _::$view->assign('menu_seleccionado', 'chats');
    _::$view->assign('sub_menu_seleccionado', 'conversaciones');
    _::$view->assign('conversaciones', chats::getAllObjects(array('id_user_requester', 'id_user_sender'), 'ORDER BY last_message_id DESC'));
    _::$view->show('chats');
});

_::define_controller('last_messages', function(){
    
});