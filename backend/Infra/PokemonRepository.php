<?php

namespace backend\Infra;

use backend\Domain\Interfaces\IRepository;

class PokemonRepository implements IRepository{
	/**
	 * @return mixed
	 */
	public function getAll() {
        return "select * from poke.pokemon";
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function getById($id) {
        return "select * from poke.pokemon where id = $id";
	}

	public function add($pokemon){
		return "insert into poke.pokemon(name, description) values($pokemon->name,$pokemon->description)";
	}
}