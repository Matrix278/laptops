<?php
include '../PHPImageResize/lib/ImageResizeException.php';
include '../PHPImageResize/lib/ImageResize.php';

if(isset($_POST['newBannerListOrder'])){
    $testRes=true;
    $msgName='';
    $newOrder=$_POST['newBannerListOrder'];

// if(isset($_FILES['newBannerPhoto']['name'])){
//     //проверка файла и загрузка на сервер
//     $fileName=$_FILES['newBannerPhoto']['name'];
//     $tmpName=$_FILES['newBannerPhoto']['tmp_name'];
//     $fileSize=$_FILES['newBannerPhoto']['size'];
//     if($fileSize< 1024*1024*8){ //принимаем только картинки 3 мб
//       if(is_uploaded_file($tmpName)){ //Проверка загрузился ли весь файл полностью на сервер
//         $newPhoto="carouselBackground".date('Ymdhis');
//         $tail=substr($fileName,strrpos($fileName,'.'));
//         $image = new \Gumlet\ImageResize($tmpName);
//         $image->resize(1600, 600, $allow_enlarge = True);
//         $image->save('../img/'.$newPhoto.$tail);
//         $carouselImage='img/'.$newPhoto.$tail;
//         $res=mysqli_query($link, "INSERT INTO vn_banner VALUES (NULL, '$carouselImage', '$newOrder') ");
//         if(!$res){
//             $msgName.='<p>Ошибка добавления !</p>';
//         }
//       }
//     }
//     echo '<p class="msggoodNews">Запись добавлена!</p>';
// }
if(isset($_FILES['newBannerPhoto']['name'])){
    $tmpName=$_FILES['newBannerPhoto']['tmp_name'];
    $fileSize=$_FILES['newBannerPhoto']['size'];
    if($fileSize< 1024*1024*8){ //принимаем только картинки 3 мб
      if(is_uploaded_file($tmpName)){ //Проверка загрузился ли весь файл полностью на сервер
        $newPhoto='carouselBackground'.date('Ymdhis');
        $tail=substr($_FILES['newBannerPhoto']['name'],strrpos($_FILES['newBannerPhoto']['name'],'.'));
        //$newMove="img/normalImages/$newPhoto$tail";
      $image = new \Gumlet\ImageResize($tmpName);
      $image->resize(1600, 600, $allow_enlarge = True);
      $image->save('../img/carouselImages/'.$newPhoto.$tail);
      $carouselImage="img/carouselImages/".$newPhoto.$tail;

      $res=mysqli_query($link, "INSERT INTO vn_banner VALUES (NULL, '$carouselImage', '$newOrder') ");

      echo '<p class="msggoodNews">Запись добавлена!</p>';
      }
    $tmpName='';
  }
}

if(empty($newOrder)){
    $testRes=false;
$msgName.='<p>Отсутствует порядковый номер баннера</p>';
}

  //8. Если не задан порядковый номер, то ставить ноль (или следующий по порядку)
  if($testRes){
  if($newOrder==""){
    $order="0";
	$testRes=false;
  }
  }

  if($testRes){$msgType="goodNews";}else{$msgType="badNews";}

  echo '<div onclick="this.style.display=\'none\'" class="msg'.$msgType.'">'.$msgName.'</div>';
}

if(isset($_POST['codeToDelete'])){
  $itemToDelete=$_POST['codeToDelete'];
  $res=mysqli_query($link, "DELETE FROM vn_banner WHERE listOrder='$itemToDelete' ");
  if($res===true){echo '<div class="msggoodNews">Баннер удален</div>';}else{echo '<div class="msgbadNews">Ошибка удаления</div>';}
}
/*
if(isset($_POST['codeToEdit'])){
    $itemToEdit=$_POST['codeToEdit'];
    $res=mysqli_query($link, "UPDATE vn_languages SET code='', name='' ");
    if($res===true){ echo 'Язык отредактирован';}else{ echo 'Ошибка редактирования';}
}*/

if(isset($_POST['codeToUp'])){
    $itemToUp=$_POST['codeToUp']; //listOrder Number
    //$res=mysqli_query($link, "SELECT listOrder FROM vn_languages WHERE listOrder<$itemToUp ORDER BY listOrder DESC LIMIT 1");
    $resUpdate=mysqli_query($link, "UPDATE vn_banner SET listOrder='' WHERE listOrder<$itemToUp ORDER BY listOrder DESC LIMIT 1");
    if($resUpdate){ echo '<div class="msggoodNews">Баннер перемещен наверх</div>';}else{ echo '<div class="msgbadNews">Ошибка перемещения</div>';}
}

if(isset($_POST['codeToDown'])){
    $itemToDown=$_POST['codeToDown'];
    $res=mysqli_query($link, "SELECT listOrder FROM vn_banner WHERE listOrder>$itemToDown ORDER BY listOrder DESC LIMIT 1");
    //mysqli_query($link, "UPDATE vn_languages SET listOrder=''");
    if($res===true){ echo '<div class="msggoodNews">Баннер перемещен вниз</div>';}else{ echo '<div class="msgbadNews">Ошибка перемещения</div>';}
}


