<!DOCTYPE html>
<html >
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" charset="utf-8" />
    <link rel="stylesheet" href="../../style/css/style.css">

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
        header('Location:/');
    }
    if(!$session->has('logged')) {header('Location:/');}
    ?>

</head>

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
            <div><a href="/">Products</a></div>
            <div><a href="/reg">Registration</a></div>
        <?php
        } ?>
    </section>

</section>

<div class="container-form">

    <?php
    if($session->has('name')) {
        $name = $session->get('name');

        echo "<h2>Cancel Request</h2>";
    }   else {
            echo '<script>
                   document.location.href = "/";
                  </script>';

             }
    ?>

</div>

<br>

<div class="container-main">
    <center><h1>
            Your request has been sent.<br>
            <a href="/">Back to HOME</a></h1>
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

