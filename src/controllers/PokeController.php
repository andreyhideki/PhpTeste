<?php

namespace src\controllers;

use PDO;
use src\core\Controller;
use src\Domain\Dto\PokemonDto;

class PokeController extends Controller {

    public function index() {
        echo("Pokemon Controller index");
    }

    public function getall(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "";
        
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $array = [
            'error' => '',
            'result' => []
        ];

        $sql = $pdo->query("SELECT * FROM poke.pokemon");
        if($sql->rowCount() > 0)
        {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            $arr = array();
            foreach($data as $item)
            {
                array_push($arr,new PokemonDto($item['id'], $item['name'], $item['description']));
            }
            //echo json_encode($arr);
            $array['result'][] = $arr;
        }
        else
        {
            $array['error'] = 'Nenhum registro encontrado';
        }

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Content-Type: application/json");
        echo json_encode($array);
    }

    public function get(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "";
        
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $array = [
            'error' => '',
            'result' => []
        ];

        $id = filter_input(INPUT_GET, 'id');

        if(!$id)
        {
            $array['error'] = 'Código obrigatório!';
            echo json_encode($array);
            return;
        }

        $sql = $pdo->prepare('SELECT * FROM poke.pokemon where id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0)
        {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $item){
                $array['result'][] = new PokemonDto($item['id'], $item['name'], $item['description']);
            }
        }
        else
        {
            $array['error'] = 'Registro não existente!';
        }


        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Content-Type: application/json");
        echo json_encode($array);
    }

    public function insert(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "";
        
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $array = [
            'error' => '',
            'result' => []
        ];

        $json = file_get_contents('php://input');
        $data = json_decode($json,true);

        $name = $data['name'] ?? null;
        $description = $data['description'] ?? null;

        if($name && $description)
        {
            $sql = $pdo->prepare('INSERT INTO poke.pokemon(name, description) VALUES(:name, :description)');
            $sql->bindValue(':name', $name);
            $sql->bindValue(':description', $description);
            $sql->execute();

            $id = $pdo->lastInsertId();
            $array['result'][] = new PokemonDto($id, $name, $description);
        }
        else
        {
            $array['error'] = 'Campos obrigatórios!';
        }

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Content-Type: application/json");
        echo json_encode($array);
    }

    public function update(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "";
        
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $array = [
            'error' => '',
            'result' => []
        ];

        $data = file_get_contents("php://input");
        $json = json_decode($data, true);

        $id = $json['id'] ?? null;
        $name = $json['name'] ?? null;
        $description = $json['description'] ?? null;

        //limpa as variaveis padronizando
        $id = filter_var($id);
        $name = filter_var($name);
        $description = filter_var($description);

        if($id && $name && $description)
        {
            $sql = $pdo->prepare("SELECT * FROM poke.pokemon WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            if ($sql->rowCount() > 0)
            {
                $sql = $pdo->prepare("UPDATE poke.pokemon SET name = :name, description = :description WHERE id = :id");
                $sql->bindValue(':id', $id);
                $sql->bindValue(':name', $name);
                $sql->bindValue(':description', $description);
                $sql->execute();

                $array['result'][] = new PokemonDto($id, $name, $description);
            }
            else
            {
                $array['error'] = 'ID não existe!';
            }
        }
        else
        {
            $array['error'] = 'Dados não preenchidos!';
        }


        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Content-Type: application/json");
        echo json_encode($array);
    }

    public function delete(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "";
        
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $array = [
            'error' => '',
            'result' => []
        ];

        $data = file_get_contents("php://input");
        $json = json_decode($data, true);

        $id = $json['id'] ?? null;

        //limpa as variaveis padronizando
        $id = filter_var($id);

        if($id)
        {
            $sql = $pdo->prepare("SELECT * FROM poke.pokemon WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            if ($sql->rowCount() > 0)
            {
                $sql = $pdo->prepare("DELETE FROM poke.pokemon WHERE id = :id");
                $sql->bindValue(':id', $id);
                $sql->execute();
            }
            else
            {
                $array['error'] = 'ID não existe!';
            }
        }
        else
        {
            $array['error'] = 'ID não preenchido!';
        }

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Content-Type: application/json");
        echo json_encode($array);
    }
}