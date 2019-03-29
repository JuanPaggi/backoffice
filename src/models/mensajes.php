<?php

// model autogenerated by model_maker.php
class mensajes extends table
{
    // Primary keys
    protected $primaryKeys = 'id_mensaje';

    // fields:
    public $id_mensaje = null;
    public $id_sender = null;
    public $id_target = null;
    public $messages = null;
    public $fecha = null;
    public $is_viewed = null;

    // singleton sender
    private $sender_object;
    public function getSender() {
        if(empty($this->sender_object)) {
            $this->sender_object = new users($this->id_sender);
        }
        return $this->sender_object;
    }
    // singleton target
    private $target_object;
    public function getTarget() {
        if(empty($this->target_object)) {
            $this->target_object = new users($this->id_target);
        }
        return $this->target_object;
    }

    public static function getAllByUsers($uA, $uB) {
        return mensajes::getAllObjects('id_mensaje', 'WHERE (id_target = ? AND id_sender = ?) OR (id_target = ? AND id_sender = ?) ORDER BY fecha DESC LIMIT 15', 
            array($uA, $uB, $uB, $uA));
    }

}