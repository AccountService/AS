<?php
    function registration($db, $name, $email, $password) {
        $query = $db->prepare("INSERT INTO user (name, email, password) VALUES (:name, :email, :password)");
        $query->bindParam(':name',$name, PDO::PARAM_STR);
        $query->bindParam(':email',$email, PDO::PARAM_STR);
        $query->bindParam(':password',$password, PDO::PARAM_STR);
        $query->execute();
    }
?>
<div style="margin-top: 35%; margin-left: 35%">
    <form method="post">
        Name:<br>
        <input type="text" name="name"><br>
        Email:<br>
        <input type="text" name="email"><br>
        Password:<br>
        <input type="text" name="pass"><br>
        Password again:<br>
        <input type="text" name="pass_again"><br>
        <input type="submit" value="Sign up">
    </form>
</div>