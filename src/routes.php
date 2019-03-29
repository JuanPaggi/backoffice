<?php

_::declare_controller('home', 'login', 'dashboard', 'logout');
_::declare_controller('users', 'users_all', 'users_premium', 'users_free', 'users_linkedin', 'users_bloqueados', 'users_profile');
_::declare_controller('events', 'events_all', 'code_gen');
_::declare_controller('chats', 'conversaciones', 'last_messages');
_::declare_controller('positions', 'positions');
_::declare_controller('configs', 'configs');