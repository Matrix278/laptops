<?php
//session_start();
if(isset($_POST['nToDelete'])){
  unset($_SESSION['wishlist'][$_POST['nToDelete']]);
  array_multisort($_SESSION['wishlist']);
}

if(isset($_POST['code']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity'])){
$task=true;
    $result = null;
if(isset($_SESSION['wishlist'])){
foreach($_SESSION['wishlist'] as $itemNum=>$val )
{
    /*
    echo "<pre>";
    echo count($_SESSION['bookmarks']);
    echo print_r($_SESSION['bookmarks']);
     echo "</pre>";
     */
    if(isset($_POST['name'])){
    if($val['name'] == $_POST['name'])
    {
       print($itemNum);
        $_SESSION['wishlist'][$itemNum]['quantity']+=$_POST['quantity'];
        $result = $val;
         $task=false;
         break;
    }
    }
}
    if($_SESSION['wishlist']==""){
if($result == null)
{
    $result = $_SESSION['wishlist'][0];
}

    }
}
   if($task==true){
    if(isset($_POST['name'])){
    if(isset($_SESSION['wishlist'])){ //если вторая закладка
         $testArr=Array(); 
    
    $testArr['name']=$_POST['name'];
    $testArr['price']=$_POST['price'];
    $testArr['code']=$_POST['code'];
    $testArr['quantity']=$_POST['quantity'];
        
   
    
    array_push($_SESSION['wishlist'],$testArr);
        
    }else{ //если закладка еще не делалась
         $_SESSION['wishlist']=Array();
    $_SESSION['wishlist'][0]=Array();
        $_SESSION['wishlist'][0]['name']=$_POST['name'];
        $_SESSION['wishlist'][0]['price']=$_POST['price'];
        $_SESSION['wishlist'][0]['code']=$_POST['code'];
        $_SESSION['wishlist'][0]['quantity']=$_POST['quantity'];
    }
    }

   }
}
#print_r($_SESSION);
//echo "<br>"."<br>".$_SESSION['wishlist'][0]['id'].' '.$_SESSION['wishlist'][0]['name'].' //'.$_SESSION['wishlist'][0]['price'].' '.$_SESSION['wishlist'][0]['quantity'].' //'/*.$_SESSION['wishlist'][0]['link']*/;


echo '<div class="row justify-content-center">
    <div class="col-10 card">
    <table class="table-responsive">
    <tr>
      <th scope="col">#</th>
      <th scope="col">'.$terms['productName'].'</th>
      <th scope="col">'.$terms['quantity'].'</th>
      <th scope="col">'.$terms['price'].'</th>
      <th scope="col">'.$terms['summ'].'</th>
      <th scope="col">'.$terms['deleteProductWishlist'].'</th>
    </tr>';

  if(isset($_SESSION['wishlist'])){
    $total=0;
  foreach ($_SESSION['wishlist'] as $itemNum => $itemInfo) {
    /*if($itemInfo['code']==$testArr['code']){
            $itemInfo['quantity']++;
    }else{*/
    echo '<tr><td scope="row">'.($itemNum+1).'</td>';
    // $sqlProductName=mysqli_query($link, "SELECT code, name FROM vn_products WHERE name LIKE "%$itemInfo['name']%" ");
    echo '<td><a href="?ln='.$ln.'&page=productInfo&id='.$itemInfo['code'].'">'.$itemInfo['name'].'</a></td>';
    echo '<td>'.$itemInfo['quantity'].'</td>
        <td>'.$itemInfo['price'].'</td>
        <td>'.(float)$itemInfo['price']*(float)$itemInfo['quantity'].'€'.'</td>
        <td><form action="" method="post">
        <input style=" background-color: red; color: white;" type="submit" value="X" />
        <input type="hidden" name="nToDelete" value="'.$itemNum.'" /></form></td>
        </tr>';
    $total+=(float)$itemInfo['price']*(float)$itemInfo['quantity'];
  //}
  }
  $_SESSION['totalWishlist']=$total;
  echo '<tr><td colspan="6">'.$terms['total'].': '.$total.'€'.'</td></tr>';
}
echo '</table>';
echo '<a class="text-center" href="?ln='.$ln.'&page=products">
    <button type="button" class="btn btn-primary" style="margin: 10px">'.$terms['returnToProducts'].'</button>
    </a>';
    echo'<a class="text-center" href="?ln='.$ln.'&page=order"><button type="button" class="btn btn-primary" style="margin: 10px;">'.$terms['orderProduct'].'</button></a>';
echo '</div>
</div>';
?>