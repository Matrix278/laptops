<?php
if(isset($_GET['verify'])){
$verify=$_GET['verify'];

$accountsTable = mysqli_query($link, "SELECT * FROM vn_unregisteredUsers ORDER BY id");
while ($oneAccount = mysqli_fetch_assoc($accountsTable)) {
$tableCode =md5($oneAccount['email']).$oneAccount['password'].md5($oneAccount['dateTime']);//.md5($oneAccount['dateTime'])
//echo $oneAccount['dateTime'];
$accountMd5=md5($tableCode);
if($accountMd5 == $verify){
  $Email = $oneAccount['email'];
  $Pass = $oneAccount['password'];
  $DateTime = $oneAccount['dateTime'];
  $Lang = $oneAccount['language'];
  mysqli_query($link, "INSERT INTO vn_registeredUsers VALUES(NULL, '$Email', '$Pass', '$DateTime', '$Lang')");
  mysqli_query($link, "DELETE FROM vn_unregisteredUsers WHERE Email='$Email'");

}else{
    echo 'Подтверждение не удалось';
}
}
echo '<div class="card">';
echo '<div class="alert alert-success" role="alert">'.$terms['registerThanks'].'</div>
      <h1>'.$terms['registerSuccessful'].'</h1>
      <a class="btn btn-primary w-35" href="?ln='.$ln.'&page=login" role="button">'.$terms['loginToCabinet'].'</a>';
  $message = "
  Thank you for joining us!

  Your account is registered.";
  
  $accountsTable = mysqli_query($link, "SELECT * FROM vn_registeredUsers ORDER BY id");
    while ($oneAccount = mysqli_fetch_assoc($accountsTable)) {
    $tableCode =md5($oneAccount['email']).$oneAccount['password'].md5($oneAccount['dateTime']);//.md5($oneAccount['dateTime'])
    //echo $oneAccount['dateTime'];
    $accountMd5=md5($tableCode);
    if($accountMd5 == $verify){
        $email = $oneAccount['email'];
        $mailThanks=mail($email, 'Thank you for registration', $message, "From:martin@laptops.ee");
        if($mailThanks===FALSE){
            echo 'Письмо благодарности не было отправлено';
        }
    }
}
echo '</div>';
}
?>