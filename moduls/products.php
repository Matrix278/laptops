<div class="row justify-content-center">
    <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12">
        <div class="card" style="margin-top: 30px;">
            <div class="card-body">
            <h3 class="card-title"><?php echo $terms['developerProducts']; ?></h3>
            <div class="dropdown-divider"></div>
            <p class="card-text form-check">
                <ul style="list-style-type:none;">
                    <form action="" method="post">
                    <li><input style="width: 1.3em; height: 1.3em;" onclick="submit()" name="asusFilter" class="form-check-input" type="checkbox" value="Asus" id="defaultCheck1">
                    <label style="font-size: 23px;  margin-bottom: 10px; margin-left: 5px;" class="form-check-label" for="defaultCheck1">Asus</label></li>
                    </form>
                    <form action="" method="post">
                    <li><input style="width: 1.3em; height: 1.3em;" onclick="submit()" name="acerFilter" class="form-check-input" type="checkbox" value="Acer" id="defaultCheck2">
                    <label style="font-size: 23px;  margin-bottom: 10px; margin-left: 5px;" class="form-check-label" for="defaultCheck2">Acer</label></li>
                    </form>
                    <form action="" method="post">
                    <li><input style="width: 1.3em; height: 1.3em;" onclick="submit()" name="lenovoFilter" class="form-check-input" type="checkbox" value="Lenovo" id="defaultCheck3">
                    <label style="font-size: 23px;  margin-bottom: 10px; margin-left: 5px;" class="form-check-label" for="defaultCheck3">Lenovo</label></li>
                    </form>
                    <form action="" method="post">
                    <li><input style="width: 1.3em; height: 1.3em;" onclick="submit()" name="appleFilter" class="form-check-input" type="checkbox" value="Apple" id="defaultCheck4">
                    <label style="font-size: 23px;  margin-bottom: 10px; margin-left: 5px;" class="form-check-label" for="defaultCheck4">Apple</label></li>
                    </form>
                    <form action="" method="post">
                    <li><input style="width: 1.3em; height: 1.3em;" onclick="submit()" name="dellFilter" class="form-check-input" type="checkbox" value="Dell" id="defaultCheck5">
                    <label style="font-size: 23px;  margin-bottom: 10px; margin-left: 5px;" class="form-check-label" for="defaultCheck5">Dell</label></li>
                    </form>
                    <form action="" method="post">
                    <li><input style="width: 1.3em; height: 1.3em;" onclick="submit()" name="hpFilter" class="form-check-input" type="checkbox" value="HP" id="defaultCheck6">
                    <label style="font-size: 23px;  margin-bottom: 10px; margin-left: 5px;" class="form-check-label" for="defaultCheck6">HP</label></li>
                    </form>
                    <form action="" method="post">
                    <li><input style="width: 1.3em; height: 1.3em;" onclick="submit()" name="msiFilter" class="form-check-input" type="checkbox" value="MSI" id="defaultCheck7">
                    <label style="font-size: 23px;  margin-bottom: 10px; margin-left: 5px;" class="form-check-label" for="defaultCheck7">MSI</label></li>
                    </form>
                    <form action="" method="post">
                    <li><input style="width: 1.3em; height: 1.3em;" onclick="submit()" name="allFilter" class="form-check-input" type="checkbox" value="all" id="defaultCheck8">
                    <label style="font-size: 23px;  margin-bottom: 10px; margin-left: 5px;" class="form-check-label" for="defaultCheck8"><?php echo $terms['categoryAllLaptops']; ?></label></li>
                    </form>
                </ul>
            </p>
            </div>
        </div>
	</div>
  
  <?php
