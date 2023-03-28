<?php

namespace src\Domain\Models;

class Pokedex{
    public $coachId;
    public $pokemons;

    function __construct($coachId) {              
        $this->coachId = $coachId;
    } 

    function populatePokemons() {    
        $this->pokemons[] = '';
    }     

    function addPokemon($pokemon){
        $this->pokemons .= $pokemon;
    }

}