// if(!empty($_FILES['editBannerPhoto']['name'])){
//     //проверка файла и загрузка на сервер
//     if($_FILES['editBannerPhoto']['size']< 1024*1024*8){ //принимаем только картинки 3 мб
//       if(is_uploaded_file($_FILES['editBannerPhoto']['tmp_name'])){ //Проверка загрузился ли весь файл полностью на сервер
//         $newPhoto="carouselBackground".date('Ymdhis');
//         $tail=substr($_FILES['editBannerPhoto']['name'],strrpos($_FILES['editBannerPhoto']['name'],'.'));
//         $newMove="img/$newPhoto$tail";
//         move_uploaded_file($_FILES['editBannerPhoto']['tmp_name'],"../img/".$newPhoto.$tail);
//       }
//     }
//   }
if(isset($_POST['editBannerListOrder'])){
    $editBannerOrder=$_POST['editBannerListOrder'];
    $codeToEdit=$_SESSION['editCode'];

    $bannerPhotoEdit=$_SESSION['bannerPhotoEdit'];
    mysqli_query($link, "UPDATE vn_banner SET listOrder='$editBannerOrder' WHERE listOrder='$codeToEdit' AND image='$bannerPhotoEdit' ");

    if(isset($_FILES['editBannerPhoto']['name'])){
        $tmpNameEdit=$_FILES['editBannerPhoto']['tmp_name'];
        $fileSizeEdit=$_FILES['editBannerPhoto']['size'];
        if($fileSizeEdit< 1024*1024*8){ //принимаем только картинки 3 мб
          if(is_uploaded_file($tmpNameEdit)){ //Проверка загрузился ли весь файл полностью на сервер
            $newPhoto='carouselBackground'.date('Ymdhis');
            $tail=substr($_FILES['editBannerPhoto']['name'],strrpos($_FILES['editBannerPhoto']['name'],'.'));
            //$newMove="img/normalImages/$newPhoto$tail";
          $imageBig = new \Gumlet\ImageResize($tmpNameEdit);
          $imageBig->resize(1600, 600, $allow_enlarge = True);
          $imageBig->save('../img/carouselImages/'.$newPhoto.$tail);
          $carouselImage="img/carouselImages/".$newPhoto.$tail;

          $res=mysqli_query($link, "UPDATE vn_banner SET image='$carouselImage', listOrder='$editBannerOrder' WHERE listOrder='$codeToEdit' ");
          if($res){
            echo '<p class="msggoodNews">Запись редактирована!</p>';
          }else{
            echo '<p class="msgbadNews">Ошибка редактирования!</p>';
          }

          }
        $tmpName='';
      }
    }

}

?>
<head>
    <style>
        td form{ display: inline-block; width: auto;}
        input[value="X"]{ background-color: red; color: white;}
    </style>
</head>
<body>
<div class="row">
<div class="col-6">
<h2>Страница управления баннерами сайта</h2>
<table class="table table-striped table-responsive">
    <tr>
        <th scope="col">N</th>
        <th scope="col">Фотография</th>
        <th scope="col" colspan="4">Действия</th>
    </tr>
<?php
$bannerTable=mysqli_query($link,"SELECT * FROM vn_banner ORDER BY listOrder");
while($oneBanner=mysqli_fetch_assoc($bannerTable)){
  echo '<tr><td>'.$oneBanner['listOrder'].'</td>
  <td scope="row"><img src="../'.$oneBanner['image'].'" height="300" width="500" alt=""></td>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToEdit" value="'.$oneBanner['listOrder'].'" />
  <input type="hidden" name="bannerPhotoEdit" value="'.$oneBanner['image'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-pencil-square-o" style="color: green; cursor: pointer;" aria-hidden="true"></i>
  </td>
  </form>
  <td>
  <form action="" method="post">';
  if($oneBanner['listOrder']!=1){
  echo '<input type="hidden" name="codeToUp" value="'.$oneBanner['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-up" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>';
    }
  echo '</form>
  <td>
  <form action="" method="post">';
  $bannerListOrderCount=mysqli_query($link,"SELECT COUNT(listOrder) AS total FROM vn_banner");
  $countOrder=mysqli_fetch_assoc($bannerListOrderCount);
  if($oneBanner['listOrder']<$countOrder['total']){
  echo '<input type="hidden" name="codeToDown" value="'.$oneBanner['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-down" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>';
  }
  echo '</form>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToDelete" value="'.$oneBanner['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-window-close" style="color: red; cursor: pointer;" aria-hidden="true"></i>
  </form>
  </td>
  <td>
  </tr>';
}
echo '<a class="btn btn-primary" href="" role="button">Вернуться на добавление баннера</a>';
?>
</table>
</div>
<?php if(isset($_POST['codeToEdit'])):
$_SESSION['editCode']=$_POST['codeToEdit'];
$_SESSION['bannerPhotoEdit']=$_POST['bannerPhotoEdit'];?>
<div class="col-6">
<h2>Редактирование баннера</h2>
<form method="post" action="" enctype="multipart/form-data"/>
<!--// id image listOrder //-->
<table>
<tr>
  <td align="right">Изображения баннера:</td>
  <td><input class="form-control" type="file" name="editBannerPhoto" accept="image/jpeg,image/png,image/gif" /></td>
</tr>
<tr>
  <td align="right">Порядковый номер:</td>
  <td><input class="form-control" type="number" value="<?php echo $_POST['codeToEdit'];?>" name="editBannerListOrder" /></td>
</tr>
<td align="right"></td>
<td><input class="btn btn-primary" type="submit" value="Редактировать"/></td>
</tr>
</table>
</form>
</div>
<?php else: ?>
<div class="col-6">
<h2>Добавление баннера</h2>
<form method="post" action="" enctype="multipart/form-data"/>
<!--// id code name listOrder //-->
<table>
<tr>
    <td align="right">Изображения баннера:</td>
    <td><input class="form-control" type="file" name="newBannerPhoto" accept="image/jpeg,image/png,image/gif" /></td>
</tr>
<tr>
  <td align="right">Порядковый номер:</td>
  <td><input class="form-control" type="number" name="newBannerListOrder" /></td>
</tr>
<td align="right"></td>
<td><input class="btn btn-primary" type="submit" value="Добавить"/></td>
</tr>
</table>
</form>
</div>
<?php endif; ?>
</div>
</body>
