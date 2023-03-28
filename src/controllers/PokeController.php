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

        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $methodDefault = 'get';

        $sql = $pdo->query("SELECT * FROM poke.pokemon");
        if($sql->rowCount() > 0)
        {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            $arr = array();
            foreach($data as $item)
            {
                array_push($arr,new PokemonDto($item['id'], $item['name'], $item['description']));
            }
            //var_dump($arr);
            //var_dump($arr[0]->id);
            //de();
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

        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $methodDefault = 'get';

        $id = filter_input(INPUT_GET, 'id');

        if($id)
        {
            $sql = $pdo->prepare('SELECT * FROM poke.pokemon where id = :id');
            $sql->bindValue(':id', $id);
            $sql->execute();

            if($sql->rowCount() > 0)
            {
                $data = $sql->fetchAll(PDO::FETCH_ASSOC);

                foreach($data as $item){
                    $array['result'][] = [
                        'id' => $item['id'],
                        'name' => $item['name'],
                        'description' => $item['description']
                    ];
                }
            }
            else
            {
                $array['error'] = 'Registro não existente!';
            }
        }
        else
        {
            $array['error'] = 'Código obrigatório!';
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

        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $methodDefault = 'post';

        if($method === $methodDefault)
        {
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

                $array['result'] = [
                    'id' => $id,
                    'name' => $name,
                    'description' => $description
                ];
                
            }
            else
            {
                $array['error'] = 'Campos obrigatórios!';
            }
        }
        else
        {
            $array['error'] = 'Método não permitido ('.$methodDefault.')';
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

        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $methodDefault = 'put';
        if($method === $methodDefault)
        {
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
                    
                    $array['result'][] = [
                        'id' => $id,
                        'name' => $name,
                        'description' => $description
                    ];
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
        }
        else
        {
            $array['error'] = 'Método não permitido('.$methodDefault.')';
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

        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $methodDefault = 'delete';

        if($method === $methodDefault)
        {
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
        }
        else
        {
            $array['error'] = 'Método não permitido('.$methodDefault.')';
        }

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Content-Type: application/json");
        echo json_encode($array);
    }
}