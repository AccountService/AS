<?php
    include_once('generator.php');
    ?>
<form action="" METHOD="post">
    <input type="text" name="pr_name" placeholder="Product">
    <input type="text" name="number" placeholder="number of keys">
    <input type='submit'>
</form>

<?php

    if(isset($_POST['number']) && isset($_POST['pr_name'])) {
        $prname=$_POST['pr_name'];
        $prod_id = getProductId($prname);
        if($prod_id == 'Undefined product') {
            echo $prod_id;
        } else {
            $keyarray = createkeys($_POST['number'], $prod_id);
            echo '<form action="test.php" method="post">';
            echo '<textarea cols="100" rows="20" name="keys">';
            echo "$prname:<br>\n";

            var_dump($keyarray);
            echo '</textarea>';
            echo '<input type="submit">';
        }
    }

?>
