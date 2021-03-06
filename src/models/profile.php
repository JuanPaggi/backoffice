<?php

// model autogenerated by model_maker.php
class profile extends table
{
    // Primary keys
    protected $primaryKeys = 'id_user';

    // fields:
    public $id_user = null;
    public $headline = null;
    public $industry = null;
    public $country = null;
    public $location = null;
    public $linkedin_url = null;
    public $summary = null;
    public $current_position = null;
    public $company_name = null;

    // SINGLETON PARA VISTA:
    public $country_object;
    public function getPais() {
        if(empty($this->country_object)) {
            $this->country_object = new countries($this->country);
        }
        return $this->country_object;
    }
    // fin singleton para obtener sub-pais

}