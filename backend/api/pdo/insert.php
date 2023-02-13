<?php

require('../../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
$methodDefault = 'post';

if($method === $methodDefault)
{
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

    // var_dump($data);
    // var_dump($data['name']);
    // var_dump($data['description']);
    $name = $data['name'] ?? null;
    $description = $data['description'] ?? null;

    // $name = filter_input(INPUT_POST, 'name');
    // $description = filter_input(INPUT_POST, 'description');
    
    // var_dump($name,$description);
    // die();

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

require('../../return.php');