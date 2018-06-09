<?php
if(isset($_POST['newLangName'])){
  //валидация данных и добавление в таблицу
  $testRes=true;
  $msgName='';
  //проверки:
  //1. Проверка обязательного наличия названия, кода, порядкового номера и кода языка
	$newName=$_POST['newLangName'];
	$newCode=$_POST['newLangCode'];
	$newOrder=$_POST['newLangListOrder'];
	//$newLang=$_POST['newModulLang'];

		if(empty($newName)){
			$testRes=false;
			$msgName.='<p>Отсутствует название языка</p>';
		}

		if(empty($newCode)){
			$testRes=false;
			$msgName.='<p>Отсутствует код языка</p>';
		}

		if(empty($newOrder)){
			$testRes=false;
			$msgName.='<p>Отсутствует порядковый номер языка</p>';
		}
  //2. Проверка Уникаьлности комбинации "название+код+языка"
  //if(testIt($newTitle, 'title', 'vn_moduls') && testIt($newCode, 'menuCode', 'vn_moduls') && testIt($newLang, 'langCode', 'vn_moduls')){
  //если все тру значит нельзя добавлять
	if($testRes){
		$test=mysqli_query($link, "SELECT COUNT (id) AS Q FROM vn_languages WHERE name='$newName' AND code='$newCode' AND listOrder='$newOrder' ");
		if($testRes['Q']>0){
			$testRes=false;
			$msgName.='<p>Такая запись существует</p>';
		}
	}

	//if($testRes){
		$res=mysqli_query($link, "INSERT INTO vn_languages VALUES (NULL, '$newCode','$newName','$newOrder') ");
		//echo '<p class="msggoodNews">Запись добавлена!</p>';
		//$msgName.='<p>Ошибка добавления!</p>';
		echo '<p class="msggoodNews">Запись добавлена!</p>';
	//}
  //3. Проверка на количество символов для языка
  if(mb_strlen($newCode)>2){
    $testRes=false;
	  $msgName.='<p>Неправильный код языка </p>';
  }

  //4. Проверка присутвствия выбранного языка в базе данных
  if($testRes){
		if(!testIt($newCode, 'code','vn_languages')){
			$testRes=false;
			$msgName.='<p>Такой код языка отсутствует</p>';
		}
	}

  //5. Проверка ограничения максимального количетсва символов в текстах
	if($testRes){
		if(mb_strlen($newName)>255){
			$testRes=false;
			$msgName.='<p>Слишком длинное название языка</p>';
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

  if($testRes){
  $allowedCodeSymbols="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  for($i=0; $i<mb_strlen($newCode); $i++){
	if(mb_strpos($allowedCodeSymbols, mb_substr($newCode,$i,1))===FALSE){
		$testRes=false;
	}
  }
  }

  //7. Порядковый номер уникален в пределах одного языка
  if($testRes){
	$test=mysqli_query($link, "SELECT COUNT (id) AS Q FROM vn_languages WHERE code='$newCode' AND listOrder='$newOrder' ");
	$test2=mysqli_fetch_assoc($test);
	if($test2['Q']>0){
		$next=mysqli_query($link, "SELECT MAX(listOrder) AS N FROM vn_languages WHERE code='$newCode'");
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

  if($testRes){
      $msgType="goodNews";
		$res=mysqli_query($link, "INSERT INTO vn_languages VALUES (NULL, '$newCode','$newName','$newOrder') ");
		//echo '<p class="msggoodNews">Запись добавлена!</p>';
		$msgName.='<p>Запись добавлена!</p>';
  }else{$msgType="badNews";}

  echo '<div onclick="this.style.display=\'none\'" class="msg'.$msgType.'">'.$msgName.'</div>';
}

if(isset($_POST['codeToDelete'])){
  $itemToDelete=$_POST['codeToDelete'];
  $langCodeToDelete=$_POST['langCodeToDelete'];
//   $sqlProductsLangCode=mysqli_query($link, "SELECT languages.* FROM vn_languages AS languages WHERE languages.code IN (SELECT prod.langCode FROM vn_products AS prod WHERE prod.langCode=languages.code ) ");
//  if($sqlProductsLangCode===FALSE){
$res=mysqli_query($link, "DELETE FROM vn_languages WHERE listOrder='$itemToDelete' ");
  if($res===true){
      mysqli_query($link, "DELETE FROM vn_terms WHERE langCode='$langCodeToDelete' ");
      mysqli_query($link, "DELETE FROM vn_products WHERE langCode='$langCodeToDelete' ");
      mysqli_query($link, "DELETE FROM vn_category WHERE langCode='$langCodeToDelete' ");
      mysqli_query($link, "DELETE FROM vn_aboutUs WHERE langCode='$langCodeToDelete' ");
      echo '<div class="msggoodNews">Язык удален</div>';
  }else{
      echo '<div class="msgbadNews">Ошибка удаления</div>';
  }
  /*$res=mysqli_query($link, "DELETE FROM vn_languages WHERE listOrder='$itemToDelete' ");
  if($res===true){echo '<div class="msggoodNews">Язык удален</div>';}else{echo '<div class="msgbadNews">Ошибка удаления</div>';}*/
  
//  }else{
//      echo '<div class="msgbadNews">Ошибка удаления языка, сущности связаны с языком, прежде чем удалить язык, очистите все сущности связанные с этим языком</div>';
//  }
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
    $resUpdate=mysqli_query($link, "UPDATE vn_languages SET listOrder='' WHERE listOrder<$itemToUp ORDER BY listOrder DESC LIMIT 1");
    if($resUpdate){ echo '<div class="msggoodNews">Язык перемещен наверх</div>';}else{ echo '<div class="msgbadNews">Ошибка перемещения</div>';}
}

if(isset($_POST['codeToDown'])){
    $itemToDown=$_POST['codeToDown'];
    $res=mysqli_query($link, "SELECT listOrder FROM vn_languages WHERE listOrder>$itemToDown ORDER BY listOrder DESC LIMIT 1");
    //mysqli_query($link, "UPDATE vn_languages SET listOrder=''");
    if($res===true){ echo '<div class="msggoodNews">Язык перемещен вниз</div>';}else{ echo '<div class="msgbadNews">Ошибка перемещения</div>';}
}


if(isset($_POST['editLangName']) && isset($_POST['editLangCode']) && isset($_POST['editLangListOrder'])){
    $editLangName=$_POST['editLangName'];
    $editLangCode=$_POST['editLangCode'];
    $editLangListOrder=$_POST['editLangListOrder'];
    $codeToEdit=$_SESSION['editCode'];
    $sql=mysqli_query($link, "UPDATE vn_languages SET code='$editLangCode', name='$editLangName', listOrder='$editLangListOrder'  WHERE id='$codeToEdit' ");
    if($sql){
        echo '<div class="msggoodNews">Язык был редактирован</div>';
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
<h2>Страница управления языками сайта</h2>
<table class="table table-striped table-responsive">
    <tr>
        <th scope="col">N</th>
        <th scope="col">Название языка</th>
        <th scope="col">Код языка</th>
        <th scope="col" colspan="4">Действия</th>
    </tr>
<?php
$langTable=mysqli_query($link,"SELECT * FROM vn_languages GROUP BY listOrder");
while($oneLang=mysqli_fetch_assoc($langTable)){
  echo '<tr><td>'.$oneLang['listOrder'].'</td>
  <td scope="row">'.$oneLang['name'].'</td>
  <td>'.$oneLang['code'].'</td>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToEdit" value="'.$oneLang['id'].'" />
  <input type="hidden" name="editPostValueCode" value="'.$oneLang['code'].'" />
  <input type="hidden" name="editPostValueName" value="'.$oneLang['name'].'" />
  <input type="hidden" name="editPostValueListOrder" value="'.$oneLang['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-pencil-square-o" style="color: green; cursor: pointer;" aria-hidden="true"></i>
  </td>
  </form>
  <td>
  <form action="" method="post">';
  if($oneLang['listOrder']!=1){
  echo '<input type="hidden" name="codeToUp" value="'.$oneLang['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-up" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>';
    }
  echo '</form>
  <td>
  <form action="" method="post">';
  $langListOrderCount=mysqli_query($link,"SELECT COUNT(listOrder) AS total FROM vn_languages");
  $countOrder=mysqli_fetch_assoc($langListOrderCount);
  if($oneLang['listOrder']<$countOrder['total']){
  echo '<input type="hidden" name="codeToDown" value="'.$oneLang['listOrder'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-down" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>';
  }
  echo '</form>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToDelete" value="'.$oneLang['listOrder'].'" />
  <input type="hidden" name="langCodeToDelete" value="'.$oneLang['code'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-window-close" style="color: red; cursor: pointer;" aria-hidden="true"></i>
  </form>
  </td>
  <td>
  </tr>';
}
echo '<a class="btn btn-primary" href="" role="button">Вернуться на добавление языков</a>';
?>
</table>
</div>
<?php if(isset($_POST['codeToEdit'])): 
$_SESSION['editCode']=$_POST['codeToEdit'];
$_SESSION['editPostValueCode']=$_POST['editPostValueCode'];
$_SESSION['editPostValueName']=$_POST['editPostValueName'];
$_SESSION['editPostValueListOrder']=$_POST['editPostValueListOrder'];?>
<div class="col-6">
<h2>Редактирование языка сайта</h2>
<form method="post" action=""/>
<!--// id code name listOrder //-->
<table>
<tr>
  <td align="right">Код языка:</td>
  <td><input class="form-control" type="text" value="<?php echo $_POST['editPostValueCode']; ?>" name="editLangCode" maxlength="2" /></td>
</tr>
<tr>
  <td align="right">Название языка:</td>
  <td><input class="form-control" type="text" value="<?php echo $_POST['editPostValueName']; ?>" name="editLangName" /></td>
</tr>
<tr>
  <td align="right">Порядковый номер:</td>
  <td><input class="form-control" type="number" value="<?php echo $_POST['editPostValueListOrder']; ?>" name="editLangListOrder" /></td>
</tr>
<td align="right"></td>
<td><input class="btn btn-primary" type="submit" value="Редактировать"/></td>
</tr>
</table>
</form>
</div>
<?php else: ?>
<div class="col-6">
<h2>Добавление языка сайта</h2>
<form method="post" action=""/>
<!--// id code name listOrder //-->
<table>
<tr>
  <td align="right">Код языка:</td>
  <td><input class="form-control" type="text" name="newLangCode" maxlength="2" /></td>
</tr>
<tr>
  <td align="right">Название языка:</td>
  <td><input class="form-control" type="text" name="newLangName" /></td>
</tr>
<tr>
  <td align="right">Порядковый номер:</td>
  <td><input class="form-control" type="number" name="newLangListOrder" /></td>
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