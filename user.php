<?php
    $jsondata = file_get_contents("products.json");
    $json = json_decode($jsondata, true);
?>

<div>
        <ul>
            <?php foreach ($json['products'] as $key => $value) : ?>
                <form action="test1.php" method="post">
                        <li>
                        <input type="hidden" name="id" value="<?=$value['id']?>">
                        <?=$value['name']?>
                        cost:    <?=$value['price']?>
                        <input type="submit" value="Buy">
                        </li>
                        <br>
                   </form>
            <?php endforeach; ?>
        </ul>

</div>