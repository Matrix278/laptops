<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
</head>
<?php
function encryptIT($textToEncrypt){
  return md5($textToEncrypt);
}
  if(isset($_POST['txtToEnc'])){
    $pass = encryptIT($_POST['txtToEnc']);
  }
?>
<body>
  <form method="post" action="">
    Text to encrypt<br>
    <input type="text" name="txtToEnc" /><br>
    <input type="submit" value="go" />
    <h6><?php if(isset($pass)){ echo 'encoded:<br>'.$pass;} ?></h6>
  </form>
</body>
</html>
