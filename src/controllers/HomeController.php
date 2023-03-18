<?php

namespace src\controllers;

use core\Controller;
use PDO;

class HomeController extends Controller {

    // private function __construct() { 

    // }

    public function index() {
        echo("index");
        //$this->render('home', ['nome' => 'Teste']);
    }

    public function sobre() {
        // $this->render('sobre');
        echo("sobre");
    }

    public function sobreP($args) {
        print_r($args);
    }

    public function ping(){
        echo("PONG");
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
}