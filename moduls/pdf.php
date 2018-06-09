<?php
session_start();
//Нельзя делать интерфейсные части в этом php
require_once ('../TCPDF/tcpdf.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/SMTP.php';

if(isset($_POST['eMail']) && isset($_POST['userName']) && isset($_POST['userFamily']) && isset($_POST['adress']) && isset($_POST['city']) && isset($_POST['uezd']) && isset($_POST['postalCode'])){
$userEmail=$_POST['eMail'];
$userName=$_POST['userName'];
$userFamily=$_POST['userFamily'];
$userAdress=$_POST['adress'];
$userCity=$_POST['city'];
$userUezd=$_POST['uezd'];
$userZipCode=$_POST['postalCode'];

$pdfPage=new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdfPage->AddPage();
$pdfPage->SetFont('dejavusans', '', 14, '', true);
// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
$pdfPage->SetXY(20, 20);
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
$pdfPage->Image('../img/logo.png', 15, 15, 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);

//От кого
$pdfPage->MultiCell(80, 10, 'От кого: Мартин Сидоров TA-16V', 0, 'R', 0, 0, 110, 25, true);
//$pdfPage->MultiCell(50, 10, 'Harjumaa, Kehra', 0, 'R', 0, 0, 150, 32, true);
//$pdfPage->MultiCell(50, 10, 'Kooli 2, 74593', 0, 'R', 0, 0, 150, 39, true);

$pdfPage->Line(10, 60, 200, 60, '');

$pdfPage->Line(105, 10, 105, 100, '');

//Кому
$pdfPage->MultiCell(80, 10, 'Кому: '.$userName.' '.$userFamily, 0, 'L', 0, 0, 15, 70, true);
$pdfPage->MultiCell(60, 10, ''.$userUezd.', '.$userCity.', '.$userAdress.', '.$userZipCode.'', 0, 'L', 0, 0, 15, 77, true);
//$pdfPage->MultiCell(80, 10, 'Pärnu mnt 5, 71515', 0, 'L', 0, 0, 15, 84, true);

//Причина
$pdfPage->MultiCell(70, 10, 'Покупка ноутбуков', 0, 'R', 0, 0, 130, 70, true);

//n|code|nimi|kogus|hind|Al|Summa
//Summa
//Maks
//Kokku
$tableCode='<table style ="border-collapse: collapse; width: 100%;>">';
$tableCode.='<tr>';
$tableCode.='<td style = " padding: 8px; text-align: left; border-bottom: 1px solid #ddd ">'.'№'.'</td>';
$tableCode.='<td style = " padding: 8px; text-align: left; border-bottom: 1px solid #ddd">'.'Name'.'</td>';
$tableCode.='<td style = " padding: 8px; text-align: left; border-bottom: 1px solid #ddd">'.'Quantity'.'</td>';
$tableCode.='<td style = " padding: 8px; text-align: left; border-bottom: 1px solid #ddd">'.'Price'.'</td>';
$tableCode.='<td style = " padding: 8px; text-align: left; border-bottom: 1px solid #ddd">'.'Summ'.'</td>';
$tableCode.='</tr>';

foreach ($_SESSION['wishlist'] as $itemNum => $itemInfo) {
    $total=0;
    
    if($itemNum < 4){
    $pdfPage->SetXY(17, 115);
    $tableCode.='<tr><td scope="row">'.($itemNum+1).'</td>';
    // $tableCode.='<td style = " padding: 8px; text-align: left; border-bottom: 1px solid #ddd">'."$itemNum+1".'</td>';
    $tableCode.='<td style = " padding: 8px; text-align: left; border-bottom: 1px solid #ddd">'.$itemInfo['name'].'</td>';
    $tableCode.='<td style = " padding: 8px; text-align: left; border-bottom: 1px solid #ddd">'.$itemInfo['quantity'].'</td>';
    $tableCode.='<td style = " padding: 8px; text-align: left; border-bottom: 1px solid #ddd">'.$itemInfo['price'].'</td>';
    $tableCode.='<td style = " padding: 8px; text-align: left; border-bottom: 1px solid #ddd">'.(float)$itemInfo['price']*(float)$itemInfo['quantity'].'€</td>';
    // $tableCode.=$total+=(float)$itemInfo['price']*(float)$itemInfo['quantity'];
    $tableCode.='</tr>';
    }
  //}
    if($itemNum > 4){
    $pdfPage->AddPage();
    $pdfPage->SetXY(17, 17);
    $tableCode.='<tr><td scope="row">'.($itemNum+1).'</td>';
    // $tableCode.='<td style = " padding: 8px; text-align: left; border-bottom: 1px solid #ddd">'."$itemNum+1".'</td>';
    $tableCode.='<td style = " padding: 8px; text-align: left; border-bottom: 1px solid #ddd">'.$itemInfo['name'].'</td>';
    $tableCode.='<td style = " padding: 8px; text-align: left; border-bottom: 1px solid #ddd">'.$itemInfo['quantity'].'</td>';
    $tableCode.='<td style = " padding: 8px; text-align: left; border-bottom: 1px solid #ddd">'.$itemInfo['price'].'</td>';
    $tableCode.='<td style = " padding: 8px; text-align: left; border-bottom: 1px solid #ddd">'.(float)$itemInfo['price']*(float)$itemInfo['quantity'].'€</td>';
    // $tableCode.=$total+=(float)$itemInfo['price']*(float)$itemInfo['quantity'];
    $tableCode.='</tr>';
    }
  }
    $tableCode.='<tr>';
    $tableCode.='<td>'.''.'</td>';
    $tableCode.='<td>'.''.'</td>';
    $tableCode.='<td>'.''.'</td>';
    $tableCode.='<td>'.'TOTAL: '.'</td>';
    $tableCode.='<td>'.$_SESSION['totalWishlist'].'€</td>';
    $tableCode.='</tr>';

$tableCode.='</table>';


// $pdfPage->SetXY(17, 115);
$pdfPage->writeHTML($tableCode, true, 0, true, 0);

$pdfPage->Line(200, 240, 10, 240, '');

$pdfPage->MultiCell(40, 10, 'Kehra, Kooli 2, 74593, Harjumaa', 0, 'L', 0, 0, 15, 250, true);

$pdfPage->MultiCell(40, 10, 'Swedbank 31738295812', 0, 'L', 0, 0, 75, 250, true);

$pdfPage->MultiCell(80, 10, 'Telefon: 56217364', 0, 'L', 0, 0, 120, 250, true);
$pdfPage->MultiCell(90, 10, 'E-mail: martin.sidorov@tptlive.ee', 0, 'L', 0, 0, 120, 257, true);
$pdfPage->MultiCell(90, 10, 'Reg.nr. 12345678', 0, 'L', 0, 0, 120, 264, true);

$pdfFile = $pdfPage->Output('Arve_'.date('Y-m-d').'.pdf', 'S');
}

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {

    //Recipients
    if(isset($_POST['eMail']) && isset($_POST['userName'])){
    $mail->setFrom('martin@laptops.ee', 'Laptops');
    $mail->addAddress($userEmail, $userName);     // Add a recipient
    }
    //Attachments
    $mail->addStringAttachment($pdfFile, 'Arve_'.date('Y-m-d').'.pdf');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Your wishlist from our website';
    $mail->Body    = '<h3>Wishlist of products</h3>';
    $mail->AltBody = 'Wishlist of products';
    echo '<div class="container">
    <div class="row justify-content-center">
    <div class="col">
    <div class="card">';
    $mail->send();
    echo '<h1>Вам на почту отправили ваш список желаемых товаров</h1><br>';
} catch (Exception $e) {
    echo '<h1>Ошибка: Письмо не было отправлено: </h1><br>', $mail->ErrorInfo;
}
echo '<br><a class="btn btn-primary" href="https://method27.000webhostapp.com/laptops/?ln=et&page=wishlist">Вернуться на сайт</a>
</div>
</div>
</div>
</div>';
?>
<head>
<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css" />
</head>
<script language="javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
<script language="javascript" src="../js/popper.min.js"></script>
<script language="javascript" src="../js/bootstrap.min.js"></script>