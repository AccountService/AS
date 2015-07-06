<!DOCTYPE html>


<?php
$loader = '/../../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();
$request = Request::createFromGlobals();

$DB = new db();

$jsondata = file_get_contents("products.json");
$json = json_decode($jsondata, true);

$session->start();
if($request->query->has('exit')) {
    $session->invalidate();

    echo '<script>
        document.location.href = "/";
        </script>';
}

?>


<body>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../../style/materialize/js/materialize.min.js"></script>

<section class="wrapper" style="float:left;">

    <section class="material-design-hamburger">
        <button class="material-design-hamburger__icon">
            <span class="material-design-hamburger__layer"></span>
        </button>
    </section>

    <section class="menu menu--off">
        <?php
        if($session->has('name')) { ?>
            <div><a href="/">Products</a></div>
            <div><a href="/keys">My keys</a></div>
            <div><a href="?exit">Exit</a></div>

        <?php
        } else { ?>
            <div><a href="../../">Products</a></div>
            <div><a href="/reg">Registration</a></div>
        <?php
        } ?>
    </section>

</section>

<div class="container-form">

   <center><h1>REGISTRATION</h1></center>

</div>


<div class="container-main">

    <?php
    /*if(isset($_POST['name'])&&isset($_POST['email'])) {
        $regInfo = array('name' => $_POST['name'], 'email' => $_POST['email']);

        $regInfo = json_encode($regInfo);
        //var_dump($regInfo);*/

    $DB = new db();

    if(($request->request->has('name') && $request->request->has('email')) &&
        ($request->request->has('pass') && $request->request->has('pass_again'))) {

        $user = new User($request->request->get('name'), $request->request->get('email'), $request->request->get('pass'));

        if($DB->isUserExist($user->getEmail())) {
            echo "<center>User is already exist!<br><br></center>";
        }   else {
            if ($request->request->get('pass') == $request->request->get('pass_again')) {
                $DB->registration($user->getName(), $user->getEmail(), $user->getPassword());

                $user->setID($DB->getUserId($user->getEmail()));
                $regInfo = array('name' => $user->getName(), 'email' => $user->getEmail(), 'id' => $user->getID());
                $regInfo = json_encode($regInfo);

                $url = "dev/addUser.php";
                $host = 'http//10.55.33.27/';
                $partner = 'CRM';
                $password = 'password';
                $signer = new signurl();
                $reg_url = $signer->UrlSigner($host,$url,$partner,$password);

                $DB->sendData("regInfo", $regInfo, $reg_url);

                echo "<script>location.href = 'index.php';</script>";
            } else {
                echo "<center><h2>Passwords do not match!<br><br></h2></center>";
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
                <input type="email" class="reg-input inputWidth" name="email" required style="width: 400px; padding: 2px; border: 1px outset gray;">
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

<footer>
    <br><br>
    <center>2015 © Account Service </center>
    <br>
</footer>

<script src="../../style/js/index.js"></script>

<link rel="import" href="https://www.polymer-project.org/0.5/components/paper-ripple/paper-ripple.html">
<link rel="import" href="http://www.polymer-project.org/components/core-icons/core-icons.html">
<link rel="import" href="http://www.polymer-project.org/components/font-roboto/roboto.html">

</body>
</html>






