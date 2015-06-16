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

<?php if(isset($_GET['auth']) && $_GET['auth'] == 1 ) {$_SESSION['auth']=1; echo $_SESSION['auth'];}?>
      <?php if(isset($_GET['exit']) && $_GET['exit'] == 1 && isset($_SESSION['auth'])) {$_SESSION['auth']=0;}?>
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
      <?php if(isset($_SESSION['auth']) && $_SESSION['auth']==1) { ?>
          <div><a href="index.php?keys=1">My keys</a></div>
      <div><a href="index.php?exit=1">Exit</a></div>

      <?php } ?>
  </section>
  
</section>
<div style="float:left;">
	
</div>
 <div class="container-form">

  <?php if(isset($_SESSION['auth']) && $_SESSION['auth']==1) {
      $name = $_SESSION['name'];
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

          <a style="margin-left:30px;" href="signup.php">sign-up</a>


      </form>
 <?php }?>

  
</div>
<br>
	 <div class="container-main">
         <?php
         if(isset($_POST['login']) && isset($_POST['pass'])) {
             if(isAuthorize(get_db_connect(),$_POST['login'], $_POST['pass'])) {
                 session_start();
                 $_SESSION['logged']=true;
                 $_SESSION['id'] = getUserId(get_db_connect(), $_POST['login']);
                 $_SESSION['name'] = getUserName(get_db_connect(), $_SESSION['id']);
                 header('Location:index.php?auth=1');
                 $_SESSION['exit'] = 0;
             } else {echo "<center><h3>Wrong email or password!</h3><br><br></center>";}
         }
         if(isset($_POST['signup'])) {
             header('Location: signup.php');
         }
         ?>
		<center>

            <?php if(isset($_GET['keys']) && $_GET['keys']==1) {
                $keys = getAllBuyedKeys($_SESSION['id'], get_db_connect());
                foreach ($keys as $key => $value) :
                 echo  $key.':'.'<br>' ;
                echo "<ul>";
                foreach($value as $key) {
                 echo "<li>$key</li>";
                }
                echo "</ul>";
                echo "<br>";
                endforeach;
            } else {

            $i = 0;
            foreach ($json['products'] as $key => $value) : ?>
                <form action="test.php" method="get" class="form-selector">
                    <input type="hidden" name="id" value="<?=$value['id']?>">
                    <div class="dialog" >

                        <div class="content">
                            <div class="title"><?=$value['name']?></div><br>
                            <div>Product description and other Lorem ipsum dolor sit amet...</div>
                        </div>

                        <button class="btn waves-effect waves-light floating" type="submit">$<?=$value['price']?>

                        </button>

                        <button class="btn waves-effect waves-light" type="submit">Buy

                        </button>


                    </div>
                </form>

            <?php
                $i++;
                if ($i%2==0) {echo '<br><br><br>';}

            endforeach; }?>
        </center>
     </div>

        <script src="js/index.js"></script>

    <link rel="import" href="https://www.polymer-project.org/0.5/components/paper-ripple/paper-ripple.html">
  <link rel="import" href="http://www.polymer-project.org/components/core-icons/core-icons.html">
  <link rel="import" href="http://www.polymer-project.org/components/font-roboto/roboto.html">

  </body>
</html>
