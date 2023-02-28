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
	private $tabela;

    public function __construct(PDO $driver) {
        $this->bd = Connection::getInstance();
		$this->pdo = $driver;
		$this->tabela = "poke.pokemon";
	}

	/**
	 * @return mixed
	 */
	public function findAll() {
		$sql = $this->pdo->query("select * from {$this->tabela}");

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
		return "select id from {$this->tabela} where id = $id";
	}
	
	/**
	 * @param mixed $entity
	 * @return mixed
	 */
	public function add($entity) {
		return "insert into {$this->tabela}(name, description) values($entity->name,$entity->description)";
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