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
    //if(isset($_POST['login']) && isset($_POST['pass'])) {
    if($request->request->has('login') && $request->request->has('pass')) {
        if($DB->isAuthorize($request->request->get('login'), $request->request->get('pass'))) {

            //$_SESSION['logged']=true;
            $session->set('logged', true);

            //$_SESSION['login'] = ,$_POST['login'];
            $session->set('login', $request->request->get('login'));

            //$_SESSION['pass'] = $_POST['pass'];
            $session->set('pass', $request->request->get('pass'));

            //$_SESSION['id'] = $DB->getUserId($_POST['login']);
            $session->set('id', $DB->getUserId($request->request->get('login')));

            //$_SESSION['name'] = $DB->getUserName($_SESSION['id']);
            $session->set('name', $DB->getUserName($session->get('id')));

            echo '<script>
            document.location.href = "../../";
            </script>';

        } else {
            echo "<center><h3>Wrong email or password!</h3><br><br></center>";
        }

    }
    ?>
    <center>
        <?php


            $i = 0;
            foreach ($json['products'] as $key => $value) : ?>
                <form action="/buy" method="get" class="form-selector">
                    <input type="hidden" name="id" value="<?=$value['id']?>">
                    <div class="dialog" >
                        <div class="content">
                            <div class="title"><?=$value['name']?></div><br>
                            <div><?=$value['description']?></div>
                            Count:
                        </div>
                        <input type="text" style="width:100px; margin-top:-70px; text-align:center" value="1" name="count" pattern="^[1-9][0-9]*$">
                        <button class="btn waves-effect waves-light floating" type="submit">$<?=(float)$value['price']?>
                        </button>

                        <button class="btn waves-effect waves-light" type="submit">Buy
                        </button>

                    </div>
                </form>

                <?php
                $i++;
                if ($i%2==0) {echo '<br><br><br>';}

            endforeach;
        ?>

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