if(!isset($_POST['asusFilter']) || !isset($_POST['acerFilter']) || !isset($_POST['lenovoFilter']) || !isset($_POST['appleFilter']) || !isset($_POST['dellFilter']) || !isset($_POST['hpFilter']) || !isset($_POST['msiFilter']) || !isset($_POST['allFilter'])){
$ln=$_GET['ln'];
$productsTable=mysqli_query($link, "SELECT * FROM vn_products WHERE langCode = '$ln' AND listOrder <= 2"); //для того чтобы в будущем использовать много раз
$products=Array();
while($oneProduct=mysqli_fetch_assoc($productsTable)){
  $products[$oneProduct['code']]=$oneProduct;
  $descriptionExplode=explode('.', $oneProduct['description']);
  echo '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">';
  echo '<div class="card" style="margin-top: 30px; margin-bottom: 20px;">
      <a href="'."?ln=".$ln."&page=productInfo&id=".$oneProduct['code']."".'" class="card-link">';
    $productCodeForImage=$oneProduct['code'];
    $imageProductsTable=mysqli_query($link, "SELECT * FROM vn_images WHERE code='$productCodeForImage' AND listOrder='1' ");
    while($oneImage=mysqli_fetch_assoc($imageProductsTable)){
    echo '<img class="card-img-top" src="'.$oneImage['mediumImage'].'" alt="'.$oneProduct['name'].'">';
    }
    echo '<div class="card-body">
        <form action="'."?ln=".$ln."&page=wishlist".'" method="post">
        <input type="hidden" name="code" value="'.$oneProduct['code'].'" />
      <h5 class="card-title">'.$oneProduct['name'].'</a>
      <input type="hidden" name="name" value="'.$oneProduct['name'].'" /></h5>
      <p class="card-text">
          <ul>';
          foreach($descriptionExplode as $descKey =>$descValue) {

            echo '<li>'.$descValue.'</li>';

            }
            // <li>'.$descriptionExplode[0].'</li>
            // <li>'.$descriptionExplode[1].'</li>
            // <li>'.$descriptionExplode[2].'</li>
            // <li>'.$descriptionExplode[3].'</li>
            // <li>'.$descriptionExplode[4].'</li>
            // <li>'.$descriptionExplode[5].'</li>
            // <li>'.$descriptionExplode[6].'</li>
            // <li>'.$descriptionExplode[7].'</li>
            // <li>'.$descriptionExplode[8].'</li>
            // <li>'.$descriptionExplode[9].'</li>
          echo '</ul>
      </p>
      <span class="badge badge-dark" style="font-size: 30px; margin: 10px;">'.$oneProduct['price'].'€<input type="hidden" name="price" value="'.$oneProduct['price'].'€"/></span>
      <p>
          '.$terms['quantity'].': <input type="number" name="quantity" min="1" max="10" value="1" style="width: 15%;" />
      </p>
      <!--<a href="?page=wishlist" class="btn btn-primary">Добавить в желаемые</a>-->
      <input type="submit" name="submit" class="btn btn-primary" value="'.$terms['addWishlist'].'" />
      </form>
    </div>';
  echo '</div>';
  echo '</div>';
}
echo '</div>';
}
?>

