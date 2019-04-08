<?php

_::define_controller('configs', function(){

    _::$view->assign('menu_seleccionado', 'config');
    _::$view->assign('sub_menu_seleccionado', 'config');

    $distanciaDeBusqueda = new general_configurations(1);
    $distanciaMax = new general_configurations(2);
    $distanciaMin = new general_configurations(3);
    $mensajesMax = new general_configurations(4);
    $solicitudesMax = new general_configurations(6);
    $chatsMax = new general_configurations(7);
    if(_::$isPost) {
        $distanciaDeBusqueda->valor = floatval ((string)_::$post['distanciaDeBusqueda']);
        $distanciaDeBusqueda->save();
        $distanciaMax->valor = floatval ((string)_::$post['distanciaMax']);
        $distanciaMax->save();
        $distanciaMin->valor = floatval ((string)_::$post['distanciaMin']);
        $distanciaMin->save();
        $mensajesMax->valor = floatval ((string)_::$post['mensajesMax']);
        $mensajesMax->save();
        $solicitudesMax->valor = floatval ((string)_::$post['solicitudesMax']);
        $solicitudesMax->save();
        $chatsMax->valor = floatval ((string)_::$post['chatsMax']);
        $chatsMax->save();
    }
    _::$view->assign('distanciaDeBusqueda', $distanciaDeBusqueda->valor);
    _::$view->assign('distanciaMax', $distanciaMax->valor);
    _::$view->assign('distanciaMin', $distanciaMin->valor);
    _::$view->assign('mensajesMax', $mensajesMax->valor);
    _::$view->assign('solicitudesMax', $solicitudesMax->valor);
    _::$view->assign('chatsMax', $chatsMax->valor);
    _::$view->show('configs');
});