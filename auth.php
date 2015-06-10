<?php
    include_once('pdo.php');
    function isAuthorize($db, $login, $password) {
        $query = $db->prepare("SELEC * FROM users WHERE email=:email AND password=:password");
        $query->bindParam(':email',$login, PDO::PARAM_STR);
        $query->bindParam(':password',$password, PDO::PARAM_STR);
        $query->execute();
        if($query->fetch(PDO::FETCH_ASSOC) != false) {
            return true;
        } else {return false;}
    }

?>
<div style="margin-top: 35%; margin-left: 35%">
    <form action="user.php" method="post">
        Login:<br>
        <input type="text" name="login"><br>
        Password:<br>
        <input type="text" name="pass"><br>
        <input type="submit" value="Sign in">
    </form>
</div>