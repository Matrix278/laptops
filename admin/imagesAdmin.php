<?php
include '../PHPImageResize/lib/ImageResizeException.php';
include '../PHPImageResize/lib/ImageResize.php';

if(isset($_POST['newImageCode'])){
    $testRes=true;
    $msgName='';
    $newCode=$_POST['newImageCode'];
    $newOrder=$_POST['newImageListOrder'];

  if(isset($_FILES['newImagePhoto']['name'])){
      $tmpName=$_FILES['newImagePhoto']['tmp_name'];
      $fileSize=$_FILES['newImagePhoto']['size'];
      if($fileSize< 1024*1024*8){ //принимаем только картинки 3 мб
        if(is_uploaded_file($tmpName)){ //Проверка загрузился ли весь файл полностью на сервер
          $newPhoto='image_'.date('Ymdhis');
          $tail=substr($_FILES['newImagePhoto']['name'],strrpos($_FILES['newImagePhoto']['name'],'.'));
          //$newMove="img/normalImages/$newPhoto$tail";
        $image = new \Gumlet\ImageResize($tmpName);
        $image->resize(1920, 1080, $allow_enlarge = True);
        $image->save('../img/bigImages/big'.$newPhoto.$tail);
        $bigImage='img/bigImages/big'.$newPhoto.$tail;

        $image = new \Gumlet\ImageResize($tmpName);
        $image->resize(640, 480, $allow_enlarge = True);
        $image->save('../img/mediumImages/medium'.$newPhoto.$tail);
        $mediumImage='img/mediumImages/medium'.$newPhoto.$tail;

        $image = new \Gumlet\ImageResize($tmpName);
        $image->resize(320, 240, $allow_enlarge = True);
        $image->save('../img/smallImages/small'.$newPhoto.$tail);
        $smallImage='img/smallImages/small'.$newPhoto.$tail;

        $res=mysqli_query($link, "INSERT INTO vn_images VALUES(NULL, '$bigImage', '$mediumImage', '$smallImage', '$newCode', '$newOrder')");

        echo '<p class="msggoodNews">Запись добавлена!</p>';
        }
      $tmpName='';
    }
  }

  if(empty($newOrder)){
    $testRes=false;
    $msgName.='<p>Отсутствует порядковый номер изображения</p>';
  }
  if(empty($newCode)){
    $testRes=false;
    $msgName.='<p>Отсутствует код товара изображения</p>';
  }

  //2. Проверка Уникаьлности комбинации "название+код+языка"
  //if(testIt($newTitle, 'title', 'vn_moduls') && testIt($newCode, 'menuCode', 'vn_moduls') && testIt($newLang, 'langCode', 'vn_moduls')){
  //если все тру значит нельзя добавлять

  //5. Проверка ограничения максимального количетсва символов в текстах

	if($testRes){
		if(mb_strlen($newCode)>255){
			$testRes=false;
			$msgName.='<p>Слишком длинный код товара</p>';
		}
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
  $itemCodeToDelete=$_POST['imageCodeToDelete'];
  $res=mysqli_query($link, "DELETE FROM vn_images WHERE listOrder='$itemToDelete' AND code='$itemCodeToDelete' ");
  if($res===true){echo '<div class="msggoodNews">Изображение удалено</div>';}else{echo '<div class="msgbadNews">Ошибка удаления</div>';}
}

if(isset($_POST['codeToUp'])){
    $itemToUp=$_POST['codeToUp']; //listOrder Number
    //$res=mysqli_query($link, "SELECT listOrder FROM vn_languages WHERE listOrder<$itemToUp ORDER BY listOrder DESC LIMIT 1");
    $resUpdate=mysqli_query($link, "UPDATE vn_images SET listOrder='' WHERE listOrder<$itemToUp ORDER BY listOrder DESC LIMIT 1");
    if($resUpdate){ echo '<div class="msggoodNews">Изображение перемещено наверх</div>';}else{ echo '<div class="msgbadNews">Ошибка перемещения</div>';}
}

if(isset($_POST['codeToDown'])){
    $itemToDown=$_POST['codeToDown'];
    $res=mysqli_query($link, "SELECT listOrder FROM vn_images WHERE listOrder>$itemToDown ORDER BY listOrder DESC LIMIT 1");
    //mysqli_query($link, "UPDATE vn_languages SET listOrder=''");
    if($res===true){ echo '<div class="msggoodNews">Изображение перемещено вниз</div>';}else{ echo '<div class="msgbadNews">Ошибка перемещения</div>';}
}

if(isset($_POST['editImageCode'])){
    $editImageOrder=$_POST['editImageListOrder'];
    $editImageCode=$_POST['editImageCode'];

    $codeToEdit=$_SESSION['editCode'];
    $imageCodeToEdit=$_SESSION['imageCodeToEdit'];
    $smallImageToEdit=$_SESSION['smallImageToEdit'];

    mysqli_query($link, "UPDATE vn_images SET code='$editImageCode', listOrder='$editImageOrder' WHERE listOrder='$codeToEdit' AND code='$imageCodeToEdit' AND smallImage='$smallImageToEdit' ");

    if(isset($_FILES['editImagePhoto']['name'])){
        $tmpNameEdit=$_FILES['editImagePhoto']['tmp_name'];
        $fileSizeEdit=$_FILES['editImagePhoto']['size'];
        if($fileSizeEdit< 1024*1024*8){ //принимаем только картинки 3 мб
          if(is_uploaded_file($tmpNameEdit)){ //Проверка загрузился ли весь файл полностью на сервер
            $newPhoto='image_'.date('Ymdhis');
            $tail=substr($_FILES['editImagePhoto']['name'],strrpos($_FILES['editImagePhoto']['name'],'.'));
            //$newMove="img/normalImages/$newPhoto$tail";
          $imageBig = new \Gumlet\ImageResize($tmpNameEdit);
          $imageBig->resize(1920, 1080, $allow_enlarge = True);
          $imageBig->save('../img/bigImages/big'.$newPhoto.$tail);
          $editBigImage='img/bigImages/big'.$newPhoto.$tail;

          $imageMedium = new \Gumlet\ImageResize($tmpNameEdit);
          $imageMedium->resize(640, 480, $allow_enlarge = True);
          $imageMedium->save('../img/mediumImages/medium'.$newPhoto.$tail);
          $editMediumImage='img/mediumImages/medium'.$newPhoto.$tail;

          $imageSmall = new \Gumlet\ImageResize($tmpNameEdit);
          $imageSmall->resize(320, 240, $allow_enlarge = True);
          $imageSmall->save('../img/smallImages/small'.$newPhoto.$tail);
          $editSmallImage='img/smallImages/small'.$newPhoto.$tail;

          $res=mysqli_query($link, "UPDATE vn_images SET bigImage='$editBigImage', mediumImage='$editMediumImage', smallImage='$editSmallImage', code='$editImageCode', listOrder='$editImageOrder' WHERE listOrder='$codeToEdit' AND code='$imageCodeToEdit' ");
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
<h2>Страница управления изображениями товаров сайта</h2>
<table class="table table-striped table-responsive">
    <tr>
      <th scope="col">N</th>
      <th scope="col">Изображение товара</th>
      <th scope="col">Код товара</th>
      <th scope="col" colspan="4">Действия</th>
    </tr>
<?php
$imagesTable=mysqli_query($link,"SELECT * FROM vn_images ORDER BY code");
while($oneImage=mysqli_fetch_assoc($imagesTable)){
  echo '<tr><td>'.$oneImage['listOrder'].'</td>
  <td scope="row"><img src="../'.$oneImage['smallImage'].'" height="200" width="300" alt=""></td>
  <td>'.$oneImage['code'].'</td>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToEdit" value="'.$oneImage['listOrder'].'" />
  <input type="hidden" name="imageCodeToEdit" value="'.$oneImage['code'].'" />
  <input type="hidden" name="smallImageToEdit" value="'.$oneImage['smallImage'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-pencil-square-o" style="color: green; cursor: pointer;" aria-hidden="true"></i>
  </td>
  </form>
  <td>
  <form action="" method="post">';
  //if($oneImage['listOrder']!=1){
  echo '<input type="hidden" name="codeToUp" value="'.$oneImage['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-up" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>';
    //}
  echo '</form>
  <td>
  <form action="" method="post">';
  // $imagesListOrderCount=mysqli_query($link,"SELECT COUNT(listOrder) AS total FROM vn_images");
  // $countOrder=mysqli_fetch_assoc($imagesListOrderCount);
  // if($oneImage['listOrder']<$countOrder['total']){
  echo '<input type="hidden" name="codeToDown" value="'.$oneImage['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-down" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>';
  //}
  echo '</form>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToDelete" value="'.$oneImage['listOrder'].'" />
  <input type="hidden" name="imageCodeToDelete" value="'.$oneImage['code'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-window-close" style="color: red; cursor: pointer;" aria-hidden="true"></i>
  </form>
  </td>
  <td>
  </tr>';
}
echo '<a class="btn btn-primary" href="" role="button">Вернуться на добавление изображения</a>';
?>
</table>
</div>
<?php if(isset($_POST['codeToEdit'])):
$_SESSION['editCode']=$_POST['codeToEdit'];
$_SESSION['imageCodeToEdit']=$_POST['imageCodeToEdit'];
$_SESSION['smallImageToEdit']=$_POST['smallImageToEdit'];
?>
<div class="col-6">
<h2>Редактирование изображения</h2>
<form method="post" action="" enctype="multipart/form-data"/>
<!--// id image listOrder //-->
<table>
<tr>
  <td align="right">Код товара:</td>
  <td><input class="form-control" type="text" value="<?php echo $_POST['imageCodeToEdit'];?>" name="editImageCode" /></td>
</tr>
<tr>
  <td align="right">Порядковый номер:</td>
  <td><input class="form-control" type="number" value="<?php echo $_POST['codeToEdit'];?>" name="editImageListOrder" /></td>
</tr>
<tr>
  <td align="right">Изображение товара:</td>
  <td><input class="form-control" type="file" name="editImagePhoto" accept="image/jpeg,image/png,image/gif" /></td>
</tr>
<tr>
<td align="right"></td>
<td><input class="btn btn-primary" type="submit" value="Редактировать"/></td>
</tr>
</table>
</form>
</div>
<?php else: ?>
<div class="col-6">
<h2>Добавление изображения</h2>
<form method="post" action="" enctype="multipart/form-data"/>
<!--// id code name listOrder //-->
<table>
<tr>
  <!--<td align="right">Код категории:</td>-->
  <!--<td><input type="text" name="newProductCategoryCode" /></td>-->
  <?php
  $productsTable=mysqli_query($link, "SELECT code FROM vn_products WHERE langCode='".$_GET['ln']."' ");
	echo '<td align="right">Код товара:</td>
		<td>
		<select class="form-control" name="newImageCode">';
	while($oneProduct=mysqli_fetch_assoc($productsTable)){
		 echo '<option value="'.$oneProduct['code'].'">'.$oneProduct['code'].'</option>';
	}
	echo '</select>
		</td>';
	?>
</tr>
<!--<tr>-->
<!--  <td align="right">Код товара:</td>-->
<!--  <td><input class="form-control" type="text" name="newImageCode" /></td>-->
<!--</tr>-->
<tr>
  <td align="right">Порядковый номер:</td>
  <td><input class="form-control" type="number" name="newImageListOrder" /></td>
</tr>
<tr>
    <td align="right">Изображение товара:</td>
    <td><input class="form-control" type="file" name="newImagePhoto" accept="image/jpeg,image/png,image/gif" /></td>
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
