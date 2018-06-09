<?php
require 'dbconnect.php';

if(isset($_POST['userEmail']) && isset($_POST['userPass1']) && isset($_POST['userPass2'])){
$email=$_POST['userEmail'];
$pass1=$_POST['userPass1'];
$pass2=$_POST['userPass2'];
$dateTime=date("Y-m-d H:i:s");
$_SESSION['userEmail']=$email;
$_SESSION['userPass1']=$pass1;
$_SESSION['userPass2']=$pass2;
$_SESSION['userdateTime']=$dateTime;

$testRes=true;
}
if($pass1!==$pass2){
  echo "Введенные пароли не совпадают"."<br/>";
  $testRes=false;
}

if(empty($pass1)){
  echo "Пароль не был введен"."<br/>";
  $testRes=false;
}

if(empty($pass2)){
  echo "Повторный пароль не был введен"."<br/>";
  $testRes=false;
}

$query = mysqli_query($link, "SELECT * FROM vn_unregisteredUsers WHERE email = '". $email ."'");

if (mysqli_num_rows($query) > 0)
{
    echo '<div class="container card" style="padding: 30px;">
    <h1>'.$terms['emailAlreadyReg'].'</h1>
    </div>';
    $testRes=false;
}
//Пожалуйста пройдите по ссылке ниже, чтобы подтвердить ваш аккаунт.
if($testRes){
  $emailMd5=md5($email);
  $passMd5=md5($pass1);
  $dateMd5=md5($dateTime);
  $allMd5=$emailMd5.$passMd5.$dateMd5;
  $verifyMd5=md5($allMd5);
  $message = "
    You need to confirm your account.
    
    Your account is ready:
    
    Your Email: $email
    Your Password: $pass1
    
    Click this link to verify this account:
    https://method27.000webhostapp.com/laptops/?page=verify&verify=".$verifyMd5."";
  $langCode=$_GET['ln'];
  $_SESSION['registeredLang']=$langCode;
  $mailResult=mail($email, 'Please confirm your account registration', $message, "From:martin@laptops.ee");
  $res=mysqli_query($link, "INSERT INTO vn_unregisteredUsers VALUES(NULL, '$email', '$passMd5', '$dateTime', '$langCode') ");
  if($mailResult===TRUE && $res){ 
    echo '<div class="container card" style="padding: 30px;">
    <h1>'.$terms['mailPleaseVerify'].'</h1>
    <p>'.$terms['mailLinkFollow'].'</p>
    </div>';
  }else{
    echo '<div class="container card" style="padding: 30px;">
    <h1>E-mail Error</h1>
    </div>';
  }
}

?>
