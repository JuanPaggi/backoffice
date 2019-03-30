<?php

_::define_controller('tst', function(){

    $user = new users(1);
    var_dump($user);
    $user->is_admin = 1;
    $user->is_premium = (int)$user->is_premium;
    $user->save();
    var_dump($user->lastQuery, $user->lastError);
    _::$view->ajax_plain('');

});