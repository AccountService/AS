<?php
    include_once('pdo.php');
    function isAuthorize($db, $login, $password) {
        $query = $db->prepare("SELECT * FROM users WHERE email=:email AND password=password(:password)");
        $query->bindParam(':email',$login, PDO::PARAM_STR);
        $query->bindParam(':password',$password, PDO::PARAM_STR);
        $query->execute();
        if($query->fetch(PDO::FETCH_ASSOC) != false) {
            return true;
        } else {return false;}
    }

?>
<div style="margin-top: 15%; margin-left: 43%">
    <form method="post">
        Login:<br>
        <input type="text" name="login"><br>
        Password:<br>
        <input type="password" name="pass"><br>
        <input type="submit" value="Sign in" name="signin">
        <input type="submit" value="Sign up" name="signup">
    </form>
</div>
<?php
    if(isset($_POST['login']) && isset($_POST['pass'])) {
        if(isAuthorize(get_db_connect(),$_POST['login'], $_POST['pass'])) {
            session_start();
            $_SESSION['logged']=true;
           //Тут в сесси нужно будет хранить id пользователя
            header('Location: /AccountService/AS/user.php');
        } else {echo "<center>Wrong login or password!</center>";}
    }
    if(isset($_POST['signup'])) {
        header('location:signup.php');
    }
?>