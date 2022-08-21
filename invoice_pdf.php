<?php
$logo=base64_encode(file_get_contents("./assets/imgs/logo.png"));
$mobile=base64_encode(file_get_contents("./assets/imgs/mobile.png"));
$email=base64_encode(file_get_contents("./assets/imgs/email.png"));
$address_glob=base64_encode(file_get_contents("./assets/imgs/address_glob.png"));
$heart=base64_encode(file_get_contents("./assets/imgs/heart.png"));
$sign=base64_encode(file_get_contents("./assets/imgs/sign.png"));
$footer=base64_encode(file_get_contents("./assets/imgs/footer.png"));


require_once("./app/Invoice.php");
$invoice_id=$_GET["invoice_id"];
$invoice=new Invoice();
$invoice_data=$invoice->get_invoice($invoice_id);

$invoice_date=strtotime($invoice_data["invoice_date"]);
$due_date=strtotime($invoice_data["invoice_due_date"]);
$total_bill=0;
function items_data(){
    global $invoice;
    global $invoice_id;
    global $total_bill;
    $invoice_items_data=$invoice->get_invoice_item($invoice_id);
    $string="";
   foreach($invoice_items_data as $item){
    $string.=
    '<tr>
        <td class="desc">
        '.$item[2].'
        </td>
        <td class="hr">
        '.$item[3].'
        </td>
        <td class="hr_rate">
        '.$item[4].'
        </td>
        <td class="amount">
        $'.$item[5].'
        </td>
    </tr>
    ';
    $total_bill+=intval($item[5]);
   }
   return $string;
}   
?>


