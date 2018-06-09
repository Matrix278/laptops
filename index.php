<?php
session_start();
require "moduls/languages.php";
require "moduls/categories.php";
require_once "moduls/dbconnect.php";

?>
<!DOCTYPE html>
<html>
  <head>
      <link rel="stylesheet" href="css/smoothproducts.css">
      
      <!-- google map -->
  <script src="js/gmaps.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js" type="text/javascript"></script>
<!-- google map -->

  <script type="text/javascript" src="js/jquery.min.js"></script>

  <!-- Main css -->
  <link rel="stylesheet" type="text/css" href="css/main.css"/>
  <!-- Main css -->

  <!-- Icon -->
  <link rel="icon" href="img/favicon.ico"/>
  <!-- Icon -->

  <!-- Bootstrap 4 -->
  <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
  <!-- Bootstrap 4 -->

  <!-- fancybox -->
  
<script type="text/javascript" src='js/jquery-1.8.3.min.js'></script>
<script type="text/javascript" src='js/jquery.elevatezoom.js'></script>

<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css" />
<script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>
<!-- fancybox -->
<!--<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>-->
<!--<script type="text/javascript" src="js/jquery.mousewheel.min.js"></script>
 fancybox -->

      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!--Ноутбуки | Мартин Сидоров-->
      <meta name="description=" content="Internet-showcase of laptops | Martin Sidorov">
      <style>
      /* Стиль таблицы в описании товара */
      table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    font-size: 18px;
    padding: 15px;
    margin: 10px;
    width: 40%;
}
/* Стиль таблицы в описании товара */

/* Размер карты в описании товара */
  #map {
  width: 400px;
  height: 500px;
}
/* Размер карты в описании товара */

/* Размер карты в контактах */
#contactsMap{
    width: 400px;
  height: 500px;
}
/*Размер карты в контактах */
.row{
    margin-right: 0px;
    margin-left: 0px;
}
.card-img-top{
    padding: 10px;
}
</style>
    </head>
<body>
    <!-- Header -->
    <div class="fluid-container">
  <div class="row header">
<!-- Лого -->
<!--class="align-self-center";-->
  <div class="col-xl-2 col-lg-4 col-md-4 col-sm-5 col-xs-6 logo">
    <a href="<?php echo "?ln=".$ln;?>"><img id="logoImg" class="card-img-top" src="img/logo.png" alt="Logo"></a>
</div>
<!-- Лого -->
<!-- Брэнд -->
<!--class="brand";-->
        <div class="col-xl-9 col-lg-7 col-md-5 col-sm-6 col-xs-5 h3 align-self-center"><?php echo $terms['laptopsBrand']; ?></div>
<!-- Брэнд -->

<!-- Языки -->
<!--<div class="col-xl-3 col-lg-2 col-md-3 col-sm-3 col-xs-3 service langLink">
    <ul style="margin-top: 30px;">
    <li><a href="#">Eesti Keeles</a></li>
    <li><a href="#">По-русски</a></li>
    <li><a href="#">In English</a></li>
    </ul>
</div>-->
<!-- Языки -->
</div>
</div>
<!-- Header -->


<!-- Навигационная панель -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo "?ln=".$ln;?>"><?php echo $terms['main']; ?><span class="sr-only">(current)</span></a>
      </li>
      <!--<li class="nav-item">
        <a class="nav-link" href="?page=products">Товары</a>
      </li>-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $terms['products']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php
        foreach($categories as $categoryKey => $categoryValue){
		       echo '<a class="dropdown-item" href="?ln='.$ln.'&category='.$categoryKey.'">'.$categoryValue['name'].'</a>';
        }
            echo '<div class="dropdown-divider"></div>';
            echo '<a class="dropdown-item" href="?ln='.$ln.'&page=products">'.$terms['categoryAllLaptops'].'</a>';
        ?>
          <!--<a class="dropdown-item" href="#">Something else here</a>-->
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo "?ln=".$ln."&page=about";?>"><?php echo $terms['aboutUs']; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo "?ln=".$ln."&page=contacts";?>"><?php echo $terms['contacts']; ?></a>
      </li>
    </ul>
    <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                    echo $terms['dropdownLanguages']." (".$terms['selectedLanguage'].")";
                    if($_GET['ln']=='et'){
                        echo " <img src='flags/Estonia.png' style='width: 40px;' >";
                    }else if($_GET['ln']=='en'){
                        echo " <img src='flags/United-States.png' style='width: 40px;' >";
                    }else if($_GET['ln']=='ru'){
                        echo " <img src='flags/Russia.png' style='width: 40px;' >";
                    }
                ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <?php
			/*------------ Вывод списка языков --------------*/
			foreach($completeLang as $langKey => $langValue){//$languages
				$newGet='';
				foreach ($_GET as $getKey => $getValue) {
					if($getKey=='ln'){
						$getValue=$langKey;
					}
					$newGet.=$getKey.'='.$getValue.'&';
				}
				if(mb_strpos($newGet, 'ln')===FALSE){$newGet.='ln='.$langKey;}
				if(mb_strrpos($newGet, '&')==mb_strlen($newGet)-1){$newGet=mb_substr($newGet,0,-1);}
				echo '<a class="dropdown-item" href="?'.$newGet.'">'.$langValue;//$langValue[name]
				if($langValue=='Eesti keeles'){
                        echo " <img src='flags/Estonia.png' style='width: 35px;' ></a>";
                    }else if($langValue=='In English'){
                        echo " <img src='flags/United-States.png' style='width: 35px;' ></a>";
                    }else if($langValue=='По-русски'){
                        echo " <img src='flags/Russia.png' style='width: 35px;' ></a>";
                    }else{
                        echo '</a>';
                    }
			}
			?>
            </div>
        </div>
    <form class="form-inline my-2 my-lg-0" action="<?php echo "?ln=".$ln."&search";?>" method="post">
      <input id="search" name="searchProduct" value="<?php if(isset($_POST['searchProduct'])){ echo $_POST['searchProduct'];}?>" class="form-control mr-sm-2" type="search" placeholder="<?php echo $terms['search']; ?>" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><?php echo $terms['search']; ?></button>
    </form>
    <ul class="navbar-nav">
      <li class="nav-item"><!-- ?page=cart -->
        <a class="nav-link btn btn-primary" href="<?php echo "?ln=".$ln."&page=wishlist";?>" style="color: white; margin: 15px;"><i class="fa fa-bookmark fa-2x" style="color: white; margin-right: 5px;"></i><?php echo $terms['wishlist']; ?></a>
      </li>
    </ul>
    <a href="<?php echo "?ln=".$ln."&page=login";?>" style="margin-right: 5px;">
        <button type="button" class="btn btn-outline-success my-2 my-sm-0"><?php echo $terms['login']; ?></button>
    </a>
    <a href="<?php echo "?ln=".$ln."&page=registration";?>">
        <button type="button" class="btn btn-outline-primary my-2 my-sm-0"><?php echo $terms['registration']; ?></button>
    </a>
  </div>
