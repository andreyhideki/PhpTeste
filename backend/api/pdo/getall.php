<?php

require('../../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
$methodDefault = 'get';

if($method === $methodDefault){
    $sql = $pdo->query("SELECT * FROM poke.pokemon");
    if($sql->rowCount() > 0){
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $item){
            $array['result'][] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'description' => $item['description']
            ];
        }
    }

}
else{
    $array['error'] = 'Método não permitido('.$methodDefault.')';
}


require('../../return.php');