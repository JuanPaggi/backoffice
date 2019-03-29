<?php

_::define_controller('conversaciones', function(){
    _::$view->assign('menu_seleccionado', 'chats');
    _::$view->assign('sub_menu_seleccionado', 'conversaciones');
    _::$view->assign('conversaciones', chats::getAllObjects(array('id_user_requester', 'id_user_sender'), 'ORDER BY last_message_id DESC'));
    _::$view->show('chats');
});

_::define_controller('conversacion', function(){
    _::$view->assign('menu_seleccionado', 'chats');
    _::$view->assign('sub_menu_seleccionado', 'conversaciones');

    $message = new mensajes(_::$get['page']->int());

    _::$view->assign('userA', $message->getSender());
    _::$view->assign('userB', $message->getTarget());

    _::$view->assign('messages', array_reverse(mensajes::getAllByUsers($message->id_sender, $message->id_target)));

    //_::$view->assign();
    _::$view->show('chat');
});

_::define_controller('last_messages', function(){
    
});