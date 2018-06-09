<?php
include '../PHPImageResize/lib/ImageResizeException.php';
include '../PHPImageResize/lib/ImageResize.php';

if(isset($_POST['newProductName'])){
  //валидация данных и добавление в таблицу
  $testRes=true;
  $msgName='';
  //проверки:
  //1. Проверка обязательного наличия названия, кода, порядкового номера и кода языка
	$newName=$_POST['newProductName'];
	$newCode=$_POST['newProductCode'];
	$newPrice=$_POST['newProductPrice'];
	$newOrder=$_POST['newProductOrder'];
	$newCategoryCode=$_POST['newProductCategoryCode'];

  // if(!empty($_FILES['newProductPictures']['name'])){
  //   //проверка файла и загрузка на сервер
  //   if($_FILES['newProductPhoto']['size']< 1024*1024*8){ //принимаем только картинки 3 мб
  //     if(is_uploaded_file($_FILES['newProductPhoto']['tmp_name'])){ //Проверка загрузился ли весь файл полностью на сервер
  //       $newPhoto="$newCode".date('Ymdhis');
  //       $tail=substr($_FILES['newProductPhoto']['name'],strrpos($_FILES['newProductPhoto']['name'],'.'));
  //       $newMove="img/$newPhoto$tail";
  //       move_uploaded_file($_FILES['newProductPhoto']['tmp_name'],"../img/".$newPhoto.$tail);
  //     }
  //   }
  // }
  if(isset($_FILES['newProductPictures']['name'])){
    $count = 0;
    foreach ($_FILES['newProductPictures']['name'] as $fileName)
    {
      $tmpName=$_FILES['newProductPictures']['tmp_name'][$count];
      $fileSize=$_FILES['newProductPictures']['size'][$count];
      if($fileSize< 1024*1024*8){ //принимаем только картинки 3 мб
        if(is_uploaded_file($tmpName)){ //Проверка загрузился ли весь файл полностью на сервер
          $newPhoto='image'.$count.'_'.date('Ymdhis');
          $tail=substr($_FILES['newProductPictures']['name'][$count],strrpos($_FILES['newProductPictures']['name'][$count],'.'));
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
        if($count==0){
          $sqlImages=mysqli_query($link, "INSERT INTO vn_images VALUES(NULL, '$bigImage', '$mediumImage', '$smallImage', '$newCode', '1')");
        }else{
          $sqlImages=mysqli_query($link, "INSERT INTO vn_images VALUES(NULL, '$bigImage', '$mediumImage', '$smallImage', '$newCode', '$count++')");
        }
        $count++;
        //   if(move_uploaded_file($tmpName,"../img/normalImages/".$newPhoto.$tail)){
        //     $count++;
        //   }
        }
      }
      $tmpName='';
    }
  }

		if(empty($newName)){
			$testRes=false;
			$msgName.='<p>Отсутствует название товара</p>';
		}

		if(empty($newCode)){
			$testRes=false;
			$msgName.='<p>Отсутствует код товара</p>';
		}

		if(empty($newPrice)){
			$testRes=false;
			$msgName.='<p>Отсутствует цена товара</p>';
		}

		if(empty($newCategoryCode)){
			$testRes=false;
			$msgName.='<p>Отсутствует код категории товара</p>';
		}
  //2. Проверка Уникаьлности комбинации "название+код+языка"
  //if(testIt($newTitle, 'title', 'vn_moduls') && testIt($newCode, 'menuCode', 'vn_moduls') && testIt($newLang, 'langCode', 'vn_moduls')){
  //если все тру значит нельзя добавлять
	if($testRes){
		$test=mysqli_query($link, "SELECT COUNT (id) AS Q FROM vn_products WHERE code='$newCode' AND name='$newName' ");
		if($testRes['Q']>0){
			$testRes=false;
			$msgName.='<p>Такая запись существует</p>';
		}
	}

	if($testRes){
	    foreach ($_POST as $postKey => $postValue) {
            if(strpos($postKey, "name_")!==false){
            $langCode=substr($postKey, -2);
            $res=mysqli_query($link, "INSERT INTO vn_products VALUES(NULL, '$newCode', '$newName', '$postValue', '$newPrice', '$newCategoryCode', '$langCode', '$newOrder')");
            }
        }
        echo '<p class="msggoodNews">Запись добавлена!</p>';
	}

  //5. Проверка ограничения максимального количетсва символов в текстах
	if($testRes){
		if(mb_strlen($newName)>255){
			$testRes=false;
			$msgName.='<p>Слишком длинное название товара</p>';
		}
	}

	if($testRes){
		if(mb_strlen($newCode)>255){
			$testRes=false;
			$msgName.='<p>Слишком длинный код товара</p>';
		}
	}

  //6. Проверка на разрешенные/запрещенные символы
  if($testRes){
  $allowedSymbols="ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯ0123456789-";
  for($i=0; $i<mb_strlen($newName); $i++){
	if(mb_strpos($allowedSymbols, mb_substr($newName,$i,1))===FALSE){
		$testRes=false;
	}
  }
  }

  if($testRes){
  $allowedSymbols="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-";
  for($i=0; $i<mb_strlen($newCode); $i++){
	if(mb_strpos($allowedSymbols, mb_substr($newCode,$i,1))===FALSE){
		$testRes=false;
	}
  }
  }

  //7. Порядковый номер уникален в пределах одного языка
  if($testRes){
	$test=mysqli_query($link, "SELECT COUNT (id) AS Q FROM vn_products WHERE langCode='$langCode' AND listOrder='$newOrder' ");
	$test2=mysqli_fetch_assoc($test);
	if($test2['Q']>0){
		$next=mysqli_query($link, "SELECT MAX(orderNum) AS N FROM vn_products WHERE langCode='$langCode'");
		$nextRes=mysqli_fetch_assoc($next);
		$nextNum=(int)$nextRes['N']+1; //если занят номер, то берём максималый номер +1
		$newOrder=$newNum;
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
  $imageCodeToDelete=$_POST['imageCodeToDelete'];
  $langCodeToDelete=$_POST['langCodeToDelete'];
  $res=mysqli_query($link, "DELETE FROM vn_products WHERE listOrder='$itemToDelete' AND langCode='$langCodeToDelete' ");
  if($res===true){
      //$images=mysqli_query($link, "DELETE FROM vn_images WHERE code='$imageCodeToDelete' ");
      echo '<div class="msggoodNews">Товар удален</div>';
      
  }else{
      echo '<div class="msgbadNews">Ошибка удаления</div>';
  }
}

if(isset($_POST['codeToUp'])){
    $itemToUp=$_POST['codeToUp'];
    $res=mysqli_query($link, "SELECT listOrder FROM vn_products WHERE listOrder<$itemToUp ORDER BY listOrder DESC LIMIT 1");
    //mysqli_query($link, "UPDATE vn_languages SET listOrder=''");
    if($res===true){ echo '<div class="msggoodNews">Товар перемещен наверх</div>';}else{ echo '<div class="msgbadNews">Ошибка перемещения</div>';}
}

if(isset($_POST['editProductCode'])){
    $editProductCode=$_POST['editProductCode'];
    $editProductName=$_POST['editProductName'];
    $editProductPrice=$_POST['editProductPrice'];
    $editProductCategoryCode=$_POST['editProductCategoryCode'];
    $editProductOrder=$_POST['editProductOrder'];

    // $editProductRu=$_POST['editname_ru'];
    // $editProductEt=$_POST['editname_et'];
    // $editProductEn=$_POST['editname_en'];

    $codeToEdit=$_SESSION['editCode'];
    $codeToEdit2=$_SESSION['editCode2'];

  // if(isset($_FILES['editProductPictures']['name'])){
  //   $count = 0;
  //   foreach ($_FILES['editProductPictures']['name'] as $fileName)
  //   {
  //     $tmpName=$_FILES['editProductPictures']['tmp_name'][$count];
  //     $fileSize=$_FILES['editProductPictures']['size'][$count];
  //     if($fileSize< 1024*1024*8){ //принимаем только картинки 3 мб
  //       if(is_uploaded_file($tmpName)){ //Проверка загрузился ли весь файл полностью на сервер
  //         $newPhoto='image'.$count.'_'.date('Ymdhis');
  //         $tail=substr($_FILES['editProductPictures']['name'][$count],strrpos($_FILES['editProductPictures']['name'][$count],'.'));
  //         //$newMove="img/normalImages/$newPhoto$tail";
  //       $image = new \Gumlet\ImageResize($tmpName);
  //       $image->resize(1920, 1080, $allow_enlarge = True);
  //       $image->save('../img/bigImages/big'.$newPhoto.$tail);
  //       $bigImage='img/bigImages/big'.$newPhoto.$tail;
  //
  //       $image = new \Gumlet\ImageResize($tmpName);
  //       $image->resize(640, 480, $allow_enlarge = True);
  //       $image->save('../img/mediumImages/medium'.$newPhoto.$tail);
  //       $mediumImage='img/mediumImages/medium'.$newPhoto.$tail;
  //
  //       $image = new \Gumlet\ImageResize($tmpName);
  //       $image->resize(320, 240, $allow_enlarge = True);
  //       $image->save('../img/smallImages/small'.$newPhoto.$tail);
  //       $smallImage='img/smallImages/small'.$newPhoto.$tail;
  //       // $sqlImagesDelete=mysqli_query($link, "DELETE FROM vn_images WHERE code='$codeToEdit2' ");
  //       // $sqlNewImages=mysqli_query($link, "INSERT INTO vn_images VALUES(NULL, '$bigImage', '$mediumImage', '$smallImage', '$editProductCode')");
  //       //$countSubs=mysqli_query($link, "SELECT COUNT(type) FROM vn_images WHERE code='$editProductCode' AND type='sub' ");
  //       if($count==0){
  //         $sqlUpdate=mysqli_query($link, "UPDATE vn_images SET bigImage='$bigImage', mediumImage='$mediumImage', smallImage='$smallImage' WHERE code='$editProductCode' AND type='main' ");
  //       }else{ //if($count==$countSubs)
  //         $imagesAlready=mysqli_query($link, "SELECT type FROM vn_images WHERE code='$editProductCode' AND type='sub' ");
  //         if($imagesAlready){
  //           mysqli_query($link, "UPDATE vn_images SET bigImage='$bigImage', mediumImage='$mediumImage', smallImage='$smallImage' WHERE type='sub' AND code='$editProductCode' ");
  //         }else{
  //           mysqli_query($link, "INSERT INTO vn_images VALUES(NULL, '$bigImage', '$mediumImage', '$smallImage', '$editProductCode', 'sub')");
  //         }
  //       }
  //       $count++;
  //         // }else{
  //         //   $sql=mysqli_query($link, "INSERT INTO vn_images VALUES(NULL, '$bigImage', '$mediumImage', '$smallImage', '$editProductCode', 'sub')");
  //         // }
  //       //   if(move_uploaded_file($tmpName,"../img/normalImages/".$newPhoto.$tail)){
  //       //     $count++;
  //       //   }
  //       }
  //     }
  //     $tmpName='';
  //   }
  // }

    foreach ($_POST as $postKey => $postValue) {
            if(strpos($postKey, "editname_")!==false){
            $langCode=substr($postKey, -2);
            $sql=mysqli_query($link, "UPDATE vn_products SET code='$editProductCode', name='$editProductName', description='$postValue', price='$editProductPrice', categoryCode='$editProductCategoryCode', langCode='$langCode', listOrder='$editProductOrder' WHERE listOrder='$codeToEdit' AND langCode='$langCode' ");
            if($sql){
                echo '<div class="msggoodNews">Редактирование успешно</div>';
            }else{
                echo '<div class="msgbadNews">Ошибка записи</div>';
            }
            }
    }
    // $sqlRu=mysqli_query($link, "UPDATE vn_products SET code='$editProductCode', name='$editProductName', description='$editProductRu', price='$editProductPrice', categoryCode='$editProductCategoryCode', listOrder='$editProductOrder' WHERE listOrder='$codeToEdit'  AND langCode='ru' ");

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
<div class="col-8">
<h2>Страница управления товарами</h2>
<?php
echo '<a style="margin: 5px;" class="btn btn-primary" href="" role="button">Вернуться на добавление товаров</a><br/><br/>';
$langTable=mysqli_query($link, "SELECT * FROM vn_languages");
while($oneLanguages=mysqli_fetch_assoc($langTable)){
  echo '<a style="margin: 5px;" href="?ln='.$oneLanguages['code'].'"><button class="btn btn-primary" >'.$oneLanguages['name'].'</button></a>';
 }
?>
<table class="table table-striped table-responsive">
    <tr>
        <th scope="col">N</th>
        <th scope="col">Код товара</th>
        <th scope="col">Название товара</th>
        <th scope="col">Описание товара</th>
        <th scope="col">Цена товара</th>
        <th scope="col">Изображение товара</th>
        <th scope="col">Код категории товара</th>
        <th scope="col">Язык товара</th>
        <th scope="col" colspan="4">Действия</th>
    </tr>
<?php
$productsTable=mysqli_query($link,"SELECT * FROM vn_products WHERE langCode='".$_GET['ln']."' ORDER BY listOrder");
while($oneProducts=mysqli_fetch_assoc($productsTable)){
  echo '<tr><td>'.$oneProducts['listOrder'].'</td>
  <td scope="row">'.$oneProducts['code'].'</td>
  <td>'.$oneProducts['name'].'</td>
  <td>'.$oneProducts['description'].'</td>
  <td>'.$oneProducts['price'].'€'.'</td>';
  $productCodeForImage=$oneProducts['code'];
    $imageProductsTable=mysqli_query($link, "SELECT * FROM vn_images WHERE code='$productCodeForImage' LIMIT 1");
     while($oneImage=mysqli_fetch_assoc($imageProductsTable)){
         //$rest = substr("abcdef", -3, -1); // возвращает "de"
        //  if($oneImage['bigImage']==substr($oneImage['bigImage'], -52, -20)){
    echo '<td><img src="../'.$oneImage['smallImage'].'" alt=""></td>';
  }
  echo '<td>'.$oneProducts['categoryCode'].'</td>
  <td>'.$oneProducts['langCode'].'</td>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToEdit" value="'.$oneProducts['listOrder'].'" />
  <input type="hidden" name="codeToEdit2" value="'.$oneProducts['code'].'" />
  <input type="hidden" name="codeToEdit3" value="'.$oneProducts['name'].'" />
  <input type="hidden" name="codeToEdit4" value="'.$oneProducts['price'].'" />
  <input type="hidden" name="codeToEdit5" value="'.$oneProducts['description'].'" />
  <input type="hidden" name="editPostValueCategoryCode" value="'.$oneProducts['categoryCode'].'" />
  <input type="hidden" name="editPostValueLangCode" value="'.$oneProducts['langCode'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-pencil-square-o" style="color: green; cursor: pointer;" aria-hidden="true"></i>
  </td>
  </form>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToUp" value="'.$oneProducts['id'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-up" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>
  </form>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToDown" value="'.$oneProducts['id'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-down" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>
  </form>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToDelete" value="'.$oneProducts['listOrder'].'" />
  <input type="hidden" name="imageCodeToDelete" value="'.$oneProducts['code'].'" />
  <input type="hidden" name="langCodeToDelete" value="'.$oneProducts['langCode'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-window-close" style="color: red; cursor: pointer;" aria-hidden="true"></i>
  </form>
  </td></tr>';
}
?>
</table>
</div>
<?php if(isset($_POST['codeToEdit'])):
$_SESSION['editCode']=$_POST['codeToEdit'];
$_SESSION['editCode2']=$_POST['codeToEdit2'];
$_SESSION['editCode3']=$_POST['codeToEdit3'];
$_SESSION['editCode4']=$_POST['codeToEdit4'];
$_SESSION['editCode5']=$_POST['codeToEdit5'];
$_SESSION['editPostValueLangCode']=$_POST['editPostValueLangCode'];
$_SESSION['editPostValueCategoryCode']=$_POST['editPostValueCategoryCode'];?>
<div class="col-4">
<h2>Редактирование товара</h2>
<form method="post" action="" enctype="multipart/form-data"/>
<!--// id code text langCode //-->
<table>
<tr>
  <td align="right">Код товара:</td>
  <td><input class="form-control" type="text" value="<?php
    $categoriesTable=mysqli_query($link,"SELECT * FROM vn_products WHERE code='".$_POST['codeToEdit2']."' LIMIT 1");
    while($oneCategories=mysqli_fetch_assoc($categoriesTable)){
        echo $oneCategories['code'];
    }
    ?>" name="editProductCode" /></td>
</tr>
<tr>
  <td align="right">Название товара:</td>
  <td><input class="form-control" type="text" value="<?php
    $categoriesTable=mysqli_query($link,"SELECT * FROM vn_products WHERE name='".$_POST['codeToEdit3']."' LIMIT 1");
    while($oneCategories=mysqli_fetch_assoc($categoriesTable)){
        echo $oneCategories['name'];
    }
    ?>" name="editProductName" /></td>
</tr>
<tr>
  <td align="right">Цена товара:</td>
  <td><input class="form-control" type="number" value="<?php
    $categoriesTable=mysqli_query($link,"SELECT * FROM vn_products WHERE price='".$_POST['codeToEdit4']."' AND name='".$_POST['codeToEdit3']."' LIMIT 1");
    while($oneCategories=mysqli_fetch_assoc($categoriesTable)){
        echo $oneCategories['price'];
    }
    ?>" name="editProductPrice" /></td>
</tr>
<tr>
  <!--<td align="right">Код категории:</td>-->
  <!--<td><input type="text" name="newProductCategoryCode" /></td>-->
  <?php
  $categoryTable=mysqli_query($link, "SELECT code FROM vn_category WHERE langCode='ru' ");
	$categories=Array();
	echo '<td align="right">Код категории:</td>
		<td>
		<select class="form-control" name="editProductCategoryCode">';
	while($oneCategory=mysqli_fetch_assoc($categoryTable)){
		$categories[$oneCategory['code']]=$oneCategory;
		if($oneCategory[code]==$_POST['editPostValueCategoryCode']){
		    echo '<option value="'.$oneCategory['code'].'" selected>'.$oneCategory['code'].'</option>';
		}else{
		    echo '<option value="'.$oneCategory['code'].'">'.$oneCategory['code'].'</option>';
		}
	}
	echo '</select>
		</td>';
	?>
</tr>
<tr>
    <td align="right">Порядковый номер товара:</td>
    <td><input class="form-control" type="number" value="<?php
    $productsTable=mysqli_query($link,"SELECT * FROM vn_products WHERE listOrder='".$_POST['codeToEdit']."' AND name='".$_POST['codeToEdit3']."' LIMIT 1");
    while($oneProduct=mysqli_fetch_assoc($productsTable)){
        echo $oneProduct['listOrder'];
    }
    ?>" name="editProductOrder" /></td>
</tr>
<?php
    $langTable=mysqli_query($link, "SELECT code FROM vn_languages WHERE code='".$_POST['editPostValueLangCode']."' ");
    while ($oneLanguage=mysqli_fetch_assoc($langTable)) {
      echo '<tr><td align="right">Описание товара ('.$oneLanguage['code'].')</td><td><textarea class="form-control" rows="11" cols="45" name="editname_'.$oneLanguage['code'].'" >';
      $productsTable=mysqli_query($link, "SELECT langCode, listOrder, description FROM vn_products WHERE langCode='".$_POST['editPostValueLangCode']."' AND listOrder='".$_POST['codeToEdit']."' ");
      while($oneProduct=mysqli_fetch_assoc($productsTable)){
          echo $oneProduct['description'];
      }
      echo '</textarea></td></tr>';
    }
?>
<!-- <tr>
    <td align="right">Фотография товара:</td>
    <td id="tableInputFiles">
        <input class="form-control" type="file" name="editProductPictures[]" multiple accept="image/jpeg,image/png,image/gif" />
    </td>
</tr>
<tr>
    <td align="right"></td>
    <td><input class="btn btn-success" type="button" id="buttonAddInputs" value="Добавить еще фотографию"/></td>
</tr> -->
<tr>
    <td align="right"></td>
    <td><input class="btn btn-primary" type="submit" value="Редактировать"/></td>
</tr>
</table>
</form>
</div>
<?php else: ?>
<div class="col-4">
<h2>Добавление товара</h2>
<form method="post" action="" enctype="multipart/form-data"/>
<!--// id code text langCode //-->
<table>
<tr>
  <td align="right">Код товара:</td>
  <td><input class="form-control" type="text" name="newProductCode" /></td>
</tr>
<tr>
  <td align="right">Название товара:</td>
  <td><input class="form-control" type="text" name="newProductName" /></td>
</tr>
<tr>
  <td align="right">Цена товара:</td>
  <td><input class="form-control" type="number" name="newProductPrice" /></td>
</tr>
<tr>
  <!--<td align="right">Код категории:</td>-->
  <!--<td><input type="text" name="newProductCategoryCode" /></td>-->
  <?php
  $categoryTable=mysqli_query($link, "SELECT code FROM vn_category WHERE langCode='ru' ");
	$categories=Array();
	echo '<td align="right">Код категории:</td>
		<td>
		<select class="form-control" name="newProductCategoryCode">';
	while($oneCategory=mysqli_fetch_assoc($categoryTable)){
		$categories[$oneCategory['code']]=$oneCategory;
		if($oneCategory['code']!=allLaptops){
		    echo '<option>'.$oneCategory['code'].'</option>';
		}
	}
	echo '</select>
		</td>';
	?>
</tr>
<tr>
    <td align="right">Порядковый номер товара:</td>
    <td><input class="form-control" type="number" name="newProductOrder" /></td>
</tr>

<!--    $langTable=mysqli_query($link, 'SELECT code FROM vn_languages ORDER BY listOrder');-->
<!--    while ($oneLanguage=mysqli_fetch_assoc($langTable)) {-->
<!--      echo '<tr><td align="right">Описание товара ('.$oneLanguage['code'].')</td><td><textarea class="form-control" rows="11" cols="45" name="name_'.$oneLanguage['code'].'"';-->
<!--      echo 'placeholder="';-->
<!--      if($oneLanguage['code']=='et'){-->
<!--echo 'Kaal (kg): 1,35.-->
<!--Ekraan: 11,6.-->
<!--Resolutsioon: 1366 x 768.-->
<!--Operatsioonisüsteem: Windows 10.-->
<!--Protsessor: Intel Pentium.-->
<!--Operatiivmälu: 2 GB.-->
<!--Kõvaketas (HDD): Ei.-->
<!--Kõvaketas (SSD): 32 GB.-->
<!--Videokaart: Intel HD Graphics 500.-->
<!--Klaviatuur: ENG';-->
<!--}else if($oneLanguage['code']=='ru'){-->
<!--echo 'Вес (кг): 1,35.-->
<!--Экран: 11,6.-->
<!--Разрешение: 1366 x 768.-->
<!--Тип ОС: Windows 10.-->
<!--Процессор: Intel Pentium.-->
<!--Оперативная память: 2 GB.-->
<!--Жесткий диск (HDD): Нет.-->
<!--Жесткий диск (SSD): 32 GB.-->
<!--Видеокарта: Intel HD Graphics 500.-->
<!--Раскладка клавиатуры: ENG';-->
<!--}else{-->
<!--echo 'Weight (kg): 1,35.-->
<!--Display: 11,6.-->
<!--Resolution: 1366 x 768.-->
<!--Operating System: Windows 10.-->
<!--Processor: Intel Pentium.-->
<!--Operational memory: 2 GB.-->
<!--Hard disk drive (HDD): No.-->
<!--Hard disk drive (SSD): 32 GB.-->
<!--Video card: Intel HD Graphics 500.-->
<!--Keyboard: ENG';}-->
<!--echo '"></textarea></td></tr>';-->
<!--    }-->

<tr>
    <td align="right">Описание товара (<?php echo $_GET['ln'];?>)</td>
    <td><textarea class="form-control" rows="11" cols="45" name="name_<?php echo $_GET['ln']; ?>"></textarea></td>
</tr>
<tr>
    <td align="right">Изображения товара:</td>
    <td id="tableInputFiles">
        <input class="form-control" type="file" name="newProductPictures[]" multiple accept="image/jpeg,image/png,image/gif" />
    </td>
</tr>
<tr>
    <td align="right"></td>
    <td><input class="btn btn-success" type="button" id="buttonAddInputs" value="Добавить еще фотографию"/></td>
</tr>
<tr>
    <td align="right"></td>
    <td><input class="btn btn-primary" type="submit" value="Добавить"/></td>
</tr>
</table>
</form>
</div>
<?php endif; ?>
</div>
<script>
table=document.querySelector("#tableInputFiles")
document.querySelector("#buttonAddInputs").onclick=function(){
  var el=document.createElement("tr")
  el.innerHTML='<td><input class="form-control" type="file" name="newProductPictures[]" multiple accept="image/jpeg,image/png,image/gif" /></td>'
  table.appendChild(el)
}
</script>
