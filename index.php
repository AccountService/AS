<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">

     <?php include('pdo.php');
      $jsondata = file_get_contents("products.json");
      $json = json_decode($jsondata, true);
      session_start();
    ?>
    
    
    
        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  <body>

    <section class="wrapper" style="float:left;">

  <section class="material-design-hamburger">
    <button class="material-design-hamburger__icon">
      <span class="material-design-hamburger__layer"></span>
    </button>
  </section>

  <section class="menu menu--off">
    <div><a href="#">Продукты</a></div>
    <div><a href="#">Мои ключи</a></div>
	<div><a href="#">Выход</a></div>
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
      <label>Name</label>
    </div>
		
    <div class="group left-move">      
      <input type="text" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Email</label>
    </div>
     <div class="button raised left-move button-move">
      <div class="center" fit>LOG IN</div>
      <paper-ripple fit></paper-ripple>
    </div>
	<br>
		<div class="button-reg reg">
        <div class="right" fit>sign-up</div>
        <paper-ripple fit></paper-ripple>
      </div>
	
  </form>
 
  
</div>
<br>
	 <div class="container-main">
		<center>
<?php $i = 0; ?>
            <?php foreach ($json['products'] as $key => $value) : ?>
                <form action="test.php" method="post" class="form-selector">
                    <input type="hidden" name="id" value="<?=$value['id']?>">
                    <div class="dialog" >

                        <div class="content">
                            <div class="title"><?=$value['name']?></div><br>
                            <div>Описание продукта. Тут можно писать короткое описание продукта</div>
                        </div>

                        <div class="button label-blue">
                            <div class="center" fit>Купить</div>
                            <paper-ripple fit></paper-ripple>
                        </div>

                        <div class="button">
                            <div class="center" fit> <?=$value['price']?></div>
                            <paper-ripple fit></paper-ripple>
                        </div>

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
