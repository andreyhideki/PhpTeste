<?php

namespace backend\Infra;

use backend\Domain\Interfaces\IRepository;
use backend\Domain\Pokemon;
use backend\Libs\Connection;

class PokemonRepository implements IRepository{

	private $bd;

    public function __construct() {
        $this->bd = Connection::getInstance();
    }

	/**
	 * @return mixed
	 */
	public function getAll() {
		$sql = "select * from poke.pokemon";
		//return $sql;
		$stmt = $pdo->prepare("$sql WHERE id=?");
		$stmt->execute([$id]);
		return Pokemon::$stmt->fetchObject();
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function getById($id) {
        return "select id from poke.pokemon where id = $id";
	}

	public function add($pokemon){
		return "insert into poke.pokemon(name, description) values($pokemon->name,$pokemon->description)";
	}

}