<?php
// if(!isset($_POST['asusFilter']) || !isset($_POST['acerFilter']) || !isset($_POST['lenovoFilter']) || !isset($_POST['appleFilter']) || !isset($_POST['dellFilter']) || !isset($_POST['hpFilter']) || !isset($_POST['msiFilter'])){
// $ln=$_GET['ln'];
// $productsTable=mysqli_query($link, "SELECT * FROM vn_products WHERE langCode = '$ln' AND listOrder >= 3"); //для того чтобы в будущем использовать много раз
// $products=Array();
// echo '<div class="row justify-content-center" style="margin-left: 50px; margin-right: 50px;">';
// while($oneProduct=mysqli_fetch_assoc($productsTable)){
//   $products[$oneProduct['code']]=$oneProduct;
//   $descrtiptionExplode=explode('.', $oneProduct['description']);
//   echo '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">';
//   echo '<div class="card" style="margin-top: 30px; margin-bottom: 20px;">
//       <a href="'."?ln=".$ln."&page=productInfo&id=".$oneProduct['code']."".'" class="card-link">';
//       $productCodeForImage=$oneProduct['code'];
//       $imageProductsTable=mysqli_query($link, "SELECT * FROM vn_images WHERE code='$productCodeForImage' LIMIT 1 "); 
//      while($oneImage=mysqli_fetch_assoc($imageProductsTable)){
//     echo '<img class="card-img-top" src="'.$oneImage['mediumImage'].'" alt="'.$oneProduct['name'].'">';
//     }
//     echo '<div class="card-body">
//         <form action="'."?ln=".$ln."&page=wishlist".'" method="post">
//         <input type="hidden" name="code" value="'.$oneProduct['code'].'" />
//       <h5 class="card-title">'.$oneProduct['name'].'</a>
//       <input type="hidden" name="name" value="'.$oneProduct['name'].'" /></h5>
//       <p class="card-text">
//           <ul>
//             <li>'.$descrtiptionExplode[0].'</li>
//             <li>'.$descrtiptionExplode[1].'</li>
//             <li>'.$descrtiptionExplode[2].'</li>
//             <li>'.$descrtiptionExplode[3].'</li>
//             <li>'.$descrtiptionExplode[4].'</li>
//             <li>'.$descrtiptionExplode[5].'</li>
//             <li>'.$descrtiptionExplode[6].'</li>
//             <li>'.$descrtiptionExplode[7].'</li>
//             <li>'.$descrtiptionExplode[8].'</li>
//             <li>'.$descrtiptionExplode[9].'</li>
//           </ul>
//       </p>
//       <span class="badge badge-dark" style="font-size: 30px; margin: 10px;">'.$oneProduct['price'].'€<input type="hidden" name="price" value="'.$oneProduct['price'].'€"/></span>
//       <p>
//           '.$terms['quantity'].': <input type="number" name="quantity" min="1" max="10" value="1" style="width: 15%;" />
//       </p>
//       <!--<a href="?page=wishlist" class="btn btn-primary">Добавить в желаемые</a>-->
//       <input type="submit" name="submit" class="btn btn-primary" value="'.$terms['addWishlist'].'" />
//       </form>
//     </div>';
//   echo '</div>';
//   echo '</div>';
// }
// echo '</div>';
// }
?>