</nav>

<!-- Начало main -->
<div class="main">
  <?php include "mainSwitcher.php" ?>
</div>

<!-- Footer -->
<!-- Переход по страницам -->
<div class="footer">
<div class="row text-center justify-content-center">
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 footerLinks">
        <ul style="list-style-type:none;">
        <div class="dropdown-divider"></div>
          <li><a href="<?php echo "?ln=".$ln;?>" title=""><?php echo $terms['mainFooter']; ?></a></li>
          <li><a href="<?php echo "?ln=".$ln."&page=products";?>" title=""><?php echo $terms['productsFooter']; ?></a></li>
          <li><a href="<?php echo "?ln=".$ln."&page=about";?>" title=""><?php echo $terms['aboutUsFooter']; ?></a></li>
          <li><a href="<?php echo "?ln=".$ln."&page=contacts";?>" title=""><?php echo $terms['contactsFooter']; ?></a></li>
          <li><a href="<?php echo "?ln=".$ln."&page=developer";?>" title=""><?php echo $terms['aboutDeveloperFooter']; ?></a></li>
           <div class="dropdown-divider"></div>
        </ul>
      </div>
</div>
<!-- Социальные сети -->
<!-- col-xl-2 col-lg-4 col-md-4 col-sm-12 -->
<div class="row text-center justify-content-center socialize">
  <div class="col-4 col-xl-3" style="margin-top: 50px;">
      <ul style="list-style-type:none;">
			<li><a href="http://facebook.com" target="_blank" title=""><i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook</a></li>
	  </ul>
  </div>
  <div class="col-4 col-xl-3" style="margin-top: 50px;">
      <ul style="list-style-type:none;">
			<li><a href="http://twitter.com" target="_blank" title=""><i class="fa fa-twitter-square" aria-hidden="true"></i> Twitter</a></li>
	  </ul>
  </div>
  <div class="col-4 col-xl-3" style="margin-top: 50px;">
      <ul style="list-style-type:none;">
			<li><a href="https://instagram.com" target="_blank" title=""><i class="fa fa-instagram" aria-hidden="true"></i> Instagram</a></li>
	  </ul>
  </div>
</div>

  <div class="row justify-content-center">
      <a href="?page=developer"><div class="col-12 h5" style="margin-top: 80px;">&copy; Copyright 2018 Martin Sidorov</div></a>
  </div>

</div>
<script>
var map = new GMaps({
      el: '#map',
      lat: -12.043333,
      lng: -77.028333
    });
      </script>
<script>
      var map = new GMaps({
      el: '#contactsMap',
      lat: -12.043333,
      lng: -77.028333
    });
</script>

<!--<script src="js/jquery-2.2.3.min.js"></script>-->
<!-- Bootstrap 4 -->
<script language="javascript" src="js/jquery-3.2.1.slim.min.js"></script>
<script language="javascript" src="js/popper.min.js"></script>
<script language="javascript" src="js/bootstrap.min.js"></script>
<!-- Bootstrap 4 -->
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/smoothproducts.min.js"></script>
<script type="text/javascript">
    /* wait for images to load */
    $(window).load( function() {
        $('.sp-wrap').smoothproducts();
    });
</script>
</body>
</html>
