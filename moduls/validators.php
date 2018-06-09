<?php
require_once "dbconnect.php";
function testIt($testVariant, $paramName, $tableName){ // g1, g2
  //echo 'g1: $testVariant '.$testVariant.', $paramName '.$paramName.', $tableName '.$tableName;
  global $link; // g3
  if(isset($link)){
    //echo '<li>g3: доступ к $link присутствует</li>';
    if($link!==FALSE){
      //echo '<li>g3: доступ к Базе Данных присутствует</li>';
    }
  }else{
    //echo '<li>g3: нет доступа к $link</li>';
  }

  //---------------- применение ----------------
  //---------------- usage -------------------
  // if(testIt('ru', 'code,', 'vn_languages')){положительный}else{отрицательный}
  // if(testIt('2018-02-22', 'date', 'vn_news')){положительный}else{отрицательный}
  if(!empty($testVariant) && !empty($paramName) && !empty($tableName)){ // g4, g5, g6, g7, g8, g9, g10, g11, g12, g13, g14, g15, g16, g17, g18
    $variantsTable=mysqli_query($link,"SELECT $paramName FROM $tableName"); // g26, g27, g28
    $testRes=FALSE; // g29
    while($oneVariant=mysqli_fetch_assoc($variantsTable)){ //g30, g31, g32, g33
      if($oneVariant[$paramName]==$testVariant){
        $testRes=TRUE;
      }
    }
    return $testRes;
  }else{
    return FALSE; //g19, g20, g21, g22, g23, g24, g25
  }
}

$test=testIt("", "text", "vn_terms"); //g5,
//echo '<h4>test g5, result: '.$test.'</h4>';
$test=testIt("next", "text", "vn_terms"); //g1. g2, g3, g6
//echo '<h4>test g1. g2, g3, g6, result: '.$test.'</h4>';
?>
