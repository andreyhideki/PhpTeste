<?php

namespace src\Infra;

use Domain\Dto\PokemonDto;
use PDO;
use src\core\Util;
use src\Domain\Interfaces\IRepository;
use src\Libs\Connection;

class PokemonRepository implements IRepository{
// class PokemonRepository{

	private $pdo;
	private $bd;
	private $query;
	private $queryResult;
	private $pokemonsDto = [];
	private $tabela;

    //public function __construct(PDO $driver) {
    public function __construct() {
        $this->bd = Connection::getInstance();
		//$this->pdo = $driver;
		$this->tabela = "poke.pokemon";

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "";

        $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    }

	/**
	 * @return mixed
	 */
	public function findAll() {
        $sql = $this->pdo->prepare("SELECT * FROM {$this->tabela}");
        $sql->execute();
        $objects = $sql->fetchAll(\PDO::FETCH_CLASS);
        if($sql->rowCount() > 0){
            $u = new Util();
            var_dump($u->arrayToObject($objects, "PokemonDto"));
            die();
        }

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