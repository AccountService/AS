<?php
include_once('pdo.php');
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
        if(isUserExist(get_db_connect(), $_POST['email'])) {
            echo "<center>User is already exist!</center>";
        } else {
            if ($_POST['pass'] == $_POST['pass_again']) {
                registration(get_db_connect(), $_POST['name'], $_POST['email'], $_POST['pass']);
                echo "<script>location.href = 'auth.php';</script>";
            } else {
                echo "<center>Passwords do not match!</center>";
            }
        }
    }