<?php
require_once("./dompdf/vendor/autoload.php");
// reference the Dompdf namespace
use Dompdf\Adapter\CPDF;      
use Dompdf\Dompdf;
use Dompdf\Exception;
// instantiate and use the dompdf class
$dompdf = new DOMPDF();
//setting custom width and height for paper
$customPaper = array(0,0,950, 1329);
$dompdf->setPaper($customPaper);
$dompdf->loadHtml('<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Godesign</title>
    <style>   
    //Aperco Pro ------
    @font-face {
        font-family: "Apercu Pro";
        src: url("./fonts/aperco_font/ApercuPro-Light.eot");
        src: local("Apercu Pro Light"), local("./fonts/aperco_font/ApercuPro-Light"),
            url("./fonts/aperco_font/ApercuPro-Light.eot?#iefix") format("embedded-opentype"),
            url("./fonts/aperco_font/ApercuPro-Light.woff2") format("woff2"),
            url("./fonts/aperco_font/ApercuPro-Light.woff") format("woff"),
            url("./fonts/aperco_font/ApercuPro-Light.ttf") format("truetype");
        font-weight: 300;
        font-style: normal;
    }
    @font-face {
        font-family: "Apercu Pro";
        src: url("./fonts/aperco_font/ApercuPro-Medium.eot");
        src: local("Apercu Pro Medium"), local("ApercuPro-Medium"),
            url("./fonts/aperco_font/ApercuPro-Medium.eot?#iefix") format("embedded-opentype"),
            url("./fonts/aperco_font/ApercuPro-Medium.woff2") format("woff2"),
            url("./fonts/aperco_font/ApercuPro-Medium.woff") format("woff"),
            url("./fonts/aperco_font/ApercuPro-Medium.ttf") format("truetype");
        font-weight: 500;
        font-style: normal;
    }

    @font-face {
        font-family: "Apercu Pro";
        src: url("./fonts/aperco_font/ApercuPro-Black.eot");
        src: local("Apercu Pro Black"), local("ApercuPro-Black"),
            url("./fonts/aperco_font/ApercuPro-Black.eot?#iefix") format("embedded-opentype"),
            url("./fonts/aperco_font/ApercuPro-Black.woff2") format("woff2"),
            url("./fonts/aperco_font/ApercuPro-Black.woff") format("woff"),
            url("./fonts/aperco_font/ApercuPro-Black.ttf") format("truetype");
        font-weight: 900;
        font-style: normal;
    }
    
    @font-face {
        font-family: "Apercu Pro";
        src: url("./fonts/aperco_font/ApercuPro-Bold.eot");
        src: local("Apercu Pro Bold"), local("ApercuPro-Bold"),
            url("./fonts/aperco_font/ApercuPro-Bold.eot?#iefix") format("embedded-opentype"),
            url("./fonts/aperco_font/ApercuPro-Bold.woff2") format("woff2"),
            url("./fonts/aperco_font/ApercuPro-Bold.woff") format("woff"),
            url("./fonts/aperco_font/ApercuPro-Bold.ttf") format("truetype");
        font-weight: bold;
        font-style: normal;
    }
    @font-face {
        font-family: "Apercu Pro";
        src: url("./fonts/aperco_font/ApercuPro-Regular.eot");
        src: local("Apercu Pro Regular"), local("ApercuPro-Regular"),
            url("./fonts/aperco_font/ApercuPro-Regular.eot?#iefix") format("embedded-opentype"),
            url("./fonts/aperco_font/ApercuPro-Regular.woff2") format("woff2"),
            url("./fonts/aperco_font/ApercuPro-Regular.woff") format("woff"),
            url("./fonts/aperco_font/ApercuPro-Regular.ttf") format("truetype");
        font-weight: normal;
        font-style: normal;
    }
    body{
        font-family: "Apercu Pro", sans-serif;
        font-weight:300;
        line-height:100%;

    }
    .header .logo{
        width:6.7818cm;
        height:1.9941645833cm;
        float:left;
    }
    .header .logo img{
        object-fit:contain; 
    }
    .header .contacts-list{
        text-align:right;        
    }
    .header .contacts-list .contact{
        margin-bottom:8px;
    }
    .header .contacts-list .website{
        margin-right:0.18cm;
    }
    .header .contacts-list .contact .icon{
        margin-top:10cm;
    }
    .pdf-container{
        padding:87px 136px;
        margin:0cm;
        position:relative;
    }
    @page{
        padding:0cm;
        margin:0cm;
    }
    .hero-section{
        margin-top:2.4341666667cm;
    }
    .hero-section .right table{
        text-align:right;
        float:right;
        margin-top:11px;
    }
    .hero-section .left .invoice_date{
        margin-bottom:0.4519083333cm;
        font-weight:900;
        font-size:12px;
    }
    .hero-section .left .godesign_address{
        line-height:140%;
    }
    .hero-section .right .heading{
        color:#233269;
        font-weight:900;
        font-size: 18.6667px;
        padding-bottom:13.84px;
        border-bottom: 5.09px solid #233269;
        width: 187.81px;
    }
    .hero-section .right table tr .invoice_no{
        margin-left:44.7%;
        font-weight:700;
        font-size:12px;
        padding-top:19px;
        width: 187.81px;
        height:12px;
    }
    .client_details{
        margin-top:69.97px;
    }
    .client_details .heading td{
        font-weight: 900;
        font-size: 12px;
        padding-bottom:10px;
    }
    .client_details .client_company td{
        padding-bottom:10px;
    }
    .invoice_details{
        margin-top:44px;
    }
    .invoice_details thead{
        border-top:2px solid black;
        border-bottom:2px solid black;
        text-transform:uppercase;
        font-weight:900;
        font-size:12px;
    }
    .invoice_details thead tr th{
        text-align:center;
        padding:11px 0px;
    }
    .invoice_details thead tr .desc{
        width: 500.69px;
        text-align:left;
    }
      .invoice_details tbody tr .desc{
        text-align:left;
        width: 500.69px;
    }
    .invoice_details tbody tr td{
        text-align:center;
        vertical-align:center;
        padding:20px 20px 0px 0px;
    }
    .invoice_bottom{
        margin-top:100px;
    }
    .invoice_bottom_head tr .due_date{
        padding-left:16px;
    }
    .invoice_bottom_head tr th{
        font-size:12px;
        font-weight:900;
    }
    .invoice_bottom tbody tr .due_date{
        padding-top:15px;

    }
    .invoice_bottom thead,tbody tr td,th{
        padding-left:20px;
        vertical-align:center;
    }
    .invoice_bottom .invoice_bottom_body tr .thanks{
        vertical-align:top;
         padding-top:12px;
         width:450px;
    }
    .invoice_bottom invoice_bottom_head tr .thanks{
        width:450px; 
    }
    .invoice_bottom .invoice_bottom_body tr .thanks .sub_table tr td{
         vertical-align:top;
         padding-left:10px;
    }
    .invoice_bottom thead{
         border-bottom:1px solid #000;
    }
    .invoice_bottom thead tr th{
        text-align:left;
        padding:17px 0px;
    }
    .invoice_bottom thead tr .total_bill{
        text-align:center;
    }
    .invoice_bottom tbody tr .total_bill{
        text-align:center;
        padding-top:15px;
    }
    .invoice_bottom .invoice_bottom_body tr td{
       font-weight: 900;
        font-size: 18.6667px;
    }

    .account_details{
        margin-top:100px;
    }
    .account_details .account_head{
        border-bottom:1px solid black;
        padding-bottom:16px;
    }
    .account_details .account_head tr th{
        text-align:left;
    }
    .account_details .account_body tr td{
        padding-top:36px;
        font-size:18px;
        line-height:120%;
    }
    .account_details .account_body tr .right_account{
        text-align:right;
    }
    .account_details .account_body tr .right_account div{
       float:right;
    }

    .sign_table{
        margin-top:100px;
    }
    .sign_table{
        float:right;
    }
    .sign_table .sign_sub tr .text{
        font-size:18px;
        padding-top:20px;
        text-align:left;
        line-height:120%;
    }
    .sign_table .sign_sub tr .sign-image{
        border-bottom:1px solid black;
        padding-bottom:20px;
    }

    footer{
        position:fixed;
        bottom:0px;
        left:0px;
        right:0px;
    }
    .registration{
        text-align:center;
       margin-bottom:30px;
    }
    .footer{
        bottom:0px;
        left:0px;
        right:0px;
    }

    </style>
</head>
<body>
<footer>
<table class="registration" width="100%">
    <tr>
    <td>
     SECP Registration No. 0182457
    </td>
    </tr>
</table>
<img width="100%" class="footer" src="data:image;base64,'.$footer.'" alt="footer"/>
</footer>
    <div class="pdf-container">
        <table class="header" width="100%">
            <td class="logo">
                <img src="data:image;base64,'.$logo.'" alt="logo"/>
            </td>
            <td class="contacts-list">
                <div class="contact">
                    <span class="icon">
                        <img src="data:image;base64,'.$mobile.'" alt="mobile"/>
                    </span>
                    <span class="text">
                        +92(307) 607-7533
                    </span>
                </div>
                <div class="contact">
                    <span class="icon">
                        <img src="data:image;base64,'.$email.'" alt="mobile"/>
                    </span>
                    <span class="text">
                        info@godesign.pk
                    </span>
                </div>
                <div class="contact website">
                    <span class="icon">
                        <img src="data:image;base64,'.$address_glob.'" alt="mobile"/>
                    </span>
                    <span class="text">
                        www.godesign.pk
                    </span>
                </div>
            </td>
            </tr>
        </table>   

        <table class="hero-section" width="100%">
        <tr>
            <td class="left">
                <div class="invoice_date">'.date("d F, Y",$invoice_date).'</div>
                <div class="godesign_address">
                    Street 25, SEC-I-10/4 I-10,<br/>
                    Islamabad Capital Territory <br/>
                    44800 Pakistan
                </div>
            </td>
            <td class="right">
            <table>
            <tr>
                <td class="heading">
                    INVOICE
                </td>
            </tr>
            <tr>
                <td class="invoice_no">
                    Invoice No. GD-'.(($invoice_id%2000)+2000).'
                </td>
            </tr>
            <table>
            </td>
            </tr>
        </table>
        <table class="client_details">
            <tr class="heading">
            <td>Bill To</td>
            </tr>
            <tr class="client_name">
            <td>'.$invoice_data["invoice_receiver_name"].'</td>
            </tr>
            <tr class="client_company">
            <td>'.$invoice_data["invoice_receiver_company"].'</td>
            </tr>
            <tr class="client_street">
            <td>'.$invoice_data["invoice_receiver_street"].'</td>
            </tr>
            <tr class="client_address">
            <td>'.$invoice_data["invoice_receiver_city"].', '.$invoice_data["invoice_receiver_state"].', '.$invoice_data["invoice_receiver_country"].'</td>
            </tr>
            <tr class="client_zip">
            <td>'.$invoice_data["invoice_receiver_zip"].'</td>
            </tr>
        </table>
        
        <table class="invoice_details" width="100%">
            <thead>
                <tr>
                    <th class="desc">Description</th>
                    <th>Hours</th>
                    <th>Hourly Rate</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                '.items_data().'
            </tbody>
        </table>
        <table class="invoice_bottom" width="100%">
            <thead class="invoice_bottom_head">
                <tr>
                    <th class="thanks">
                    </th>
                    <th class="due_date">
                    DUE BY
                    </th>
                    <th  class="total_bill">
                    TOTAL DUE
                    </th>
                </tr>
            </thead>
            <tbody class="invoice_bottom_body">
                <tr>
                    <td class="thanks">
                        <table class="sub_table">
                            <tr>
                                <td class="heart">
                                    <img width="20" src="data:image;base64,'.$heart.'" alt="heart"/>
                                </td>
                                <td class="text">
                                    THANK YOU FOR YOUR BUSINESS. PLEASE DEPOSIT PAYMENT BY DUE DATE
                                </td>
                            </tr>   
                        </table>
                    </td>
                    <td class="due_date">
                        '.date("d F Y").'
                    </td>

                    <td class="total_bill">
                        $'.$total_bill.'
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="account_details" width="100%">
            <thead class="account_head">
                <tr>
                    <th>
                        BANK ACCOUNT DETAILS
                    </th>
                    <th>
                    </th>
                </tr>
            </thead>
            <tbody class="account_body">
            <tr>
                <td>
                    ACCOUNT NAME: GODESIGN TECHNOLOGIES LLP<br/>
                    BANK NAME: FAYSAL BANK LIMITED<br/>
                    ADDRESS: H#373 ST. 25 SEC-I-10/4 44800,<br/>
                    ISLAMABAD,PAKISTAN
                </td>
                <td class="right_account">
                    <div>
                        SWIFT/SORT/ROUTING CODE: FAYSPKKA<br/>
                        IBAN: PK87FAYS0169007000009395<br/>
                        BRANCH CODE: 0169<br/>
                        ACCOUNT NUMBER: 0169007000009395
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="sign_table" width="100%">
            <table class="sign_sub">
                <tr>
                    <td class="sign-image">
                        <img src="data:image;base64,'.$sign.'" alt="sign"/>
                    </td>
                </tr>
                <tr>
                    <td class="text">
                        Company Official Signature<br/>
                        Hafiz Muhammad Usman<br/>
                        Chief Technology Officer<br/>
                     </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>');

// (Optional) Setup the paper size and orientation
// $dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
if($_GET["mode"]=='d')
$dompdf->stream("invoice_godesign.pdf",array("Attachment"=>true));
else
$dompdf->stream("invoice_godesign.pdf",array("Attachment"=>false));