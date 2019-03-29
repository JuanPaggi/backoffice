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

_::define_controller('event_form', function(){
    _::$view->assign('menu_seleccionado', 'events');
    _::$view->assign('sub_menu_seleccionado', 'checkins');

    _::$view->show('event_form');
});

_::define_controller('stand_form', function(){
    _::$view->assign('menu_seleccionado', 'events');
    _::$view->assign('sub_menu_seleccionado', 'checkins');
    if(_::$isPost) {
        // crear evento:
        // TODO: validaciones
        $evento = new events();
        $evento->start_date = (string)_::$post['fechaInicio'];
        $evento->end_date = (string)_::$post['fechaFin'];
        $evento->name = (string) _::$post['nombre'];

        $gde = new gps_data_events();
        $gde->latitude = (string) _::$post['latitud'];
        $gde->longitude = (string) _::$post['longitud'];
        $id_gps_data = $gde->save(); // así se obtiene el id incremental del ultimo insertado
        $evento->id_gps_record = $id_gps_data;

        //$evento->logo = (string) _::$post['']; // PENDIENTE
        $evento->url = (string) _::$post['url'];
        $evento->radio = _::$post['radio']->int();
        $evento->nombre_lugar = (string) _::$post['nombre_lugar'];
        $evento->location_description = (string) _::$post['desc_location'];
        // guardamos el evento
        $evento->save();
        // Habría que indicar que se guardó
        // redirigimos a la lista de eventos
        _::redirect('/events_all', false);
    } else {
        _::$view->show('stand_form');
    }
    
});

// PETICIONES AJAX //

_::define_controller('jx_event_delete', function() {
    $id = _::$post['id']->int();
    $event = new events($id);
    if(!$event->void) {
        $stands = stands::getAll('WHERE id_event = ?', array($id));
        foreach($stands as $stand) {
            stands_checkin::deleteAll('WHERE id_stand = ?', array($stand['id_stand']));
        }
        stands::deleteAll('WHERE id_event = ?', array($id));
        $codigos = codigos_externos::getAll('WHERE id_event = ?', array($id));
        foreach($codigos as $codigo) {
            codigos_externos_usados::deleteAll('WHERE id_codigo = ?', array($codigo['id_codigo']));
        }
        codigos_externos::deleteAll('WHERE id_event = ?', array($id));
        $event->delete();
        _::$view->ajax(array('status' => 'ok'));
    } else {
        _::$view->ajax(array('status' => 'err'));
    }
});
_::define_controller('jx_event_delete_stand', function() {
    $id = _::$post['id']->int();
    $stand = new stands($id);
    if(!$stand->void) {
        stands_checkin::deleteAll('WHERE id_stand = ?', array($id));
        $stand->delete();
        _::$view->ajax(array('status' => 'ok'));
    } else {
        _::$view->ajax(array('status' => 'err'));
    }
});
_::define_controller('jx_event_delete_code', function() {
    $id = _::$post['id']->int();
    $codigo = new codigos_externos($id);
    if(!$codigo->void) {
        codigos_externos_usados::deleteAll('WHERE id_codigo = ?', array($id));
        $codigo->delete();
        _::$view->ajax(array('status' => 'ok'));
    } else {
        _::$view->ajax(array('status' => 'err'));
    }
    
});