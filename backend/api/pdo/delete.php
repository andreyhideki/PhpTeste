<?php

require('../../cconfig.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
$methodDefault = 'delete';

if($method === $methodDefault){

    parse_str(file_get_contents('php://input'), $input);

    $id = $input['id'] ?? null;
    
    //limpa as variaveis padronizando
    $id = filter_var($id);
    
    if($id) {
        $sql = $pdo->prepare("SELECT * FROM poke.pokemon WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {

            $sql = $pdo->prepare("DELETE FROM poke.pokemon WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            
        }
        else{
            $array['error'] = 'ID não existe!';    
        }
    }
    else{
        $array['error'] = 'ID não preenchido!';    
    }
}
else{
    $array['error'] = 'Método não permitido('.$methodDefault.')';
}


require('../../creturn.php');