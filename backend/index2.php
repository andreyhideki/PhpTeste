<?php
use Infra\PokemonRepository;

require_once 'vendor/autoload.php';

//spl_autoload_register();

//$poke =  new \Domain\Dto\PokemonDto("1", "123","123");


$repo = new PokemonRepository($pdo);
$lista = $repo->findAll();

?>

<table border="1" width="100%">
    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Desc</th>
    </tr>
    <?php foreach($lista as $pokemon): ?>
        <tr>
            <td><?=$pokemon->getId(); ?></td>
            <td><?=$pokemon->getName(); ?></td>
            <td><?=$pokemon->getDescription(); ?></td>
            <td>
                <a href="edit.php?id=<?=$pokemon->getId();?>">[ Editar ]</a>
                <a href="delete.php?id=<?=$pokemon->getId();?>">[ Excluir ]</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>