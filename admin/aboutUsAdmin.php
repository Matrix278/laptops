<?php
if(isset($_POST['newAboutUsTitle'])){
  //валидация данных и добавление в таблицу
  $testRes=true;
  $msgName='';
  //проверки:
  //1. Проверка обязательного наличия названия, кода, порядкового номера и кода языка
	$newName=$_POST['newAboutUsTitle'];
	$newOrder=$_POST['newAboutUsListOrder'];
	//$newLang=$_POST['newModulLang'];

		if(empty($newName)){
			$testRes=false;
			$msgName.='<p>Отсутствует заглавие текста</p>';
		}

		if(empty($newOrder)){
			$testRes=false;
			$msgName.='<p>Отсутствует порядковый номер</p>';
		}
		
	if($testRes){
	    foreach ($_POST as $postKey => $postValue) {
            if(strpos($postKey, "name_")!==false){
            $langCode=substr($postKey, -2);
            $res=mysqli_query($link, "INSERT INTO vn_aboutUs VALUES(NULL, '$newName', '$postValue', '$langCode', '$newOrder')");
            }
        }
        echo '<p class="msggoodNews">Запись добавлена!</p>';
	}
  //2. Проверка Уникаьлности комбинации "название+код+языка"
  //if(testIt($newTitle, 'title', 'vn_moduls') && testIt($newCode, 'menuCode', 'vn_moduls') && testIt($newLang, 'langCode', 'vn_moduls')){
  //если все тру значит нельзя добавлять

  //3. Проверка на количество символов для языка
//   if(mb_strlen($newCode)>2){
//     $testRes=false;
// 	  $msgName.='<p>Неправильный код языка </p>';
//   }

  //4. Проверка присутвствия выбранного языка в базе данных
//   if($testRes){
// 		if(!testIt($newCode, 'code','vn_languages')){
// 			$testRes=false;
// 			$msgName.='<p>Такой код языка отсутствует</p>';
// 		}
// 	}

  //5. Проверка ограничения максимального количетсва символов в текстах
	if($testRes){
		if(mb_strlen($newName)>255){
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
  if($testRes){
  $allowedSymbols="ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯ0123456789-";
  for($i=0; $i<mb_strlen($newName); $i++){
	if(mb_strpos($allowedSymbols, mb_substr($newName,$i,1))===FALSE){
		$testRes=false;
	}
  }
  }

//   if($testRes){
//   $allowedCodeSymbols="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
//   for($i=0; $i<mb_strlen($newCode); $i++){
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
  $res=mysqli_query($link, "DELETE FROM vn_aboutUs WHERE listOrder='$itemToDelete' AND langCode='".$_GET['ln']."' ");
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
    $resUpdate=mysqli_query($link, "UPDATE vn_aboutUs SET listOrder='' WHERE listOrder<$itemToUp ORDER BY listOrder DESC LIMIT 1");
    if($resUpdate){ echo '<div class="msggoodNews">Блок перемещен наверх</div>';}else{ echo '<div class="msgbadNews">Ошибка перемещения</div>';}
}

if(isset($_POST['codeToDown'])){
    $itemToDown=$_POST['codeToDown'];
    $res=mysqli_query($link, "SELECT listOrder FROM vn_aboutUs WHERE listOrder>$itemToDown ORDER BY listOrder DESC LIMIT 1");
    //mysqli_query($link, "UPDATE vn_languages SET listOrder=''");
    if($res===true){ echo '<div class="msggoodNews">Блок перемещен вниз</div>';}else{ echo '<div class="msgbadNews">Ошибка перемещения</div>';}
}


if(isset($_POST['editAboutUsTitle'])){
    $editAboutUsTitle=$_POST['editAboutUsTitle'];
	$editAboutUsListOrder=$_POST['editAboutUsListOrder'];
	
    $codeToEdit=$_SESSION['editCode'];
    
    foreach ($_POST as $postKey => $postValue) {
            if(strpos($postKey, "editname_")!==false){
            $langCode=substr($postKey, -2);
            $sql=mysqli_query($link, "UPDATE vn_aboutUs SET title='$editAboutUsTitle', text='$postValue', langCode='$langCode', listOrder='$editAboutUsListOrder' WHERE id='$codeToEdit' ");
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
<h2>Страница управления блоков на странице "О нас"</h2>
<?php
echo '<a style="margin: 5px;" class="btn btn-primary" href="" role="button">Вернуться на добавление блоков</a><br/><br/>';
$langTable=mysqli_query($link, "SELECT * FROM vn_languages");
while($oneLanguages=mysqli_fetch_assoc($langTable)){
  echo '<a style="margin: 5px;" href="?ln='.$oneLanguages['code'].'"><button class="btn btn-primary" >'.$oneLanguages['name'].'</button></a>';
 }
?>
<table class="table table-striped table-responsive">
    <tr>
        <th scope="col">N</th>
        <th scope="col">Заглавие</th>
        <th scope="col">Текст</th>
        <th scope="col">Код языка</th>
        <th scope="col" colspan="4">Действия</th>
    </tr>
<?php
$aboutUsTable=mysqli_query($link,"SELECT * FROM vn_aboutUs WHERE langCode='".$_GET['ln']."' ORDER BY listOrder");
while($oneAbout=mysqli_fetch_assoc($aboutUsTable)){
  echo '<tr><td>'.$oneAbout['listOrder'].'</td>
  <td scope="row">'.$oneAbout['title'].'</td>
  <td>'.$oneAbout['lead'].'</td>
  <td>'.$oneAbout['langCode'].'</td>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToEdit" value="'.$oneAbout['id'].'" />
  <input type="hidden" name="editPostValueTitle" value="'.$oneAbout['title'].'" />
  <input type="hidden" name="editPostValueLead" value="'.$oneAbout['lead'].'" />
  <input type="hidden" name="editPostValueLangCode" value="'.$oneAbout['langCode'].'" />
  <input type="hidden" name="editPostValueListOrder" value="'.$oneAbout['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-pencil-square-o" style="color: green; cursor: pointer;" aria-hidden="true"></i>
  </td>
  </form>
  <td>
  <form action="" method="post">';
  if($oneAbout['listOrder']!=1){
  echo '<input type="hidden" name="codeToUp" value="'.$oneAbout['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-up" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>';
    }
  echo '</form>
  <td>
  <form action="" method="post">';
  $aboutUsListOrderCount=mysqli_query($link,"SELECT COUNT(listOrder) AS total FROM vn_aboutUs");
  $countOrder=mysqli_fetch_assoc($aboutUsListOrderCount);
  if($oneAbout['listOrder']<$countOrder['total']){
  echo '<input type="hidden" name="codeToDown" value="'.$oneAbout['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-down" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>';
  }
  echo '</form>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToDelete" value="'.$oneAbout['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-window-close" style="color: red; cursor: pointer;" aria-hidden="true"></i>
  </form>
  </td>
  <td>
  </tr>';
}
?>
</table>
</div>
<?php if(isset($_POST['codeToEdit'])): 
$_SESSION['editCode']=$_POST['codeToEdit'];
$_SESSION['editPostValueTitle']=$_POST['editPostValueTitle'];
$_SESSION['editPostValueLead']=$_POST['editPostValueLead'];
$_SESSION['editPostValueLangCode']=$_POST['editPostValueLangCode'];
$_SESSION['editPostValueListOrder']=$_POST['editPostValueListOrder'];?>
<div class="col-6">
<h2>Редактирование блоков на странице "О нас"</h2>
<form method="post" action=""/>
<!--// id code name listOrder //-->
<table>
<tr>
  <td align="right">Заглавие:</td>
  <td><input class="form-control" type="text" value="<?php echo $_POST['editPostValueTitle'];?>" name="editAboutUsTitle" /></td>
</tr>
<?php
    $langTable=mysqli_query($link, "SELECT code FROM vn_languages WHERE code='".$_POST['editPostValueLangCode']."' ");
    while ($oneLanguage=mysqli_fetch_assoc($langTable)) {
      echo '<tr><td align="right">Текст блока ('.$oneLanguage['code'].')</td><td><textarea class="form-control" rows="8" cols="45" name="editname_'.$oneLanguage['code'].'" >';
      $aboutUsTable=mysqli_query($link, "SELECT * FROM vn_aboutUs WHERE langCode='".$_POST['editPostValueLangCode']."' AND listOrder='".$_POST['editPostValueListOrder']."' ");
      while($oneAboutUs=mysqli_fetch_assoc($aboutUsTable)){ 
          echo $oneAboutUs['lead'];
      }
      echo '</textarea></td></tr>';
    }
?>
<tr>
  <td align="right">Порядковый номер:</td>
  <td><input class="form-control" type="number" value="<?php echo $_POST['editPostValueListOrder'];?>" name="editAboutUsListOrder" /></td>
</tr>
<td align="right"></td>
<td><input class="btn btn-primary" type="submit" value="Редактировать"/></td>
</tr>
</table>
</form>
</div>
<?php else: ?>
<div class="col-6">
<h2>Добавление блоков на странице "О нас"</h2>
<form method="post" action=""/>
<!--// id code name listOrder //-->
<table>
<tr>
  <td align="right">Заглавие:</td>
  <td><input class="form-control" type="text" name="newAboutUsTitle" /></td>
</tr>

    <!--$langTable=mysqli_query($link, 'SELECT code FROM vn_languages ORDER BY listOrder');-->
    <!--while ($oneLanguage=mysqli_fetch_assoc($langTable)) {-->
    <!--  echo '<tr><td align="right">Текст блока ('.$oneLanguage['code'].')</td><td><textarea class="form-control" rows="8" cols="45" name="name_'.$oneLanguage['code'].'" ></textarea></td></tr>';-->
    <!--}-->

<tr>
    <td align="right">Текст блока (<?php echo $_GET['ln'];?>)</td>
    <td><textarea class="form-control" rows="8" cols="45" name="name_<?php echo $_GET['ln']; ?>" ></textarea></td>
</tr>
<tr>
  <td align="right">Порядковый номер:</td>
  <td><input class="form-control" type="number" name="newAboutUsListOrder" /></td>
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