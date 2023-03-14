<?php $render('header'); ?>

<container>
    <?php echo wordwrap(substr($alias['alias_name'],0), 20, "<br />", true); ?>
    <br>
    <button href="<?=$base;?>/sobre">sobre</button>
    <br>
    <a href="<?=$base;?>/sobre" target="_blank" class="button">sobre</a>
</container>

<br><br>
<?=$base;?>
<br>
Opa, <?=$nome;?>

<?php $render('footer'); ?>