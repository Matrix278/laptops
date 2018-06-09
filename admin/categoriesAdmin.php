<?php

if(isset($_POST['newCategoryCode'])){
  //валидация данных и добавление в таблицу
  $testRes=true;
  $msgName='';
  //проверки:
  //1. Проверка обязательного наличия названия, кода, порядкового номера и кода языка
  $newCode=$_POST['newCategoryCode'];
  $newOrder=$_POST['newCategoryOrder'];

		/*if(empty($newName)){
			$testRes=false;
			$msgName.='<p>Отсутствует название категории</p>';
		}*/

		if(empty($newCode)){
			$testRes=false;
			$msgName.='<p>Отсутствует код категории</p>';
		}

		if(empty($newOrder)){
			$testRes=false;
			$msgName.='<p>Отсутствует порядковый номер категории</p>';
		}

		/*if(empty($newLang)){
			$testRes=false;
			$msgName.='<p>Отсутствует код языка категории</p>';
		}*/
  //2. Проверка Уникаьлности комбинации "название+код+языка"
  //if(testIt($newTitle, 'title', 'vn_moduls') && testIt($newCode, 'menuCode', 'vn_moduls') && testIt($newLang, 'langCode', 'vn_moduls')){
  //если все тру значит нельзя добавлять
	if($testRes){
	    $sqlOrder=mysqli_query($link, "SELECT * FROM vn_category WHERE MAX(listOrder)='$newOrder' ");
	    if($sqlOrder){
			$testRes=false;
			$msgName.='<p>Такой порядковый номер уже существует</p>';
	    }
	}
	
// 	if($testRes){
// 		$test=mysqli_query($link, "SELECT COUNT (listOrder) AS Q FROM vn_category WHERE code='$newCode' ");
// 		if($testRes['Q']>0){
// 			$testRes=false;
// 			$msgName.='<p>Такая запись существует</p>';
// 		}
// 	}

	/*if($testRes){
		$res=mysqli_query($link, "INSERT INTO vn_category VALUES (NULL, '$newCode','$newName','$newLang') ");
		$msgName='<p>Запись добавлена !</p>';
	}*/
	if($testRes){
	    foreach ($_POST as $postKey => $postValue) {
            if(strpos($postKey, "name_")!==false){
            $langCode=substr($postKey, -2);
            mysqli_query($link, "INSERT INTO vn_category VALUES(NULL, '$newCode', '$postValue', '$langCode', '$newOrder')");
            }
            
        }
        echo '<p class="msggoodNews">Запись добавлена!</p>';
	}
  //3. Проверка на количество символов для языка
  /*if(mb_strlen($newLang)>2){
    $testRes=false;
	$msgName.='<p>Неправильный код языка </p>';
  }*/

  //4. Проверка присутвствия выбранного языка в базе данных
  /*if($testRes){
		if(!testIt($newLang, 'code','vn_languages')){
			$testRes=false;
			$msgName.='<p>Такой код языка отсутствует</p>';
		}
	}*/

  //5. Проверка ограничения максимального количетсва символов в текстах
	/*if($testRes){
		if(mb_strlen($newName)>255){
			$testRes=false;
			$msgName.='<p>Слишком длинное название категоии</p>';
		}
	}*/

	if($testRes){
		if(mb_strlen($newCode)>255){
			$testRes=false;
			$msgName.='<p>Слишком длинный код категоии</p>';
		}
	}

  //6. Проверка на разрешенные/запрещенные символы
  if($testRes){
  $allowedSymbols="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  for($i=0; $i<mb_strlen($newCode); $i++){
	if(mb_strpos($allowedSymbols, mb_substr($newCode,$i,1))===FALSE){
		$testRes=false;
	}
  }
  }

  //7. Порядковый номер уникален в пределах одного языка
  if($testRes){
	$test=mysqli_query($link, "SELECT COUNT (id) AS Q FROM vn_category WHERE langCode='$langCode' AND listOrder='$newOrder' ");
	$test2=mysqli_fetch_assoc($test);
	if($test2['Q']>0){
		$next=mysqli_query($link, "SELECT MAX(listOrder) AS N FROM vn_category WHERE langCode='$langCode'");
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
  //$sqlProductsCategoryCode=mysqli_query($link, "SELECT category.* FROM vn_category AS category WHERE category.code=(SELECT prod.categoryCode FROM vn_products AS prod WHERE prod.categoryCode=category.code) ");
//  if($sqlProductsCategoryCode===FALSE){

//  $resTest=mysqli_query($link, "SELECT langCode FROM vn_category WHERE langCode IN (SELECT code FROM vn_languages WHERE code=vn_category.langCode)");
//  if($resTest){
//      echo '<div class="msgbadNews">Ошибка удаления категории,  прежде чем удалить категорию удалите товары связаннве с ней</div>';
//  }else{
//      $res=mysqli_query($link, "DELETE FROM vn_category WHERE code='$itemToDelete' ");
//      echo '<div class="msggoodNews">Категория удалена</div>';
//  }

$res=mysqli_query($link, "DELETE FROM vn_category WHERE code='$itemToDelete' AND langCode='".$_GET['ln']."' ");
  if($res===true){
      $resProducts=mysqli_query($link, "DELETE FROM vn_products WHERE categoryCode='$itemToDelete' AND langCode='".$_GET['ln']."' ");
      echo '<div class="msggoodNews">Категория удалена</div>';
      
  }else{
      echo '<div class="msgbadNews">Ошибка удаления</div>';
      
  }

}
//  }else{
//      echo '<div class="msgbadNews">Ошибка удаления категории, товары связаны с категорией, прежде чем удалить категорию, очистите все товары в этой категории</div>';
//  }

if(isset($_POST['editCategoryCode'])){
    $editCategoryCode=$_POST['editCategoryCode'];
    $editCategoryOrder=$_POST['editCategoryOrder'];
    
    // $editCategoryRu=$_POST['editname_ru'];
    // $editCategoryEt=$_POST['editname_et'];
    // $editCategoryEn=$_POST['editname_en'];
    
    $codeToEdit=$_SESSION['editCode'];
    
    foreach ($_POST as $postKey => $postValue) {
            if(strpos($postKey, "editname_")!==false){
            $langCode=substr($postKey, -2);
            $sql=mysqli_query($link, "UPDATE vn_category SET code='$editCategoryCode', name='$postValue', langCode='$langCode', listOrder='$editCategoryOrder' WHERE listOrder='$codeToEdit' AND langCode='$langCode' ");
            if($sql){
                echo '<div class="msggoodNews">Редактирование успешно</div>';
            }else{
                echo '<div class="msgbadNews">Ошибка записи</div>';
            }
            }
    }
    
    // $sqlRu=mysqli_query($link, "UPDATE vn_category SET code='$editCategoryCode', name='$editCategoryRu', listOrder='$editCategoryOrder' WHERE listOrder='$codeToEdit'  AND langCode='ru' ");
}
?>
<div class="row">
<div class="col-6">
<h2>Страница управления категориями</h2>
<?php
echo '<a style="margin: 5px;" class="btn btn-primary" href="" role="button">Вернуться на добавление категорий</a><br/><br/>';
$langTable=mysqli_query($link, "SELECT * FROM vn_languages");
while($oneLanguages=mysqli_fetch_assoc($langTable)){
  echo '<a style="margin: 5px;" href="?ln='.$oneLanguages['code'].'"><button class="btn btn-primary" >'.$oneLanguages['name'].'</button></a>';
 }
?>
<table class="table table-striped table-responsive">
    <tr>
        <th scope="col">N</th>
        <th scope="col">Название категории</th>
        <th scope="col">Код категории</th>
        <th scope="col">Код языка</th>
        <th scope="col" colspan="4">Действия</th>
    </tr>
<?php
$categoriesTable=mysqli_query($link,"SELECT * FROM vn_category WHERE langCode='".$_GET['ln']."' ORDER BY listOrder");
while($oneCategories=mysqli_fetch_assoc($categoriesTable)){
  echo '<tr><td>'.$oneCategories['listOrder'].'</td>
  <td scope="row">'.$oneCategories['name'].'</td>
  <td>'.$oneCategories['code'].'</td>
  <td>'.$oneCategories['langCode'].'</td>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToEdit" value="'.$oneCategories['listOrder'].'" />
  <input type="hidden" name="codeToEdit2" value="'.$oneCategories['code'].'" />
  <input type="hidden" name="editPostValueLangCode" value="'.$oneCategories['langCode'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-pencil-square-o" style="color: green; cursor: pointer;" aria-hidden="true"></i>
  </td>
  </form>
  <td>
  <form action="" method="post">';
  if($oneCategories['listOrder']!=1){
  echo '<input type="hidden" name="codeToUp" value="'.$oneCategories['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-up" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>';
  }
  echo '</form>
  <td>
  <form action="" method="post">';
  $categoryListOrderCount=mysqli_query($link,"SELECT COUNT(listOrder) AS total FROM vn_category");
  $countOrder=mysqli_fetch_assoc($categoryListOrderCount);
  if($oneCategories['listOrder']<$countOrder['total']){
  echo '<input type="hidden" name="codeToDown" value="'.$oneCategories['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-down" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>';
  }
  echo '</form>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToDelete" value="'.$oneCategories['code'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-window-close" style="color: red; cursor: pointer;" aria-hidden="true"></i>
  </form>
  </td></tr>';
}
?>
</table>
</div>
<?php if(isset($_POST['codeToEdit'])):
$_SESSION['editCode']=$_POST['codeToEdit'];
$_SESSION['editPostValueLangCode']=$_POST['editPostValueLangCode'];?>
<div class="col-6">
<h2>Редактирование категории</h2>
<form method="post" action=""/>
<!--// id code name langCode //-->
<table>
<tr>
    <td align="right">Код категории:</td>
    <td><input class="form-control" type="text" value="<?php
    $categoriesTable=mysqli_query($link,"SELECT * FROM vn_category WHERE code='".$_POST['codeToEdit2']."' LIMIT 1");
    while($oneCategories=mysqli_fetch_assoc($categoriesTable)){
        echo $oneCategories['code'];
    }
    ?>" name="editCategoryCode" /></td>
</tr>
<!--name="newCategoryName"-->

<!--name="newCategoryLangCode"-->
<?php
    $langTable=mysqli_query($link, "SELECT code FROM vn_languages WHERE code='".$_POST['editPostValueLangCode']."'");
    while ($oneLanguage=mysqli_fetch_assoc($langTable)) {
      echo '<tr><td align="right">Название категории ('.$oneLanguage['code'].')</td><td><input class="form-control" type="text" value="';
    $categoriesTable=mysqli_query($link, "SELECT langCode, listOrder, name FROM vn_category WHERE langCode='".$_POST['editPostValueLangCode']."' AND listOrder='".$_POST['codeToEdit']."' ");
      while($oneCategory=mysqli_fetch_assoc($categoriesTable)){ 
          echo $oneCategory['name'];
      }
    echo'" name="editname_'.$oneLanguage['code'].'" /></td></tr>';
    }
?>
<tr>
    <td align="right">Порядковый номер категории:</td>
    <td><input class="form-control" type="number" value="<?php echo $_POST['codeToEdit'];?>" name="editCategoryOrder" /></td>
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
<h2>Добавление категории</h2>
<form method="post" action=""/>
<!--// id code name langCode //-->
<table>
<tr>
    <td align="right">Код категории:</td>
    <td><input class="form-control" type="text" name="newCategoryCode" /></td>
</tr>
<!--name="newCategoryName"-->

<!--name="newCategoryLangCode"-->
    <!--$langTable=mysqli_query($link, 'SELECT code FROM vn_languages ORDER BY listOrder');-->
    <!--while ($oneLanguage=mysqli_fetch_assoc($langTable)) {-->
    <!--  echo '<tr><td align="right">Название категории ('.$oneLanguage['code'].')</td><td><input class="form-control" type="text" name="name_'.$oneLanguage['code'].'" /></td></tr>';-->
    <!--}-->
<tr>
    <td align="right">Название категории (<?php echo $_GET['ln'];?>)</td>
    <td><input class="form-control" type="text" name="name_<?php echo $_GET['ln']; ?>" /></td>
</tr>
<tr>
    <td align="right">Порядковый номер категории:</td>
    <td><input class="form-control" type="number" name="newCategoryOrder" /></td>
</tr>
<tr>
    <td align="right"></td>
    <td><input class="btn btn-primary" type="submit" value="Добавить"/></td>
</tr>
</table>
</form>
</div>
<?php endif; ?>