

<?php
    $jsondata = file_get_contents("products.json");
    $json = json_decode($jsondata, true);
?>

<div>
            <?php foreach ($json['products'] as $key => $value) : ?>
                <form action="test1.php" method="post">
                        <input type="hidden" name="id" value="<?=$value['id']?>">
                        <?=$value['name']?>
                        cost:    <?=$value['price']?>
                        <input type="submit" value="Buy">
                        <br>
                   </form>
            <?php endforeach; ?>
</div>

<div>
    <form action="" method="post">
        <input type="text" name="key">
    </form>
</div>