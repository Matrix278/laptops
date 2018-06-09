<?php
$productId=$_SESSION['productID']=$_GET['id'];
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.12';
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<style>
.sp-wrap {
    max-width: 100%;
}
/*.sp-wrap img{*/
/*    width: 100%;*/
/*}*/
.sp-thumbs a:link{
    width: 150px;
    height: 110px;
    float: left;
}
</style>
<!--col-xl-5 col-lg-5 col-md-5 col-sm-10-->

<?php
$ln=$_GET['ln'];
$productsTable=mysqli_query($link, "SELECT * FROM vn_products WHERE langCode = '$ln' AND code='$productId'"); //для того чтобы в будущем использовать много раз
$products=Array();
echo '<div class="row justify-content-center">';
while($oneProduct=mysqli_fetch_assoc($productsTable)){
  $products[$oneProduct['code']]=$oneProduct;
//   $products[$oneProduct['categoryCode']]=$categoryName[''];
  $descriptionExplode=explode('.', $oneProduct['description']);
  echo '<div class="col-xl-5 col-lg-5 col-md-5 col-sm-10" style="margin-top: 30px; margin-bottom: 30px;">
        <div class="card">
          <div class="sp-loading"><img src="img/xloading.gif" alt=""><br>LOADING IMAGES</div>
            <div class="sp-wrap">';
            $productCodeForImage=$oneProduct['code'];
	        $imageProductsTable=mysqli_query($link, "SELECT * FROM vn_images WHERE code='$productCodeForImage' ORDER BY listOrder"); 
            while($oneImage=mysqli_fetch_assoc($imageProductsTable)){
	        echo '<a href="'.$oneImage['bigImage'].'"><img class="whImg" src="'.$oneImage['mediumImage'].'" alt=""></a>';
            }
            echo '</div>
        </div>
    </div>';
  echo '<div class="col-xl-5 col-lg-5 col-md-5 col-sm-10" style="background:white; margin-top: 30px; margin-bottom: 30px; padding-left: 50px; padding-right: 50px; padding-top: 20px;">';
  echo '<form action="?ln='.$ln.'&page=wishlist" method="post">
        <input type="hidden" name="code" value="'.$oneProduct['code'].'" />
        <h2>'.$oneProduct['name'].'</h2>
        <input type="hidden" name="name" value="'.$oneProduct['name'].'" />
        <p class="card-text">
            <ul>';
            foreach($descriptionExplode as $descKey =>$descValue) {
            if($descKey==0 || $descKey==1 || $descKey==2 || $descKey==3 || $descKey==4 || $descKey==8){
                
            }else{
                echo '<li>'.$descValue.'</li>';
            }
            }
                // <li>'.$descriptionExplode[5].'</li>
                // <li>'.$descriptionExplode[6].'</li>
                // <li>'.$descriptionExplode[7].'</li>
                // <li>'.$descriptionExplode[9].'</li>
            echo '</ul>
          </p>
          <span class="badge badge-dark" style="font-size: 30px; margin: 10px;">'.$oneProduct['price'].'€<input type="hidden" name="price" value="'.$oneProduct['price'].'€"/></span>
          <p>
        '.$terms['quantity'].': <input type="number" name="quantity" min="1" max="10" value="1" style="width: 15%;" />
        </p>
        <input type="submit" name="submit" class="btn btn-primary" value="'.$terms['addWishlist'].'" />
        </form>
    </div>';
}
echo '</div>';
// <a href="?ln='.$ln.'&page=order"><button type="button" class="btn btn-primary w-70" style="margin-bottom: 10px; margin-top: 10px;">'.$terms['orderProduct'].'</button></a>
?>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10" style="background:white;">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo $terms['productCharacteristic']; ?></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><?php echo $terms['productScreen']; ?></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><?php echo $terms['productVideokart']; ?></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="links-tab" data-toggle="tab" href="#links" role="tab" aria-controls="links" aria-selected="false"><?php echo $terms['productOS']; ?></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <table>
                <?php
                $productsTable=mysqli_query($link, "SELECT * FROM vn_products WHERE langCode = '$ln' AND code='$productId'"); //для того чтобы в будущем использовать много раз
                $products=Array();
                while($oneProduct=mysqli_fetch_assoc($productsTable)){
                    $products[$oneProduct['code']]=$oneProduct;
                ?>
                <tr style="background-color:#efefef">
                    <td><?php echo $terms['developerProducts']; ?></td>
                    <td><?php $nameProduct=explode(' ', $oneProduct['name']);
                    echo $nameProduct[0];?></td>
                </tr>
                <tr>
                    <td><?php echo $terms['productType']; ?></td>
                    <!-- $categoryName[$oneProduct['categoryCode']] -->
                    <?php echo "<td>".$categoryName[$oneProduct['categoryCode']]."</td>";?>
                </tr>
                <tr style="background-color:#efefef">
                    <td><?php echo $terms['productWeight']; ?></td>
                    <td><?php
                    $weightProduct=explode(':', $descriptionExplode[0]);
                    echo $weightProduct[1]; ?></td>
                </tr>
            </table>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <table>
                <tr style="background-color:#efefef">
                    <td><?php echo $terms['productScreenSize']; ?></td>
                    <td><?php
                    $displayProduct=explode(':', $descriptionExplode[1]);
                    echo $displayProduct[1]; ?></td>
                </tr>
                <tr>
                    <td><?php echo $terms['productResolution']; ?></td>
                    <td><?php
                    $resolutionProduct=explode(':', $descriptionExplode[2]);
                    echo $resolutionProduct[1]; ?></td>
                </tr>
            </table>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <table>
                <tr style="background-color:#efefef">
                    <td><?php echo $terms['productTypeVideoCard']; ?></td>
                    <td><?php
                    $videoCardTypeProduct=explode(' ', $descriptionExplode[8]);
                    if($_GET['ln']=='et' || $_GET['ln']=='ru'){echo $videoCardTypeProduct[1];}else{ echo $videoCardTypeProduct[2];} ?></td>
                </tr>
                <tr>
                    <td><?php echo $terms['productVideoCard']; ?></td>
                    <td><?php
                    $videoCardProduct=explode(':', $descriptionExplode[8]);
                    echo $videoCardProduct[1]; ?></td>
                </tr>
            </table>
        </div>
        <div class="tab-pane fade" id="links" role="tabpanel" aria-labelledby="links-tab">
            <table>
                <tr style="background-color:#efefef">
                    <td><?php echo $terms['productOSInfo']; ?></td>
                    <td><?php
                    $OSProduct=explode(':', $descriptionExplode[3]);
                    $windowsProduct=explode(' ', $OSProduct[1]);
                    echo $windowsProduct[1]; ?></td>
                </tr>
                <tr>
                    <td><?php echo $terms['productOSVersionInfo']; ?></td>
                    <td><?php if(empty($windowsProduct[2])){echo $windowsProduct[1];}else{ echo $windowsProduct[2];}?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        </div>
    </div>
</div>
<!-- Google Map, Facebook -->
<div class="row justify-content-center">
    <div class="col-xl-4 col-lg-5 col-md-5 col-sm-9" style="margin-top: 30px; margin-bottom: 30px;">
        <div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
    </div>
    <div class="col-xl-4 col-lg-5 col-md-5 col-sm-9" id="map" style="margin-top: 30px; margin-bottom: 30px;"></div>
</div>