<!-- Filters -->
<?php
if(isset($_POST['asusFilter']) || isset($_POST['acerFilter']) || isset($_POST['lenovoFilter']) || isset($_POST['appleFilter']) || isset($_POST['dellFilter']) || isset($_POST['hpFilter']) || isset($_POST['msiFilter']) || !isset($_POST['allFilter'])){
if(isset($_POST['asusFilter'])){$filterProduct=$_POST['asusFilter'];}
if(isset($_POST['acerFilter'])){$filterProduct=$_POST['acerFilter'];}
if(isset($_POST['lenovoFilter'])){$filterProduct=$_POST['lenovoFilter'];}
if(isset($_POST['appleFilter'])){$filterProduct=$_POST['appleFilter'];}
if(isset($_POST['dellFilter'])){$filterProduct=$_POST['dellFilter'];}
if(isset($_POST['hpFilter'])){$filterProduct=$_POST['hpFilter'];}
if(isset($_POST['msiFilter'])){$filterProduct=$_POST['msiFilter'];}
if(isset($_POST['allFilter'])){$filterProduct=$_POST['allFilter'];}
$ln=$_GET['ln'];
if(isset($filterProduct)){
$productsTable=mysqli_query($link, "SELECT * FROM vn_products WHERE langCode = '$ln' AND name LIKE '%$filterProduct%'"); //для того чтобы в будущем использовать много раз
$products=Array();
echo '<div class="row justify-content-center" style="margin-left: 50px; margin-right: 50px;">';
while($oneProduct=mysqli_fetch_assoc($productsTable)){
  $products[$oneProduct['code']]=$oneProduct;
  $descriptionExplode=explode('.', $oneProduct['description']);
  echo '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">';
  echo '<div class="card" style="margin-top: 30px; margin-bottom: 20px;">
      <a href="'."?ln=".$ln."&page=productInfo&id=".$oneProduct['code']."".'" class="card-link">';
    $productCodeForImage=$oneProduct['code'];
      $imageProductsTable=mysqli_query($link, "SELECT * FROM vn_images WHERE code='$productCodeForImage' LIMIT 1 "); 
     while($oneImage=mysqli_fetch_assoc($imageProductsTable)){
    echo '<img class="card-img-top" src="'.$oneImage['mediumImage'].'" alt="'.$oneProduct['name'].'">';
    }
    echo '<div class="card-body">
        <form action="'."?ln=".$ln."&page=wishlist".'" method="post">
        <input type="hidden" name="code" value="'.$oneProduct['code'].'" />
      <h5 class="card-title">'.$oneProduct['name'].'</a>
      <input type="hidden" name="name" value="'.$oneProduct['name'].'" /></h5>
      <p class="card-text">
          <ul>';
          foreach($descriptionExplode as $descKey =>$descValue) {

            echo '<li>'.$descValue.'</li>';

            }
            // <li>'.$descriptionExplode[0].'</li>
            // <li>'.$descriptionExplode[1].'</li>
            // <li>'.$descriptionExplode[2].'</li>
            // <li>'.$descriptionExplode[3].'</li>
            // <li>'.$descriptionExplode[4].'</li>
            // <li>'.$descriptionExplode[5].'</li>
            // <li>'.$descriptionExplode[6].'</li>
            // <li>'.$descriptionExplode[7].'</li>
            // <li>'.$descriptionExplode[8].'</li>
            // <li>'.$descriptionExplode[9].'</li>
          echo '</ul>
      </p>
      <span class="badge badge-dark" style="font-size: 30px; margin: 10px;">'.$oneProduct['price'].'€<input type="hidden" name="price" value="'.$oneProduct['price'].'€"/></span>
      <p>
          '.$terms['quantity'].': <input type="number" name="quantity" min="1" max="10" value="1" style="width: 15%;" />
      </p>
      <!--<a href="?page=wishlist" class="btn btn-primary">Добавить в желаемые</a>-->
      <input type="submit" name="submit" class="btn btn-primary" value="'.$terms['addWishlist'].'" />
      </form>
    </div>';
  echo '</div>';
  echo '</div>';
}
echo '</div>';
}else{
    $ln=$_GET['ln'];
$productsTable=mysqli_query($link, "SELECT * FROM vn_products WHERE langCode = '$ln' AND listOrder >= 3"); //для того чтобы в будущем использовать много раз
$products=Array();
echo '<div class="row justify-content-center" style="margin-left: 50px; margin-right: 50px;">';
while($oneProduct=mysqli_fetch_assoc($productsTable)){
  $products[$oneProduct['code']]=$oneProduct;
  $descriptionExplode=explode('.', $oneProduct['description']);
  echo '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">';
  echo '<div class="card" style="margin-top: 30px; margin-bottom: 20px;">
      <a href="'."?ln=".$ln."&page=productInfo&id=".$oneProduct['code']."".'" class="card-link">';
      $productCodeForImage=$oneProduct['code'];
      $imageProductsTable=mysqli_query($link, "SELECT * FROM vn_images WHERE code='$productCodeForImage' LIMIT 1 "); 
     while($oneImage=mysqli_fetch_assoc($imageProductsTable)){
    echo '<img class="card-img-top" src="'.$oneImage['mediumImage'].'" alt="'.$oneProduct['name'].'">';
    }
    echo '<div class="card-body">
        <form action="'."?ln=".$ln."&page=wishlist".'" method="post">
        <input type="hidden" name="code" value="'.$oneProduct['code'].'" />
      <h5 class="card-title">'.$oneProduct['name'].'</a>
      <input type="hidden" name="name" value="'.$oneProduct['name'].'" /></h5>
      <p class="card-text">
          <ul>';
          foreach($descriptionExplode as $descKey =>$descValue) {

            echo '<li>'.$descValue.'</li>';

            }
            // <li>'.$descriptionExplode[0].'</li>
            // <li>'.$descriptionExplode[1].'</li>
            // <li>'.$descriptionExplode[2].'</li>
            // <li>'.$descriptionExplode[3].'</li>
            // <li>'.$descriptionExplode[4].'</li>
            // <li>'.$descriptionExplode[5].'</li>
            // <li>'.$descriptionExplode[6].'</li>
            // <li>'.$descriptionExplode[7].'</li>
            // <li>'.$descriptionExplode[8].'</li>
            // <li>'.$descriptionExplode[9].'</li>
          echo '</ul>
      </p>
      <span class="badge badge-dark" style="font-size: 30px; margin: 10px;">'.$oneProduct['price'].'€<input type="hidden" name="price" value="'.$oneProduct['price'].'€"/></span>
      <p>
          '.$terms['quantity'].': <input type="number" name="quantity" min="1" max="10" value="1" style="width: 15%;" />
      </p>
      <!--<a href="?page=wishlist" class="btn btn-primary">Добавить в желаемые</a>-->
      <input type="submit" name="submit" class="btn btn-primary" value="'.$terms['addWishlist'].'" />
      </form>
    </div>';
  echo '</div>';
  echo '</div>';
}
echo '</div>';
}
}else{
    
    $ln=$_GET['ln'];
$productsTable=mysqli_query($link, "SELECT * FROM vn_products WHERE langCode = '$ln' AND listOrder >= 3"); //для того чтобы в будущем использовать много раз
$products=Array();
echo '<div class="row justify-content-center" style="margin-left: 50px; margin-right: 50px;">';
while($oneProduct=mysqli_fetch_assoc($productsTable)){
  $products[$oneProduct['code']]=$oneProduct;
  $descriptionExplode=explode('.', $oneProduct['description']);
  echo '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">';
  echo '<div class="card" style="margin-top: 30px; margin-bottom: 20px;">
      <a href="'."?ln=".$ln."&page=productInfo&id=".$oneProduct['code']."".'" class="card-link">';
      $productCodeForImage=$oneProduct['code'];
      $imageProductsTable=mysqli_query($link, "SELECT * FROM vn_images WHERE code='$productCodeForImage' LIMIT 1 "); 
     while($oneImage=mysqli_fetch_assoc($imageProductsTable)){
    echo '<img class="card-img-top" src="'.$oneImage['mediumImage'].'" alt="'.$oneProduct['name'].'">';
    }
    echo '<div class="card-body">
        <form action="'."?ln=".$ln."&page=wishlist".'" method="post">
        <input type="hidden" name="code" value="'.$oneProduct['code'].'" />
      <h5 class="card-title">'.$oneProduct['name'].'</a>
      <input type="hidden" name="name" value="'.$oneProduct['name'].'" /></h5>
      <p class="card-text">
          <ul>';
          foreach($descriptionExplode as $descKey =>$descValue) {

            echo '<li>'.$descValue.'</li>';

            }
            // <li>'.$descriptionExplode[0].'</li>
            // <li>'.$descriptionExplode[1].'</li>
            // <li>'.$descriptionExplode[2].'</li>
            // <li>'.$descriptionExplode[3].'</li>
            // <li>'.$descriptionExplode[4].'</li>
            // <li>'.$descriptionExplode[5].'</li>
            // <li>'.$descriptionExplode[6].'</li>
            // <li>'.$descriptionExplode[7].'</li>
            // <li>'.$descriptionExplode[8].'</li>
            // <li>'.$descriptionExplode[9].'</li>
          echo '</ul>
      </p>
      <span class="badge badge-dark" style="font-size: 30px; margin: 10px;">'.$oneProduct['price'].'€<input type="hidden" name="price" value="'.$oneProduct['price'].'€"/></span>
      <p>
          '.$terms['quantity'].': <input type="number" name="quantity" min="1" max="10" value="1" style="width: 15%;" />
      </p>
      <!--<a href="?page=wishlist" class="btn btn-primary">Добавить в желаемые</a>-->
      <input type="submit" name="submit" class="btn btn-primary" value="'.$terms['addWishlist'].'" />
      </form>
    </div>';
  echo '</div>';
  echo '</div>';
}
echo '</div>';
}
?>
