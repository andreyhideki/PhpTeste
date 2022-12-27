<?php

namespace backend\Domain;

class Pokemon
{
    public string $id;
    public string $name;
    public string $description;

    function __construct(string $id, string $name, string $description) {
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
