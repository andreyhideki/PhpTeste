<?php

namespace Infra;

use Domain\Dto\PokemonDto;
use Domain\Interfaces\IRepository;
use Exception;
use Libs\Connection;
use PDO;

class PokemonRepository implements IRepository{
// class PokemonRepository{

	private $pdo;
	private $bd;
	private $query;
	private $queryResult;
	private $pokemonsDto = [];

    public function __construct(PDO $driver) {
        $this->bd = Connection::getInstance();
		$this->pdo = $driver;
	}

	/**
	 * @return mixed
	 */
	public function findAll() {
		$tabela = "poke.pokemon";
		$sql = $this->pdo->query("select * from {$tabela}");

		$array = [];
		if($sql->rowCount() > 0){
			$data = $sql->fetchAll();

			foreach($data as $item){
				$p = new PokemonDto($item['id'],$item['name'],$item['description']);

				$array[] = $p;
			}
		}

		return $array;
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function findById($id) {
		return "select id from poke.pokemon where id = $id";
	}
	
	/**
	 * @param mixed $entity
	 * @return mixed
	 */
	public function add($entity) {
		return "insert into poke.pokemon(name, description) values($entity->name,$entity->description)";
	}

	/**
	 *
	 * @param mixed $entity
	 * @return mixed
	 */
	public function update($entity) {
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function delete($id) {
	}
	
}