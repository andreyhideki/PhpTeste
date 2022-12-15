<?php

namespace backend\Domain;

class Pokemon
{
    public $id;
    public $name;
    public $description;

    function __construct($id, $name, $description) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    function get_id() {
        return $this->id;
    }

    function get_name() {
        return $this->name;
    }

    function get_description(){
        return $this->description;
    }
}