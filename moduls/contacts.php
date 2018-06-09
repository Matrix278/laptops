<div class="row justify-content-center">
    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-10" id="contactsMap" style="margin-top: 30px; margin-bottom: 30px;"></div>
<?php
$ln=$_GET['ln'];
$contactTable=mysqli_query($link, "SELECT * FROM vn_contacts WHERE langCode = '$ln' ORDER BY listOrder"); //для того чтобы в будущем использовать много раз
$contact=Array();
while($oneContact=mysqli_fetch_assoc($contactTable)){
  $contact[$oneContact['title']]=$oneContact;
echo '<div class="col-xl-4 col-lg-5 col-md-6 col-sm-10 card border border-secondary" style="margin-left: 20px; margin-top: 30px; margin-bottom: 30px;">
    <div class="card-body">
        <h4 class="card-title"><i class="fa '.$oneContact['icon'].'" aria-hidden="true"></i> '.$oneContact['title'].'</h4>
        <hr class="my-4">
        <p class="card-text">
            <h5 class="card-title">'.$oneContact['adress'].':</h5>
            <p class="card-text">'.$oneContact['adressText'].'</p>
            
            <h5 class="card-title text-right">'.$oneContact['email'].':</h5>
            <p class="card-text text-right">'.$oneContact['emailText'].'</p>
            
            <h5 class="card-title">'.$oneContact['telephone'].':</h5>
            <p class="card-text">+(372) '.$oneContact['telephoneText'].'</p>
        </p>
    </div>
    </div>';
}
?>
</div>