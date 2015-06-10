<?php
    include_once('generator.php');
    include_once('connections.php');
    ?>
<form action="" METHOD="post">
    <input type="text" name="pr_name" placeholder="Product">
    <input type="text" name="number" placeholder="number of keys">
    <input type='submit'>
</form>

<?php

    if(isset($_POST['number']) && isset($_POST['pr_name'])) {
        $prname=$_POST['pr_name'];
        $keyarray=createkeys($_POST['number']);
        echo '<form action="test.php" method="post">';
        echo'<textarea cols="100" rows="20" name="keys">';
        echo "$prname:<br>\n";
        echo $keyarray;
        echo '</textarea>';
        echo '<input type="submit">';

    }

?>
