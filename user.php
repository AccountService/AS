
<?php

    include('pdo.php');
    $jsondata = file_get_contents("products.json");
    $json = json_decode($jsondata, true);
    session_start();

    if(!isset($_SESSION['logged']))  {echo"<script>location.href = 'auth.php';</script>";}
?>

<div>
            <?php foreach ($json['products'] as $key => $value) : ?>
                <form action="test.php" method="post">
                        <input type="hidden" name="id" value="<?=$value['id']?>">
                        <?=$value['name']?>
                        cost:    <?=$value['price']?>
                        <input type="submit" value="Buy">
                        <br>
                   </form>
            <?php endforeach; ?>

        <?php
        $keys = getAllBuyedKeys($_SESSION['id'], get_db_connect());
       foreach ($keys as $key => $value) : ?>
            <?=  $key.':'.'<br>' ;
            echo "<ul>";
                foreach($value as $key) {
                    echo "<li>$key</li>";
                }
           echo "</ul>";
           echo "<br>";
           ?>
        <?php endforeach;
        //var_dump($keys);
        ?>

</div>

<div>
    <form action="" method="post">
        Validate your key:
        <input type="text" name="key" placeholder="license key">
        <input type="submit" name="key_subm">

    </form>
    <?php
        if(isset($_POST['key'])) {
            keyValidation($_POST['key']);
            connectKeyToUser($_POST['key'], $_SESSION['id']);
            header('Location: user.php');
            exit();
        }
    ?>

</div>