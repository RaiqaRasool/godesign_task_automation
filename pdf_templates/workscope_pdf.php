<?php
$logo = base64_encode(file_get_contents("./imgs/logo.png"));
$mobile = base64_encode(file_get_contents("./imgs/mobile.png"));
$email = base64_encode(file_get_contents("./imgs/email.png"));
$address_glob = base64_encode(file_get_contents("./imgs/address_glob.png"));
$heart = base64_encode(file_get_contents("./imgs/heart.png"));
$sign = base64_encode(file_get_contents("./imgs/sign.jpg"));
$footer = base64_encode(file_get_contents("./imgs/footer.png"));


require_once("../app/Workscope.php");
require_once("./data.php");
$workscope_id = $_GET["id"];
$workscope = new Workscope();
$workscope_data = $workscope->search_by_id('workscope', 'workscope_id', $workscope_id);

$workscope_date = strtotime($workscope_data["workscope_date"]);

function initial_amount_cal()
{
    global $workscope_data;
    $total_amt = $workscope_data['workscope_totalCost'];
    $percent = $workscope_data['workscope_initialAmtPercent'];
    return ceil($total_amt * ($percent / 100));
}
function remaining_amount_cal()
{
    global $workscope_data;
    return $workscope_data['workscope_totalCost'] - initial_amount_cal();
}


