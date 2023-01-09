<?php

namespace backend\Domain\Dto;

class PokemonDto
{
    public string $id;
    public string $name;
    public string $description;

    /**
     */
    public function __construct(
            string $id,
            string $name,
            string $description
    
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }
}