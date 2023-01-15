<?php

namespace Infra;

use Domain\Interfaces\IRepository;
use Exception;
use Libs\Connection;
use PDO;

class PokemonRepository implements IRepository{
// class PokemonRepository{

	private $bd;
	private $query;
	private $queryResult;
	private $pokemonsDto = [];

    public function __construct() {
        $this->bd = Connection::getInstance();
	}

	/**
	 * @return mixed
	 */
	public function getAll() {
		$tabela = "poke.pokemon";
		$sql = "select * from {$tabela}";

		//$sql = "SELECT {$fields} FROM {$this->table} {$this->alias} {$joins} {$where} {$group} {$order} {$limit}";
        try {
            $this->query = $this->bd->query($sql);
            $this->queryResult = $this->query->fetchAll();
        } catch (Exception $e) {
            echo($e->getMessage());
        }
		echo ($this->queryResult);
		if (!empty($this->queryResult)) {
			foreach ($this->pokemonsDto as $$this->queryResult) {
				//$pokemonsDto
			}
		}

		// $stmt = $pdo->prepare("$sql WHERE id=?");
		// $stmt->execute([$id]);
		// return Pokemon::$stmt->fetchObject();


		// $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// $sql = 'SELECT id, name, description FROM poke.pokemon';
		// //$query = $conn->prepare('SELECT id, name, description	FROM poke.pokemon');
		// // $query = $conn->prepare($sql,array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));

		// foreach ($conn->query($sql) as $row) {
		// 	echo $row['id'] . "\t";
		// 	echo $row['name'] . "\t";
		// 	echo $row['description'] . "\t";
		// 	echo "<br>";
		// }
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