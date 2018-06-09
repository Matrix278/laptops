<?php
if(isset($_POST['newContactsIcon'])){
  //валидация данных и добавление в таблицу
  $testRes=true;
  $msgName='';
  //проверки:
  //1. Проверка обязательного наличия названия, кода, порядкового номера и кода языка
  $newIcon=$_POST['newContactsIcon'];
  $newFirstColText=$_POST['newContactsFirstColText'];
  $newSecondColText=$_POST['newContactsSecondColText'];
  $newThirdColText=$_POST['newContactsThirdColText'];
	$newOrder=$_POST['newContactsListOrder'];
	//$newLang=$_POST['newModulLang'];

		if(empty($newIcon)){
			$testRes=false;
			$msgName.='<p>Отсутствует заглавие блока</p>';
		}

		if(empty($newOrder)){
			$testRes=false;
			$msgName.='<p>Отсутствует порядковый номер</p>';
		}

	if($testRes){
	    foreach ($_POST as $postKey => $postValue) {
            if(strpos($postKey, "newTitle_")!==false){$newPostTitle=$_SESSION['newPostTitle']=$postValue;}
            if(strpos($postKey, "newFirstCol_")!==false){$newPostFirstCol=$_SESSION['newPostFirstCol']=$postValue;}
            if(strpos($postKey, "newSecondCol_")!==false){$newPostSecondCol=$_SESSION['newPostSecondCol']=$postValue;}
            if(strpos($postKey, "newThirdCol_")!==false){$newPostThirdCol=$_SESSION['newPostThirdCol']=$postValue;}
            $langCode=substr($postKey, -2);
            
            $res=mysqli_query($link, "INSERT INTO vn_contacts VALUES('$newPostTitle', '$newPostFirstCol', '$newFirstColText', '$newPostSecondCol', '$newSecondColText', '$newPostThirdCol', '$newThirdColText', '$langCode', '$newOrder', '$newIcon')");
            if($res){
                echo '<div class="msggoodNews">Запись добавлена</div>';
            }else{
                echo '<div class="msgbadNews">Ошибка добавления</div>';
            }
        }
	}

  //2. Проверка Уникаьлности комбинации "название+код+языка"
  //if(testIt($newTitle, 'title', 'vn_moduls') && testIt($newCode, 'menuCode', 'vn_moduls') && testIt($newLang, 'langCode', 'vn_moduls')){
  //если все тру значит нельзя добавлять

  //3. Проверка на количество символов для языка
//   if(mb_strlen($newLangCode)>2){
//     $testRes=false;
// 	  $msgName.='<p>Неправильный код языка </p>';
//   }

  //4. Проверка присутвствия выбранного языка в базе данных
//   if($testRes){
// 		if(!testIt($newLangCode, 'code','vn_languages')){
// 			$testRes=false;
// 			$msgName.='<p>Такой код языка отсутствует</p>';
// 		}
// 	}

  //5. Проверка ограничения максимального количетсва символов в текстах
	if($testRes){
		if(mb_strlen($newFirstColText)>255){
			$testRes=false;
			$msgName.='<p>Слишком длинное заглавие</p>';
		}
	}

	/*if($testRes){
		if(mb_strlen($newCode)>255){
			$testRes=false;
			$msgName.='<p>Слишком длинный код языка</p>';
		}
	}*/

  //6. Проверка на разрешенные/запрещенные символы
//   if($testRes){
//   $allowedSymbols="ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯ0123456789-";
//   for($i=0; $i<mb_strlen($newFirstColText); $i++){
// 	if(mb_strpos($allowedSymbols, mb_substr($newName,$i,1))===FALSE){
// 		$testRes=false;
// 	}
//   }
//   }

//   if($testRes){
//   $allowedCodeSymbols="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
//   for($i=0; $i<mb_strlen($newLangCode); $i++){
// 	if(mb_strpos($allowedCodeSymbols, mb_substr($newCode,$i,1))===FALSE){
// 		$testRes=false;
// 	}
//   }
//   }

  //7. Порядковый номер уникален в пределах одного языка
//   if($testRes){
// 	$test=mysqli_query($link, "SELECT COUNT (id) AS Q FROM vn_aboutUs WHERE langCode='$newCode' AND listOrder='$newOrder' ");
// 	$test2=mysqli_fetch_assoc($test);
// 	if($test2['Q']>0){
// 		$next=mysqli_query($link, "SELECT MAX(listOrder) AS N FROM vn_languages WHERE code='$newCode'");
// 		$nextRes=mysqli_fetch_assoc($next);
// 		$nextNum=(int)$nextRes['N']+1; //если занят номер, то берём максималый номер +1
// 		$newOrder=$newNum;
// 	}
// }

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
  $res=mysqli_query($link, "DELETE FROM vn_contacts WHERE listOrder='$itemToDelete' ");
  if($res===true){echo '<div class="msggoodNews">Блок удален</div>';}else{echo '<div class="msgbadNews">Ошибка удаления</div>';}
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
    $resUpdate=mysqli_query($link, "UPDATE vn_contacts SET listOrder='' WHERE listOrder<$itemToUp ORDER BY listOrder DESC LIMIT 1");
    if($resUpdate){ echo '<div class="msggoodNews">Блок перемещен наверх</div>';}else{ echo '<div class="msgbadNews">Ошибка перемещения</div>';}
}

