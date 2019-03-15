<?php

_::attach_footer(function(){
    _::$view->assign('year', date('Y'));
    if(isset(_::$get['action']) && strpos((string)_::$get['action'], 'login') === false && !isset(_::$globals['404']))
    {
        _::$view->show('partials/footer');
    }
});