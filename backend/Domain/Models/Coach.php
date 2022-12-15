<?php

namespace backend\Domain;

class Coach{
    public $name;
    public $city;
    public $state; //varchar(2),
	public $country; //varchar(50),
	public $status; //bool,
	public $godfather; //uuid FOREIGN KEY padrinho

    function __construct($name, $city, $state, $country, $status) {
        $this->name = $name;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->status = $status;
    }

    function addGodFather($idGodFater){
        $this->godfather = $idGodFater;
    }
    
    function get_name() {
        return $this->name;
    }

    function set_name($name) {
        $this->name = $name;
    }

    function get_city(){
        return $this->city;
    }
    function get_state(){
        return $this->state;
    }
    function get_country(){
        return $this->country;
    }
    function get_status(){
        return $this->status;
    }
    function set_status($status){
        $this->status = $status;
    }

}