if(isset($_POST['codeToDown'])){
    $itemToDown=$_POST['codeToDown'];
    $res=mysqli_query($link, "SELECT listOrder FROM vn_contacts WHERE listOrder>$itemToDown ORDER BY listOrder DESC LIMIT 1");
    //mysqli_query($link, "UPDATE vn_languages SET listOrder=''");
    if($res===true){ echo '<div class="msggoodNews">Блок перемещен вниз</div>';}else{ echo '<div class="msgbadNews">Ошибка перемещения</div>';}
}

//---------------------------------------EDIT--------------------------------------//
if(isset($_POST['editAboutUsTitle'])){
    $editAboutUsTitle=$_POST['editAboutUsTitle'];
	$editAboutUsListOrder=$_POST['editAboutUsListOrder'];

    $codeToEdit=$_SESSION['editCode'];

    foreach ($_POST as $postKey => $postValue) {
            if(strpos($postKey, "editname_")!==false){
            $langCode=substr($postKey, -2);
            $sql=mysqli_query($link, "UPDATE INTO vn_contacts SET title='$editAboutUsTitle', text='$postValue', langCode='$langCode', listOrder='$editAboutUsListOrder' WHERE id='$codeToEdit' ");
            }
        }
    if($sql){
        echo '<div class="msggoodNews">Блок был редактирован</div>';
    }else{
        echo '<div class="msgbadNews">Ошибка редактирования</div>';
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
<h2>Страница управления блоков на странице "Контактов"</h2>
<table class="table table-striped table-responsive">
    <tr>
        <th scope="col">N</th>
        <th scope="col">Заглавие</th>
        <th scope="col">Иконка</th>
        <th scope="col">Первая колонка</th>
        <th scope="col">Содержимое первой колонки</th>
        <th scope="col">Вторая колонка</th>
        <th scope="col">Содержимое второй колонки</th>
        <th scope="col">Третья колонка</th>
        <th scope="col">Содержимое третьей колонки</th>
        <th scope="col">Код языка</th>
        <th scope="col" colspan="4">Действия</th>
    </tr>
<?php
$contactsTable=mysqli_query($link,"SELECT * FROM vn_contacts ORDER BY listOrder");
while($oneContact=mysqli_fetch_assoc($contactsTable)){
  echo '<tr><td>'.$oneContact['listOrder'].'</td>
  <td scope="row">'.$oneContact['title'].'</td>
  <td>'.$oneContact['icon'].'</td>
  <td>'.$oneContact['adress'].'</td>
  <td>'.$oneContact['adressText'].'</td>
  <td>'.$oneContact['email'].'</td>
  <td>'.$oneContact['emailText'].'</td>
  <td>'.$oneContact['telephone'].'</td>
  <td>'.$oneContact['telephoneText'].'</td>
  <td>'.$oneContact['langCode'].'</td>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToEdit" value="'.$oneContact['id'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-pencil-square-o" style="color: green; cursor: pointer;" aria-hidden="true"></i>
  </td>
  </form>
  <td>
  <form action="" method="post">';
  if($oneContact['listOrder']!=1){
  echo '<input type="hidden" name="codeToUp" value="'.$oneContact['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-up" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>';
    }
  echo '</form>
  <td>
  <form action="" method="post">';
  $contactsListOrderCount=mysqli_query($link,"SELECT COUNT(listOrder) AS total FROM vn_contacts");
  $countOrder=mysqli_fetch_assoc($contactsListOrderCount);
  if($oneContact['listOrder']<$countOrder['total']){
  echo '<input type="hidden" name="codeToDown" value="'.$oneContact['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-down" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>';
  }
  echo '</form>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToDelete" value="'.$oneContact['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-window-close" style="color: red; cursor: pointer;" aria-hidden="true"></i>
  </form>
  </td>
  <td>
  </tr>';
}
echo '<a class="btn btn-primary" href="" role="button">Вернуться на добавление блоков</a>';
?>
</table>
</div>
<?php if(isset($_POST['codeToEdit'])):
$_SESSION['editCode']=$_POST['codeToEdit'];?>
<div class="col-6">
<h2>Редактирование блоков на странице "Контактов"</h2>
<form method="post" action=""/>
<!--// id code name listOrder //-->
<table>
  <tr>
    <td align="right">Иконка:</td>
    <td><input class="form-control" type="text" name="editContactsIcon" /></td>
  </tr>
  <!-- <tr>
    <td align="right">Заглавие:</td>
    <td><input class="form-control" type="text" name="editContactsTitle" /></td>
  </tr>-->
    <?php
        $langTable=mysqli_query($link, 'SELECT code FROM vn_languages ORDER BY listOrder');
        while ($oneLanguage=mysqli_fetch_assoc($langTable)) {
          echo '<tr><td align="right">Заглавие блока ('.$oneLanguage['code'].')</td><td><textarea class="form-control" rows="8" cols="45" name="editTitle_'.$oneLanguage['code'].'" ></textarea></td></tr>';
        }
    ?>
  <!-- <tr>
    <td align="right">Первая колонка:</td>
    <td><input class="form-control" type="text" name="newContactsFirstCol" /></td>
  </tr> -->
  <?php
      $langTable=mysqli_query($link, 'SELECT code FROM vn_languages ORDER BY listOrder');
      while ($oneLanguage=mysqli_fetch_assoc($langTable)) {
        echo '<tr><td align="right">Первая колонка ('.$oneLanguage['code'].')</td><td><input class="form-control" name="editFirstCol_'.$oneLanguage['code'].'" /></td></tr>';
      }
  ?>
  <tr>
    <td align="right">Содержимое первой колонки:</td>
    <td><input class="form-control" type="text" name="editContactsFirstColText" /></td>
  </tr>
  <!-- <tr>
    <td align="right">Вторая колонка:</td>
    <td><input class="form-control" type="text" name="newContactsSecondCol" /></td>
  </tr> -->
  <?php
      $langTable=mysqli_query($link, 'SELECT code FROM vn_languages ORDER BY listOrder');
      while ($oneLanguage=mysqli_fetch_assoc($langTable)) {
        echo '<tr><td align="right">Вторая колонка ('.$oneLanguage['code'].')</td><td><input class="form-control" name="editSecondCol_'.$oneLanguage['code'].'" /></td></tr>';
      }
  ?>
  <tr>
    <td align="right">Содержимое второй колонки:</td>
    <td><input class="form-control" type="text" name="editContactsSecondColText" /></td>
  </tr>
  <!-- <tr>
    <td align="right">Третья колонка:</td>
    <td><input class="form-control" type="text" name="newContactsThirdCol" /></td>
  </tr> -->
  <?php
      $langTable=mysqli_query($link, 'SELECT code FROM vn_languages ORDER BY listOrder');
      while ($oneLanguage=mysqli_fetch_assoc($langTable)) {
        echo '<tr><td align="right">Третья колонка ('.$oneLanguage['code'].')</td><td><input class="form-control" name="editThirdCol_'.$oneLanguage['code'].'" /></td></tr>';
      }
  ?>
  <tr>
    <td align="right">Содержимое третьей колонки:</td>
    <td><input class="form-control" type="text" name="editContactsThirdColText" /></td>
  </tr>
  <tr>
    <td align="right">Код языка:</td>
    <td><input class="form-control" type="text" maxlength="2" name="editContactsLangCode" /></td>
  </tr>
  <tr>
    <td align="right">Порядковый номер:</td>
    <td><input class="form-control" type="number" name="editContactsListOrder" /></td>
  </tr>
<td align="right"></td>
<td><input class="btn btn-primary" type="submit" value="Редактировать"/></td>
</tr>
</table>
</form>
</div>
<?php else: ?>
<div class="col-6">
<h2>Добавление блоков на странице "Контактов"</h2>
<form method="post" action=""/>
<!--// id code name listOrder //-->
<table>
<tr>
  <td align="right">Иконка:</td>
  <td><input class="form-control" type="text" name="newContactsIcon" placeholder="fa-envelope"/></td>
</tr>
<!-- <tr>
  <td align="right">Заглавие:</td>
  <td><input class="form-control" type="text" name="newContactsTitle" /></td>
</tr> -->
<?php
    $langTable=mysqli_query($link, 'SELECT code FROM vn_languages ORDER BY listOrder');
    while ($oneLanguage=mysqli_fetch_assoc($langTable)) {
      echo '<tr><td align="right">Заглавие блока ('.$oneLanguage['code'].')</td><td><input class="form-control" rows="8" cols="45" name="newTitle_'.$oneLanguage['code'].'" /></td></tr>';
    }
?>
<!-- <tr>
  <td align="right">Первая колонка:</td>
  <td><input class="form-control" type="text" name="newContactsFirstCol" /></td>
</tr> -->
<?php
    $langTable=mysqli_query($link, 'SELECT code FROM vn_languages ORDER BY listOrder');
    while ($oneLanguage=mysqli_fetch_assoc($langTable)) {
      echo '<tr><td align="right">Первая колонка ('.$oneLanguage['code'].')</td><td><input class="form-control" name="newFirstCol_'.$oneLanguage['code'].'" /></td></tr>';
    }
?>
<tr>
  <td align="right">Содержимое первой колонки:</td>
  <td><input class="form-control" type="text" name="newContactsFirstColText" /></td>
</tr>
<!-- <tr>
  <td align="right">Вторая колонка:</td>
  <td><input class="form-control" type="text" name="newContactsSecondCol" /></td>
</tr> -->
<?php
    $langTable=mysqli_query($link, 'SELECT code FROM vn_languages ORDER BY listOrder');
    while ($oneLanguage=mysqli_fetch_assoc($langTable)) {
      echo '<tr><td align="right">Вторая колонка ('.$oneLanguage['code'].')</td><td><input class="form-control" name="newSecondCol_'.$oneLanguage['code'].'" /></td></tr>';
    }
?>
<tr>
  <td align="right">Содержимое второй колонки:</td>
  <td><input class="form-control" type="text" name="newContactsSecondColText" /></td>
</tr>
<!-- <tr>
  <td align="right">Третья колонка:</td>
  <td><input class="form-control" type="text" name="newContactsThirdCol" /></td>
</tr> -->
<?php
    $langTable=mysqli_query($link, 'SELECT code FROM vn_languages ORDER BY listOrder');
    while ($oneLanguage=mysqli_fetch_assoc($langTable)) {
      echo '<tr><td align="right">Третья колонка ('.$oneLanguage['code'].')</td><td><input class="form-control" name="newThirdCol_'.$oneLanguage['code'].'" /></td></tr>';
    }
?>
<tr>
  <td align="right">Содержимое третьей колонки:</td>
  <td><input class="form-control" type="text" name="newContactsThirdColText" /></td>
</tr>
<tr>
  <td align="right">Порядковый номер:</td>
  <td><input class="form-control" type="number" name="newContactsListOrder" /></td>
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
