<?php
session_start();
require "../moduls/validators.php";
if(isset($_POST['btnExit'])){
  if($_POST['btnExit']=='Выход'){
    unset($_SESSION['user']);
  }
}
if(!isset($_SESSION['user']['status'])){
  $_SESSION['user']['status']=0;
}
if(isset($_POST['userMail']) && isset($_POST['userPass'])){
  if(testIt($_POST['userMail'], 'username', 'vn_users')){
    $username=$_POST['userMail'];
    $userpass=md5($_POST['userPass']);
    $_SESSION['user']=mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM vn_users WHERE username='$username' AND password='$userpass' LIMIT 1"));
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Панель управления сайта</title>
<meta charset="utf-8" />
<!-- Bootstrap 4 -->
  <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" />
  <!-- Bootstrap 4 -->
<link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
  <?php if($_SESSION['user']['status'] > 10): ?>
<!--//HTML код части сайта для администраторов -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Панель управления</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <form action="?ln=et" method="post" style="margin-left: 10px; padding: 5px;"><!--class="oneButtonForm"-->
            <input class="nav-link btn btn-dark" type="submit" name="btnMenu" value="Товары" />
        </form>
      </li>
      <li class="nav-item">
        <form action="?ln=et" method="post" style="margin-left: 10px; padding: 5px;">
            <input class="nav-link btn btn-dark" type="submit" name="btnMenu" value="Изображения" />
        </form>
      </li>
      <li class="nav-item">
        <form action="?ln=et" method="post" style="margin-left: 10px; padding: 5px;">
            <input class="nav-link btn btn-dark" type="submit" name="btnMenu" value="Категории" />
        </form>
      </li>
      <li class="nav-item">
        <form action="?ln=et" method="post" style="margin-left: 10px; padding: 5px;">
            <input class="nav-link btn btn-dark" type="submit" name="btnMenu" value="Термины" />
        </form>
      </li>
      <li class="nav-item">
        <form action="?ln=et" method="post" style="margin-left: 10px; padding: 5px;">
            <input class="nav-link btn btn-dark" type="submit" name="btnMenu" value="Языки" />
        </form>
      </li>
      <li class="nav-item">
        <form action="?ln=et" method="post" style="margin-left: 10px; padding: 5px;">
            <input class="nav-link btn btn-dark" type="submit" name="btnMenu" value="Баннеры" />
        </form>
      </li>
      <li class="nav-item">
        <form action="?ln=et" method="post" style="margin-left: 10px; padding: 5px;">
            <input class="nav-link btn btn-dark" type="submit" name="btnMenu" value="Блок (Страница о нас)" />
        </form>
      </li>
      <!--<li class="nav-item">-->
      <!--  <form action="" method="post" style="margin-left: 10px; padding: 5px;">-->
      <!--      <input class="nav-link btn btn-dark" type="submit" name="btnMenu" value="Блок (Страница контактов)" />-->
      <!--  </form>-->
      <!--</li>-->
      
      <!--<li class="nav-item">
        <form action="" method="post" style="margin-left: 10px; padding: 5px;">
            <input class="nav-link btn btn-dark" type="submit" name="btnMenu" value="Модули" />
        </form>
      </li>-->
    </ul>
    <form class="form-inline my-2 my-lg-0" action="" method="post">
        <input class="btn btn-danger" type="submit" name="btnExit" value="Выход" />
    </form>
  </div>
</nav>
<div class="alert alert-info alert-dismissable" role="alert">
    <a class="close" data-dismiss="alert" href="#">X</a>
    Добро пожаловать - Admin!
</div>
<!--<form action="" method="post" class="oneButtonForm">-->
<!--<input type="submit" name="btnMenu" value="Категории" />-->
<!--</form>-->
<!--<form action="" method="post" class="oneButtonForm">-->
<!--<input type="submit" name="btnMenu" value="Термины" />-->
<!--</form>-->
<!--<form action="" method="post" class="oneButtonForm">-->
<!--<input type="submit" name="btnMenu" value="Модули" />-->
<!--</form>-->
<!--<form action="" method="post" class="oneButtonForm">-->
<!--<input type="submit" name="btnMenu" value="Языки" />-->
<!--</form>-->
<!--<form action="" method="post" class="oneButtonForm">-->
<!--<input type="submit" name="btnMenu" value="Города" />-->
<!--</form>-->
<!--<form action="" method="post" class="oneButtonForm">-->
<!--<input type="submit" name="btnExit" value="Выход" style="width: 200px; margin-left: 100px;" />-->
<!--</form>-->
<?php
if(isset($_POST['btnMenu'])){$_SESSION['btnMenu']=$_POST['btnMenu'];}
if(isset($_SESSION['btnMenu'])){
  switch ($_SESSION['btnMenu']) {
    case 'Языки':
      include 'langAdmin.php';
      break;
    case 'Термины':
      include 'termsAdmin.php';
      break;
    case 'Баннеры':
      include 'bannersAdmin.php';
      break;
    case 'Блок (Страница о нас)':
      include 'aboutUsAdmin.php';
      break;
    case 'Изображения':
      include 'imagesAdmin.php';
      break;
    //case 'Модули':
      //include 'modulsAdmin.php';
      //break;
    case 'Товары':
      include 'productsAdmin.php';
      break;
    case 'Категории':
      include 'categoriesAdmin.php';
      break;
    // case 'Блок (Страница контактов)':
    //   include 'contactsAdmin.php';
    //   break;
    
    // case 'Города':
    //   include 'townsAdmin.php';
    //   break;
    default:
      include 'userAdmin.php';
      break;
  }
}
?>
  <?php else: ?>
<!--//HTML код для неадминистраторов -->
<div class="row justify-content-center">
    <h2>Система управления содержимого сайта</h2>
</div>
<div class="row justify-content-center">
<form action="" method="post">
<h6>Username:</h6>
<input type="text" name="userMail" />
<h6>Password:</h6>
<input type="password" name="userPass" />
<br/><br/>
<input class="btn btn-primary" type="submit" value="Войти" />
</form>
</div>
  <?php endif; ?>
  <!-- Bootstrap 4 -->
<script language="javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
<script language="javascript" src="../js/popper.min.js"></script>
<script language="javascript" src="../js/bootstrap.min.js"></script>
<!-- Bootstrap 4 -->
</body>
</html>
