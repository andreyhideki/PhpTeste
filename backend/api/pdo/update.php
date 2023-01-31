<?php

require('../../cconfig.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
$methodDefault = 'put';

if($method === $methodDefault){

    parse_str(file_get_contents('php://input'), $input);

    $id = $input['id'] ?? null;
    $name = $input['name'] ?? null;
    $description = $input['description'] ?? null;

    //limpa as variaveis padronizando
    $id = filter_var($id);
    $name = filter_var($name);
    $description = filter_var($description);

    if($id && $name && $description) {
        $sql = $pdo->prepare("SELECT * FROM poke.pokemon WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {

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
        else{
            $array['error'] = 'ID não existe!';    
        }
    }
    else{
        $array['error'] = 'Dados não preenchidos!';    
    }
}
else{
    $array['error'] = 'Método não permitido('.$methodDefault.')';
}


require('../../creturn.php');