require_once("./dompdf/vendor/autoload.php");
// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;
// instantiate and use the dompdf class
$options = new Options();
$options->set('defaultFont', 'Helvetica');
$dompdf = new Dompdf($options);
$dompdf->loadHtml('<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Godesign</title>
    <style>   
    body{
        
        font-weight:400;
        line-height:100%;
        font-size:14px;
    }
    *{
        padding:0px;
        margin:0px;
        box-sizing:border-box;
    }
    .header .logo img{
        width:60%;
    }
    .header{
        vertical-align:top;
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
        float:right;
        display:flex;
        line-height:65%;
    }
    .header .contacts-list .contact{
        text-align:center;
        vertical-align:middle;
    }
    .header .contacts-list .contact .text{
        font-size:11px;
    }
    .header .contacts-list .contact .icon img{
        width:50%;
        margin-top:1px;
    }
    .pdf-container{
        padding:50px;
        margin:0cm;
        position:relative;
    }
    @page{
        padding:0cm;
        margin:0cm;
    }
    .hero-section{
        margin-top:20px;
        font-size:12px;
    }
    .hero-section .right table{
        text-align:right;
        float:right;
        margin-top:5px;
    }
    .hero-section .left{
        padding:0px;
    }
    .hero-section .left .invoice_date{
        margin-bottom:0.4519083333cm;
        font-weight:900;
    }
    .hero-section .left .godesign_address{
        line-height:140%;
    }
    .hero-section .right .heading{
        color:#233269;
        font-weight:900;
        font-size:18.667px;
        padding-bottom:8px;
        border-bottom: 5.09px solid #233269;
        width: 187.81px;
    }
    .hero-section .right table tr .invoice_no{
        margin-left:44.7%;
        font-weight:700;
        padding-top:10px;
        width: 187.81px;
        height:12px;
    }
    .client_details{
        margin-top:20px;
        font-size:12px;
    }
    .client_details tr td{
    padding:0px;
    }
    .client_details .client_company td{
        padding-bottom:10px;
    }
    .workscope_title{
        margin-top:40px;
        margin-bottom:15px;
        font-weight:900;
    }
    .workscope_details{
        width:100%;
        margin-top:24px;
        line-height:15px;
    }
    .workscope_details,.workscope_details tr td{
        border: 1px solid black;
        border-collapse: collapse;
    }
    .workscope_details tr td{
        padding:6px 10px 6px 10px;
        vertical-align:top;
    }
    .workscope_details .workscope_scope,.workscope_notes ol,ul
    {
        margin-left:10px;
        list-style-position:inside;
    }
    .workscope_details tr td:first-child{
        width:75%;
    }
    .workscope_details .workscope_scope p,.workscope_notes p{
        display:table;
        margin-bottom:5px;
        width:100%;  
    }
    .workscope_details .workscope_scope ol,ul li{
        display:table;
        margin-bottom:5px;
        width:100%;
    }
    .workscope_scope ol li ol li,
    .workscope_scope ol li ul li, .workscope_scope ul li ol li,
    .workscope_scope ul li ul li{
        margin-left:25px;
        list-style-position:inside;
    }
    .workscope_pricing,.workscope_pricing tr td{
        border: 0px;
        padding:0px;
    }

    .account_details{
        font-size:11px;
        left:50px;
        right:50px;
        width:100%;
        bottom:290px;
        margin-top:50px;
        padding-left:50px;
        padding-right:50px;
        padding-bottom:50px;
    }
    .account_details .account_head{
        border-bottom:1px solid black;
        padding-bottom:2px;
    }
    .account_details .account_head tr th{
        text-align:left;
    }
    .account_details .account_body tr td{
        padding-top:10px;
        line-height:120%;
        text-transform:uppercase;
    }
    .account_details .account_body tr .right_account div{
       float:right;
       padding-right:40px;
    }
    footer{
        position:fixed;
        bottom:0px;
        left:0px;
        right:0px;
    }
    .registration{
        text-align:center;
       margin-bottom:8px;
       font-size:16px;
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
        ACCOUNT NAME: <b>' . $gd_accountName . '</b><br/>
        BANK NAME: ' . $gd_bankName . '<br/>
        ADDRESS: ' . $gd_bankStreet . ' ' . $gd_bankPostal . ',<br/>
        ' . $gd_bankCity . ',' . $gd_bankCountry . '
    </td>
    <td class="right_account">
        <div>
            SWIFT/SORT/ROUTING CODE: ' . $gd_bankSwiftCode . '<br/>
            IBAN: ' . $gd_bankIBAN . '<br/>
            BRANCH CODE: ' . $gd_bankBranchCode . '<br/>
            ACCOUNT NUMBER: ' . $gd_bankAccountNumber . '
        </div>
    </td>
</tr>
</tbody>
</table>
<table class="registration" width="100%">
    <tr>
    <td>
     SECP Registration No. ' . $gd_registrationNo . '
    </td>
    </tr>
</table>
<img width="100%" class="footer" src="data:image;base64,' . $footer . '" alt="footer"/>
</footer>
    <div class="pdf-container">
        <table class="header" width="100%">
            <td class="logo">
                <img src="data:image;base64,' . $logo . '" alt="logo"/>
            </td>
            <td class="contacts-list">
                <table class="contact">
                    <tr>
                        <td class="icon">
                            <img src="data:image;base64,' . $mobile . '" alt="mobile"/>
                        </td>
                        <td class="text">
                            ' . $gd_phone . '
                        </td>
                    </tr>
                </table>
                <table class="contact">
                    <tr>
                        <td class="icon">
                            <img src="data:image;base64,' . $email . '" alt="mobile"/>
                        </td>
                        <td class="text">
                            ' . $gd_email . '
                        </td>
                    </tr>
                </table>
                <table class="contact website">
                    <tr>
                        <td class="icon">
                            <img src="data:image;base64,' . $address_glob . '" alt="mobile"/>
                        </td>
                        <td class="text">
                            ' . $gd_website . '
                        </td>
                    </tr>
                </table>
            </td>
            </tr>
        </table>   

        <table class="hero-section" width="100%">
        <tr>
            <td class="left">
                <div class="invoice_date">' . date("M j, Y", $workscope_date) . '</div>
                <div class="godesign_address">
                    ' . $gd_office . '<br/>
                    ' . $gd_street . ' <br/>
                    ' . $gd_city . ', ' . $gd_postalCode . ' ' . $gd_country . '
                </div>
            </td>
            </tr>
        </table>
        <table class="client_details">
            <tr>
            <td>To,</td>
            </tr>
            <tr class="client_name">
            <td>' . $workscope_data["workscope_client"] . '</td>
            </tr>
            <tr class="client_address">
            <td>' . $workscope_data["workscope_company"] . ', ' . $workscope_data["workscope_city"] . '</td>
            </tr>
        </table>
        <table class="workscope_title">
            <tr>
            <td>Subject: Scope of Work - ' . $workscope_data['workscope_company'] . '</td>
            </tr>
        </table>
        <table class="workscope_desc">
            <tr>
                <td>
                Thank you for considering GoDesign Technologies for your project needs. We are pleased to provide you with our proposal and price for your project. Please find it below.
                </td>
            </tr>
        </table>
        <table class="workscope_details">
            <tr>
                <td class="workscope_scope">
                    ' . $workscope->content_preparation(htmlspecialchars_decode($workscope_data['workscope_scope'])) . '
                </td>
                <td class="workscope_notes">
                    ' . $workscope->content_preparation(htmlspecialchars_decode($workscope_data['workscope_notes'])) . '
                </td>
            </tr>
            <tr class="workscope_pricing">
                <td>
                    <table>
                            <tr>
                                <td>
                                Total Cost
                                </td>
                            </tr>
                            <tr>
                                <td>
                                Initial Deposit
                                </td>
                            </tr>
                            <tr>
                                <td>
                                Remaining Payment
                                </td>
                            </tr>
                    </table>
                </td>
                <td>
                    <table>
                            <tr>
                                <td>
                                Rs. ' . strval($workscope_data['workscope_totalCost']) . '/-
                                </td>
                            </tr>
                            <tr>
                                <td>
                                Rs. ' . strval(initial_amount_cal()) . '/-
                                </td>
                            </tr>
                            <tr>
                                <td>
                                Rs. ' . strval(remaining_amount_cal()) . '/-
                                </td>
                            </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>');

// $dompdf->loadHtml("hello" . strval($workscope_data['workscope_totalCost']));

// Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
if ($_GET["mode"] == 'd')
    $dompdf->stream("Workscope_" . $workscope_data['workscope_company'] . ".pdf", array("Attachment" => true));
else
    $dompdf->stream("Workscope_" . $workscope_data['workscope_company'] . ".pdf", array("Attachment" => false));
