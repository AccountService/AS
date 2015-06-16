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
    <div><a href="#">Products</a></div>
    <div><a href="#">My key</a></div>
	<div><a href="#">Exit</a></div>
  </section>
  
</section>
<div style="float:left;">
	
</div>
 <div class="container-form">

  
  <form>
    
    <div class="group left-move">      
      <input type="text" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>e-mail:</label>
    </div>
		
    <div class="group left-move">      
      <input type="text" required>
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
 
  
</div>
<br>
	 <div class="container-main">
		<center>
<?php $i = 0; ?>
            <?php foreach ($json['products'] as $key => $value) : ?>
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

            endforeach; ?>

     </div>

















    
        <script src="js/index.js"></script>

    <link rel="import" href="https://www.polymer-project.org/0.5/components/paper-ripple/paper-ripple.html">
  <link rel="import" href="http://www.polymer-project.org/components/core-icons/core-icons.html">
  <link rel="import" href="http://www.polymer-project.org/components/font-roboto/roboto.html">




  
  
  
  </body>
</html>
