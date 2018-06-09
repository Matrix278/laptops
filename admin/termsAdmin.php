<?php

if(isset($_POST['newTermsCode'])){
  //валидация данных и добавление в таблицу
  $testRes=true;
  $msgName='';
  //проверки:
  //1. Проверка обязательного наличия названия, кода, порядкового номера и кода языка
// 	$newName=$_POST['newTermsName'];
	$newCode=$_POST['newTermsCode'];

		/*if(empty($newName)){
			$testRes=false;
			$msgName.='<p>Отсутствует название термина</p>';
		}*/

		if(empty($newCode)){
			$testRes=false;
			$msgName.='<p>Отсутствует код термина</p>';
		}

		/*if(empty($newOrder)){
			$testRes=false;
			$msgName.='<p>Отсутствует порядковый номер термина</p>';
		}*/

		/*if(empty($newLang)){
			$testRes=false;
			$msgName.='<p>Отсутствует код языка термина</p>';
		}*/
  //2. Проверка Уникаьлности комбинации "название+код+языка"
  //if(testIt($newTitle, 'title', 'vn_moduls') && testIt($newCode, 'menuCode', 'vn_moduls') && testIt($newLang, 'langCode', 'vn_moduls')){
  //если все тру значит нельзя добавлять
	if($testRes){
		$test=mysqli_query($link, "SELECT COUNT (id) AS Q FROM vn_terms WHERE code='$newCode' ");
		if($testRes['Q']>0){
			$testRes=false;
			$msgName.='<p>Такая запись существует</p>';
		}
	}

	/*if($testRes){
		$res=mysqli_query($link, "INSERT INTO vn_terms VALUES (NULL, '$newCode','$newName','$newLang') ");
		$msgName='<p>Запись добавлена !</p>';
	}*/
	if($testRes){
	    foreach ($_POST as $postKey => $postValue) {
            if(strpos($postKey, "name_")!==false){
            $langCode=substr($postKey, -2);
            mysqli_query($link, "INSERT INTO vn_terms VALUES(NULL, '$newCode', '$postValue', '$langCode')");
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
			$msgName.='<p>Слишком длинное название термина</p>';
		}
	}*/

	if($testRes){
		if(mb_strlen($newCode)>255){
			$testRes=false;
			$msgName.='<p>Слишком длинный код термина</p>';
		}
	}

  //6. Проверка на разрешенные/запрещенные символы
  /*if($testRes){
  $allowedSymbols="ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯ0123456789-";
  for($i=0; $i<mb_strlen($newName); $i++){
	if(mb_strpos($allowedSymbols, mb_substr($newName,$i,1))===FALSE){
		$testRes=false;
	}
  }
  }*/

  if($testRes){
  $allowedSymbols="ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯ0123456789-";
  for($i=0; $i<mb_strlen($newCode); $i++){
	if(mb_strpos($allowedSymbols, mb_substr($newCode,$i,1))===FALSE){
		$testRes=false;
	}
  }
  }

  //7. Порядковый номер уникален в пределах одного языка
  /*if($testRes){
	$test=mysqli_query($link, "SELECT COUNT (id) AS Q FROM vn_moduls WHERE langCode='$newLang' AND orderNum='$newOrder' ");
	$test2=mysqli_fetch_assoc($test);
	if($test2['Q']>0){
		$next=mysqli_query($link, "SELECT MAX(orderNum) AS N FROM vn_moduls WHERE langCode='$newLang'");
		$nextRes=mysqli_fetch_assoc($next);
		$nextNum=(int)$nextRes['N']+1; //если занят номер, то берём максималый номер +1
		$newOrder=$newNum;
	}
}*/

  //8. Если не задан порядковый номер, то ставить ноль (или следующий по порядку)
  /*if($testRes){
  if($newOrder==""){
    $order="0";
	$testRes=false;
  }
}*/

  if($testRes){$msgType="goodNews";}else{$msgType="badNews";}

  echo '<div onclick="this.style.display=\'none\'" class="msg'.$msgType.'">'.$msgName.'</div>';
}

if(isset($_POST['codeToDelete'])){
  $itemToDelete=$_POST['codeToDelete'];
  $res=mysqli_query($link, "DELETE FROM vn_terms WHERE code='$itemToDelete' AND langCode='".$_GET['ln']."' ");
  if($res===true){echo '<div class="msggoodNews">Термин удален</div>';}else{echo '<div class="msgbadNews">Ошибка удаления</div>';}
}

if(isset($_POST['editTermsCode'])){
    $editTermsCode=$_POST['editTermsCode'];
    
    // $editTermRu=$_POST['editname_ru'];
    // $editTermEt=$_POST['editname_et'];
    // $editTermEn=$_POST['editname_en'];
    
    $codeToEdit=$_SESSION['editCode'];
    
    foreach ($_POST as $postKey => $postValue) {
            if(strpos($postKey, "editname_")!==false){
            $langCode=substr($postKey, -2);
            $sql=mysqli_query($link, "UPDATE vn_terms SET code='$editTermsCode', text='$postValue', langCode='$langCode' WHERE code='$codeToEdit' AND langCode='$langCode' ");
            if($sql){
                echo '<div class="msggoodNews">Редактирование успешно</div>';
            }else{
                echo '<div class="msgbadNews">Ошибка записи</div>';
            }
            }
    }
    
    // $sqlRu=mysqli_query($link, "UPDATE vn_terms SET code='$editTermsCode', text='$editTermRu' WHERE code='$codeToEdit'  AND langCode='ru' ");
}
?>
<div class="row">
<div class="col-6">
<h2>Страница управления терминами и переводами</h2>
<?php
echo '<a style="margin: 5px;" class="btn btn-primary" href="" role="button">Вернуться на добавление терминов</a><br/><br/>';
$langTable=mysqli_query($link, "SELECT * FROM vn_languages");
while($oneLanguages=mysqli_fetch_assoc($langTable)){
  echo '<a style="margin: 5px;" href="?ln='.$oneLanguages['code'].'"><button class="btn btn-primary" >'.$oneLanguages['name'].'</button></a>';
 }
?>
<table class="table table-striped table-responsive">
    <tr>
        <th scope="col">N</th>
        <th scope="col">Название термина</th>
        <th scope="col">Код термина</th>
        <th scope="col">Код языка</th>
        <th scope="col" colspan="4">Действия</th>
    </tr>
<?php
$termsTable=mysqli_query($link,"SELECT * FROM vn_terms WHERE langCode='".$_GET['ln']."' GROUP BY id");
while($oneTerms=mysqli_fetch_assoc($termsTable)){
  echo '<tr><td>'.$oneTerms['id'].'</td>
  <td scope="row">'.$oneTerms['text'].'</td>
  <td>'.$oneTerms['code'].'</td>
  <td>'.$oneTerms['langCode'].'</td>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToEdit" value="'.$oneTerms['code'].'" />
  <input type="hidden" name="editPostValueLangCode" value="'.$oneTerms['langCode'].'" />
  <input type="hidden" name="editPostValueText" value="'.$oneTerms['text'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-pencil-square-o" style="color: green; cursor: pointer;" aria-hidden="true"></i>
  </td>
  </form>
  <td>
  <form action="" method="post">';
  if($oneTerms['id']!=1){
  echo '<input type="hidden" name="codeToUp" value="'.$oneTerms['id'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-up" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>';
  }
  echo '</form>
  <td>
  <form action="" method="post">';
  $termsListOrderCount=mysqli_query($link,"SELECT COUNT(text) AS total FROM vn_terms");
  $countOrder=mysqli_fetch_assoc($termsListOrderCount);
  if($oneTerms['id']<$countOrder['total']){
  echo '<input type="hidden" name="codeToDown" value="'.$oneTerms['id'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-arrow-down" style="color: blue; cursor: pointer;" aria-hidden="true"></i>
  </td>';
  }
  echo '</form>
  <td>
  <form action="" method="post">
  <input type="hidden" name="codeToDelete" value="'.$oneTerms['code'].'" />
  <i onclick="this.parentElement.submit()" class="fa fa-window-close" style="color: red; cursor: pointer;" aria-hidden="true"></i>
  </form>
  
  </td></tr>';
}
?>
</table>
</div>
<?php if(isset($_POST['codeToEdit'])):
$_SESSION['editCode']=$_POST['codeToEdit'];
$_SESSION['editPostValueText']=$_POST['editPostValueText'];
$_SESSION['editPostValueLangCode']=$_POST['editPostValueLangCode'];?>
<div class="col-6">
<h2>Редактирование термина</h2>
<form method="post" action=""/>
<!--// id code text langCode //-->
<table>
<tr>
  <td align="right">Код термина:</td>
  <td><input class="form-control" type="text" value="<?php echo $_POST['codeToEdit'];?>" name="editTermsCode" /></td>
</tr>
<!--name="newTermsName"-->

<!--name="newTermsLangCode"-->
<?php
    $langTable=mysqli_query($link, "SELECT code FROM vn_languages WHERE code='".$_POST['editPostValueLangCode']."' ");
    while ($oneLanguage=mysqli_fetch_assoc($langTable)) {
      echo '<tr><td align="right">Название термина ('.$oneLanguage['code'].')</td><td><input class="form-control" type="text" value="';
      $termsTable=mysqli_query($link, "SELECT * FROM vn_terms WHERE langCode='".$_POST['editPostValueLangCode']."' AND code='".$_POST['codeToEdit']."' ");
      while($oneTerm=mysqli_fetch_assoc($termsTable)){ 
          echo $oneTerm['text'];
      }
      echo '" name="editname_'.$_GET['ln'].'" /></td></tr>';
    }
?>
<tr>
    <td align="right"></td>
    <td><input class="btn btn-primary" type="submit" value="Редактировать"/></td>
</tr>
</table>
</form>
</div>
<?php else: ?>
<div class="col-6">
<h2>Добавление термина</h2>
<form name="myForm" method="post" action=""/>
<!--// id code text langCode //-->
<table>
<tr>
  <td align="right">Код термина:</td>
  <td><input class="form-control" type="text" name="newTermsCode" /></td>
</tr>
<!--name="newTermsName"-->

<!--name="newTermsLangCode"-->

    <!--// $langTable=mysqli_query($link, 'SELECT code FROM vn_languages ORDER BY listOrder');-->
    <!--// while ($oneLanguage=mysqli_fetch_assoc($langTable)) {-->
    <!--//   echo '<tr><td align="right">Название термина ('.$oneLanguage['code'].')</td><td><input class="form-control" type="text" name="name_'.$oneLanguage['code'].'" /></td></tr>';-->
    <!--// }-->
<tr>
    <td align="right">Название термина (<?php echo $_GET['ln'];?>)</td>
    <td><input class="form-control" type="text" name="name_<?php echo $_GET['ln']; ?>" /></td>
</tr>
<tr>
    <td align="right"></td>
    <td><input class="btn btn-primary" type="submit" value="Добавить"/></td>
</tr>
</table>
</form>
</div>
<?php endif; ?>