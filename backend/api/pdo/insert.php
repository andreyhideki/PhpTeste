<?php

require('../../cconfig.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
$methodDefault = 'post';

if($method === $methodDefault){

    $name = filter_input(INPUT_POST, 'name');
    $description = filter_input(INPUT_POST, 'description');

    if($name && $description){
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
    else{
        $array['error'] = 'Campos obrigatórios!';
    }
}
else{
    $array['error'] = 'Método não permitido ('.$methodDefault.')';
}


require('../../creturn.php');