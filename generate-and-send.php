<?php
    include_once('generator.php');
    ?>
<form action="" METHOD="post">
    <input type="text" name="id" placeholder="Product">
    <input type="text" name="number" placeholder="number of keys">
    <input type='submit'>
</form>

<?php

    if(isset($_POST['number']) && isset($_POST['id'])) {
        $prname=$_POST['id'];
        $keyarray=createkeys($_POST['number'],$prname);
        echo '<form action="test.php" method="post">';

        echo "$prname:<br>\n";
        var_dump($keyarray);

        echo '<input type="submit">';

    }

?>
