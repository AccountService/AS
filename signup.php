<?php
include_once('pdo.php');
    function registration($db, $name, $email, $password) {
        $query = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, password(:password))");
        $query->bindParam(':name',$name, PDO::PARAM_STR);
        $query->bindParam(':email',$email, PDO::PARAM_STR);
        $query->bindParam(':password',$password, PDO::PARAM_STR);
        $query->execute();
    }
?>
<div style="margin-top: 15%; margin-left: 43%">
    <form method="post">
        Name:<br>
        <input type="text" name="name" placeholder="Name"><br>
        Email:<br>
        <input type="text" name="email" placeholder="Email"><br>
        Password:<br>
        <input type="password" name="pass" placeholder="Password"><br>
        Password again:<br>
        <input type="password" name="pass_again" placeholder="Password again"><br>
        <input type="submit" value="Sign up">
    </form>
</div>

<?php
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['pass_again'])) {
        if($_POST['pass'] == $_POST['pass_again']) {
            registration(get_db_connect(), $_POST['name'], $_POST['email'], $_POST['pass']);
            echo "<center>Registration successful</center>>";
        } else {echo "<center>Passwords do not match!</center>";}
    }