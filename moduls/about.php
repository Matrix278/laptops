<?php
$ln=$_GET['ln'];
$aboutUsTable=mysqli_query($link, "SELECT * FROM vn_aboutUs WHERE langCode = '$ln' ORDER BY listOrder"); //для того чтобы в будущем использовать много раз
$abooutUs=Array();
while($oneAboutUs=mysqli_fetch_assoc($aboutUsTable)){
  $abooutUs[$oneAboutUs['title']]=$oneAboutUs;
echo '<div class="row justify-content-center">
<div class="col-8 card" style="margin-top: 30px; margin-bottom: 30px;">
  <div class="card-body">
    <h5 class="card-title">'.$oneAboutUs['title'].'</h5>
    <p class="card-text">'.$oneAboutUs['lead'].'</p>
  </div>
</div>
</div>';
}
?>