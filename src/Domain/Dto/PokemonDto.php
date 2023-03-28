<?php

namespace src\Domain\Dto;

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

    public function __toString() {
        $output = self::CLASS . PHP_EOL;
        $output .= 'ID: ' . $this->id . PHP_EOL;
        $output .= 'name: ' . $this->name . PHP_EOL;
        $output .= 'description: ' . $this->description . PHP_EOL;
        return $output;
    }

}