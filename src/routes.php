<?php

// paginas regulares
_::declare_controller('home', 'login', 'dashboard', 'logout');
_::declare_controller('users', 'users_all', 'users_premium', 'users_free', 'users_linkedin', 'users_bloqueados', 'users_profile', 'user_share');
_::declare_controller('events', 'events_all', 'code_gen', 'events_stands', 'events_checkins', 'event_form', 'stand_form', 'edit_stand_form');
_::declare_controller('chats', 'conversaciones', 'last_messages', 'conversacion');
_::declare_controller('positions', 'positions');
_::declare_controller('configs', 'configs');

// peticiones ajax
_::declare_controller('users', 'jx_user_unlock', 'jx_user_rem_admin', 'jx_user_add_admin', 'jx_user_delete', 'jx_user_do_premium', 'jx_user_rem_premium');
_::declare_controller('events', 'jx_event_delete', 'jx_event_delete_stand', 'jx_event_delete_code', 'jx_event_codegen');

_::declare_controller('tst', 'tst');