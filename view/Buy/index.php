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

    <?php
    if($session->has('name')) {
        $name = $session->get('name');

        echo "<h2>Hello, $name</h2>";
    } else {?>
        <form method="POST">

            <div class="group left-move">
                <input type="text" name="login" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>e-mail:</label>
            </div>

            <div class="group left-move">
                <input type="password" name="pass" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>password:</label>
            </div>

            <div class="left-move button-move1">
                <button class="btn waves-effect waves-light floating" type="submit" name="action">LOG IN</button>
            </div>

            <br><br>

            <a style="margin-left:30px;" href="/reg">sign-up</a>

        </form>
    <?php
    }?>

</div>

<br>

<div class="container-main">
   <?php
   $id = $request->query->get('id');
   $count = $request->query->get('count');
   $url = "/product.php?id=$id&count=$count";
   //echo $url;
   $host = '10.55.33.36';
   $card = '9999999999999999';
   $password = 'password';
   $buyer = new signurl();
   $buy_url = $buyer->UrlSigner($host,$url,$card,$password);
   echo "<center><h1><a href='$buy_url'>press to continue</a></h1></center>";
   header("location:http://$buy_url")
   ?>
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

