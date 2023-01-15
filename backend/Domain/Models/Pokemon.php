<?php

namespace Domain\Models;

class Pokemon
{
    public string $id;
    private string $name;
    private string $description;

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

    public function setName($name){
        $this->name = ucfirst($name); 
    }
    
    function get_description(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }
}
