
<!DOCTYPE html>
<html >
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" charset="utf-8" />
    <link rel="stylesheet" href="css/style.css">


    <?php include('pdo.php');
    $jsondata = file_get_contents("products.json");
    $json = json_decode($jsondata, true);
    session_start();
    ?>







</head>

<body>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="materialize/js/materialize.min.js"></script>

<section class="wrapper" style="float:left;">

    <section class="material-design-hamburger">
        <button class="material-design-hamburger__icon">
            <span class="material-design-hamburger__layer"></span>
        </button>
    </section>

    <section class="menu menu--off">
        <div><a href="index.php">Products</a></div>
        <div><a href="signup.php">Registration</a></div>
    </section>

</section>
<div style="float:left;">

</div>
<div class="container-form">

<center><h2>REGISTRATION</h2></center>

</div>
<br>
<div class="container-main">

    <?php
if(isset($_POST['name'])&&isset($_POST['email'])) {
    $regInfo = array('name' => $_POST['name'], 'email' => $_POST['email']);

    $regInfo = json_encode($regInfo);
    //var_dump($regInfo);






    include_once('pdo.php');
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['pass_again'])) {
        if(isUserExist(get_db_connect(), $_POST['email'])) {
            echo "<center>User is already exist!</center>";
        } else {
            if ($_POST['pass'] == $_POST['pass_again']) {
                registration(get_db_connect(), $_POST['name'], $_POST['email'], $_POST['pass']);


                echo "<script>location.href = 'index.php';</script>";
            } else {
                echo "<center><h2>Passwords do not match!</h2></center>";
            }
        }
    }
}
    ?>


    <center>
        <form method="post">


            <div class="group-reg left-move">
                <input type="text" class="reg-input inputWidth" name="name" required  style="width: 400px; padding: 2px; border: 1px outset gray;">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="Absolute-Center">name:</label>
            </div>

            <div class="group-reg left-move">
                <input type="text" class="reg-input inputWidth" name="email" required style="width: 400px; padding: 2px; border: 1px outset gray;">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="Absolute-Center">e-mail:</label>
            </div>
            <div class="group-reg left-move">
                <input type="password" class="reg-input inputWidth" name="pass" required style="width: 400px; padding: 2px; border: 1px outset gray;">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="Absolute-Center">password:</label>
            </div>

            <div class="group-reg left-move">
                <input type="password" class="reg-input" name="pass_again" required style="width: 400px; padding: 2px; border: 1px outset gray;">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="Absolute-Center">confirm password:</label>
            </div>
            <div class="left-move button-move1 center-button" >
                <button class="btn waves-effect waves-light floating " type="submit" name="action" style="">SIGN UP</button>
            </div>
            <br><br>

            <a style="margin-left:30px;" href="index.php">login</a>


        </form>
    </center>



</div>


















<script src="js/index.js"></script>

<link rel="import" href="https://www.polymer-project.org/0.5/components/paper-ripple/paper-ripple.html">
<link rel="import" href="http://www.polymer-project.org/components/core-icons/core-icons.html">
<link rel="import" href="http://www.polymer-project.org/components/font-roboto/roboto.html">







</body>
</html>












































