<?php
require_once "dbconnect.php";
$langTable=mysqli_query($link, "SELECT * FROM vn_languages WHERE listOrder>0 ORDER BY listOrder"); //для того чтобы в будущем использовать много раз
$languages=Array();
while($oneLang=mysqli_fetch_assoc($langTable)){
  //$languages[]=$oneLang;
  $languages[$oneLang['code']]=$oneLang;
  if(!isset($_GET['ln'])){$_GET['ln']=$oneLang['code'];}
}

$termTable=mysqli_query($link, "SELECT code,text FROM vn_terms WHERE langCode='".$_GET['ln']."'");
$terms=Array();
while ($oneTerm=mysqli_fetch_assoc($termTable)) {
  $terms[$oneTerm['code']]=$oneTerm['text'];
}

$entireTermTable = mysqli_query($link, "SELECT DISTINCT code FROM vn_terms");
$completeLang = array(); 
$uniqueTerms = mysqli_fetch_all($entireTermTable, MYSQLI_ASSOC);
foreach ($languages as $key => $val) {
    $currentLangTerms = mysqli_query($link, "SELECT COUNT(code) AS numOfCodes FROM vn_terms WHERE langCode='$key' ");
    $currentCount = mysqli_fetch_assoc($currentLangTerms);
    if ($currentCount['numOfCodes'] == count($uniqueTerms)) {
        $completeLang[$key] = $val['name'];
    }
}
//echo $languages[1]['name'];
//echo $languages['ru']['name'];
?>
