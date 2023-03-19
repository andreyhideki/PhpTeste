<?php

namespace src\controllers;

use core\Controller;
use PDO;

class PokeController extends Controller {

    // private function __construct() { 

    // }

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

        if($method === $methodDefault)
        {
            $sql = $pdo->query("SELECT * FROM poke.pokemon");
            if($sql->rowCount() > 0)
            {
                $data = $sql->fetchAll(PDO::FETCH_ASSOC);

                foreach($data as $item)
                {
                    $array['result'][] = [
                        'id' => $item['id'],
                        'name' => $item['name'],
                        'description' => $item['description']
                    ];
                }
            }
        }
        else
        {
            $array['error'] = 'Método não permitido';
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

        if($method === $methodDefault)
        {

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
        }
        else
        {
            $array['error'] = 'Método não permitido';
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
}