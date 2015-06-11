<?php
    include_once('pdo.php');
    function isAuthorize($db, $login, $password) {
        $query = $db->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
        $query->bindParam(':email',$login, PDO::PARAM_STR);
        $query->bindParam(':password',$password, PDO::PARAM_STR);
        $query->execute();
        if($query->fetch(PDO::FETCH_ASSOC) != false) {
            return true;
        } else {return false;}
    }

?>
<div style="margin-top: 35%; margin-left: 35%">
    <form method="post">
        Login:<br>
        <input type="text" name="login"><br>
        Password:<br>
        <input type="text" name="pass"><br>
        <input type="submit" value="Sign in" name="siginin">
        <input type="submit" value="Sign up">
    </form>
</div>
<?php
    if(isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['signin'])) {
        if(isAuthorize(get_db_connect(),$_POST['login'], $_POST['pass'])) {
            header('Location: /user.php');
        } else {echo "Wrong login or password!";}
    }