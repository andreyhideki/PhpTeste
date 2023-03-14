<?php

require('../../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
$methodDefault = 'get';

if($method === $methodDefault) {
    $id = filter_input(INPUT_GET, 'id');

    if ($id && !is_null($id))
    {

        $sql = $pdo->prepare('SELECT * FROM poke.pokemon where id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $item) {
                $array['result'][] = [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'description' => $item['description']
                ];
            }
        } else {
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


require('../../return.php');