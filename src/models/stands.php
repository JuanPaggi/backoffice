<?php

// model autogenerated by model_maker.php
class stands extends table
{
    // Primary keys
    protected $primaryKeys = 'id_stand';

    // fields:
    public $id_stand = null;
    public $id_event = null;
    public $name = null;
    public $logo = null;
    public $id_user_organizer = null;
    public $gancho;

    // singleton getOrganizador 
    private $user_organizer = null;
    public function getOrganizador() {
        if(empty($this->user_organizer)) {
            $this->user_organizer = new users($this->id_user_organizer);
        }
        return $this->user_organizer;
    }
    // fin singleton getOrganizador

    public function countCheckins() {
        return stands_checkin::count('id_user', 'WHERE id_stand = ?', array($this->id_stand));
    }
}