<?php

namespace src\Domain\Models;

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

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    public function setName($name){
        $this->name = ucfirst($name); 
    }
    
    function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }
}
