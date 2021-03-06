<?php

// model autogenerated by model_maker.php
class chats extends table
{
    // Primary keys
    protected $primaryKeys = array('id_user_requester', 'id_user_sender');

    // fields:
    public $id_user_requester = null;
    public $id_user_sender = null;
    public $last_message_id = null;

    // Singleton last message 
    private $last_message_object = null;
    public function getMessage() {
        if(empty($this->last_message_object)) {
            $this->last_message_object = new mensajes($this->last_message_id);
        }
        return $this->last_message_object;
    }

    // user sender singleton
    private $obj_user_sender;
    public function getUserSender() {
        if(empty($this->obj_user_sender)) {
            $this->obj_user_sender = new users($this->id_user_sender);
        }
        return $this->obj_user_sender;
    }

    // user requester singleton
    private $obj_user_requester;
    public function getUserRequester() {
        if(empty($this->obj_user_requester)) {
            $this->obj_user_requester = new users($this->id_user_requester);
        }
        return $this->obj_user_requester;
    }

}