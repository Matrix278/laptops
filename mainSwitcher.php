<?php
require "moduls/activity.php";
/*--- проверка присутствия и значений различных переменных в адресной строке ($_GET) -----*/
if(isset($_GET['item'])){
/*--------------- описание одного товара ----------------*/
include "moduls/oneItem.php";
}elseif(isset($_GET['category'])){
    if($_GET['category']=='sensorLaptops'){
     /*--------------- список товаров одной категории ----------------*/
     $title="".$categoryName['sensorLaptops']." | ".$terms['category']." | ".$terms['laptopsBrand']."";
        echo '<title>'.$title.'</title>';
     include "moduls/categoryLaptops.php";
    }elseif($_GET['category']=='homeLaptops'){
        $title="".$categoryName['homeLaptops']." | ".$terms['category']." | ".$terms['laptopsBrand']."";
        echo '<title>'.$title.'</title>';
     /*--------------- список товаров одной категории ----------------*/
     include "moduls/categoryLaptops.php";
    }elseif($_GET['category']=='businessLaptops'){
        $title="".$categoryName['businessLaptops']." | ".$terms['category']." | ".$terms['laptopsBrand']."";
        echo '<title>'.$title.'</title>';
     /*--------------- список товаров одной категории ----------------*/
     include "moduls/categoryLaptops.php";
    }elseif($_GET['category']=='mobileLaptops'){
        $title="".$categoryName['mobileLaptops']." | ".$terms['category']." | ".$terms['laptopsBrand']."";
        echo '<title>'.$title.'</title>';
     /*--------------- список товаров одной категории ----------------*/
     include "moduls/categoryLaptops.php";
    }elseif($_GET['category']=='gamingLaptops'){
        $title="".$categoryName['gamingLaptops']." | ".$terms['category']." | ".$terms['laptopsBrand']."";
        echo '<title>'.$title.'</title>';
     /*--------------- список товаров одной категории ----------------*/
     include "moduls/categoryLaptops.php";
    }else{
        include "moduls/categoryLaptops.php";
    }
}elseif(isset($_GET['search'])){
/*--------------- список результатов поиска ----------------*/
$title="".$terms['searchProduct']." | ".$terms['laptopsBrand']."";
    echo '<title>'.$title.'</title>';
include "moduls/search.php";
}elseif(isset($_GET['page'])){
  if($_GET['page']=='developer'){
    /*--------------- вывод списка категорий ----------------*/
    $title="".$terms['aboutDeveloper']." | ".$terms['laptopsBrand']."";
    echo '<title>'.$title.'</title>';
    include "moduls/developer.php";
  }elseif($_GET['page']=='about'){
    /*--------------- вывод страницы о сайте ----------------*/
    $title="".$terms['aboutUs']." | ".$terms['laptopsBrand']."";
    echo '<title>'.$title.'</title>';
    include "moduls/about.php";
  }elseif($_GET['page']=='contacts'){
    /*--------------- вывод страницы с контактами ----------------*/
    $title="".$terms['contacts']." | ".$terms['laptopsBrand']."";
    echo '<title>'.$title.'</title>';
    include "moduls/contacts.php";
  }elseif($_GET['page']=='products'){
    /*--------------- вывод страницы с товарами ----------------*/
    $title="".$terms['categoryAllLaptops']." | ".$terms['laptopsBrand']."";
    echo '<title>'.$title.'</title>';
    include "moduls/products.php";
  }elseif($_GET['page']=='productInfo'){
    /*--------------- вывод страницы с информацией о товаре ----------------*/
    $productId=$_SESSION['productID']=$_GET['id'];
    $productsTable=mysqli_query($link, "SELECT * FROM vn_products WHERE langCode = '$ln' AND code='$productId'"); //для того чтобы в будущем использовать много раз
    $products=Array();
    while($oneProduct=mysqli_fetch_assoc($productsTable)){
        $products[$oneProduct['code']]=$oneProduct;
        $title="".$oneProduct['name']." | ".$terms['products']." | ".$terms['laptopsBrand']."";
        echo '<title>'.$title.'</title>';
    }
    include "moduls/productInfo.php";
  }elseif($_GET['page']=='order'){
    /*--------------- вывод страницы с формой заказа ----------------*/
    $title="".$terms['orderProduct']." | ".$terms['products']." | ".$terms['laptopsBrand']."";
    echo '<title>'.$title.'</title>';
    include "moduls/order.php";
  }elseif($_GET['page']=='registration'){
    /*--------------- вывод страницы с формой регистрации ----------------*/
    $title="".$terms['registerNewAccount']." | ".$terms['registration']." | ".$terms['laptopsBrand']."";
    echo '<title>'.$title.'</title>';
    include "moduls/registration.php";
  }elseif($_GET['page']=='mailUser'){
    /*--------------- вывод страницы с отправкой письма ----------------*/
    $title="".$terms['registerNewAccount']." | ".$terms['registration']." | ".$terms['laptopsBrand']."";
    echo '<title>'.$title.'</title>';
    include "moduls/mailRegisteredUser.php";
  }elseif($_GET['page']=='verify'){
    /*--------------- вывод страницы с подтверждением эмейла ----------------*/
    $title="".$terms['verifyRegistration']." | ".$terms['registration']." | ".$terms['laptopsBrand']."";
    echo '<title>'.$title.'</title>';
    include "moduls/verify.php";
  }elseif($_GET['page']=='login'){
    /*--------------- вывод страницы с подтверждением эмейла ----------------*/
    $title="".$terms['loginToYourAccount']." | ".$terms['login']." | ".$terms['laptopsBrand']."";
    echo '<title>'.$title.'</title>';
    include "moduls/login.php";
  /*}elseif($_GET['page']=='arve'){
    /*--------------- вывод страницы с пользовательским соглашением ----------------
    echo '<div class="row justify-content-center">';
    echo '<iframe name="pdf" style="width: 50%; height: 700px;" src="https://method27.000webhostapp.com/laptops/moduls/pdf.php"></iframe/>';
    echo '</div>';*/
    //include "moduls/pdf.php";
  }elseif($_GET['page']=='wishlist'){
    /*--------------- вывод страницы с желаемыми товарами ----------------*/
    $title="".$terms['wishlist']." | ".$terms['laptopsBrand']."";
    echo '<title>'.$title.'</title>';
    include "moduls/wishlist.php";
  }else{

  }
}else{
/*--------------- то, что подключается по умолчанию --------------*/
/*--------------- стартовая страница ----------------*/
$title="".$terms['main']." | ".$terms['laptopsBrand']."";
echo '<title>'.$title.'</title>';
include "moduls/start.php";
}
?>
