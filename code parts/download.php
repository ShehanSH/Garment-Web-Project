<?php

@include 'config.php';

$id = $_POST['id'];


$select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
$select_orders->execute([$id]);
if ($select_orders->rowCount() > 0) {
    while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {

        $html = '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    
  
    
    
    .longwidth {
        width: 70%;
    }
    
    .shortwidth {
        width: 30%;
    }
    
    
    .details{
        margin-left: 50px;
        table-layout: fixed;
        width : 650px;
    }
    
   

    .tableorder{
        margin-left:50px;
        margin-top: 50px;
        width: 80%;
        border-collapse: collapse;
        border-style: hidden;
      }
    
     .orderth {
        padding: 0.5rem;
        border: 0.5px solid black;
      }
    
    footer{
        width: 70%;
    }
    
    .header{
        margin-top:0px;
        margin-left: 50px;
        font-size: 30px;
    }
    
    
    h1,h5{
        margin-bottom: 5px;
    }
    
    h4{
        text-align: right;
    }
    
    .signature{
        margin-right: 15%;
    }
    
    </style>
</head>

<body>
    <div class="header">
        <h1>SR Garment</h1>
        <h5>Invoice</h5>
        <hr>
    </div>

    <table class="details">
    <tr>
        <td style="width: 25%;">
        <h5>Name : </h5>
        </td>
        <td  style="width: 25%;"><h5>' . $fetch_orders['name'] . '</h5> </td>
        <td style="width: 25%;">
            <h5>Date :</h5>
        </td>
        <td style="width: 15%;"> <h5>' . date(" j-M-Y") . '</h5> </td>
    </tr>
    <tr>
        <td >
        <h5>Ship to : </h5>
        </td>
        <td><h5>' . $fetch_orders['address'] . '</h5>  </td>
        <td>
            <h5>Receipt Number:</h5>
        </td>
        <td ><h5>' . $fetch_orders['id'] . '</h5></td>
    </tr>
    <tr>
        <td>
        <h5>Telephone :</h5>
        </td>
        <td><h5>' . $fetch_orders['number'] . '</h5></td>
        <td>
            <h5>Receipt Date</h5>
        </td>
        <td><h5>' . $fetch_orders['placed_on'] . '</h5></td>
    </tr>
    <tr>
        <td>
             <h5>Email Address : </h5>
        </td>
        <td> <h5>' . $fetch_orders['email'] . '</h5> </td>
        <td>
            <h5>Payment Method : </h5>
        </td>
        <td><h5>' . $fetch_orders['method'] . '</h5></td>
    </tr>
</table>

<center>
    <table class="tableorder">
        <tr>
            <th class="orderth">Description</th>
            <th class="orderth">Price</th>
        </tr>
        <tr>
            <td class="orderth">' . $fetch_orders['total_products'] . '</td>
            <td class="orderth">' . $fetch_orders['total_price'] . '</td>
        </tr>
        <tr>
            <td class="orderth">
                <h3>Total Price</h3>
            </td>
            <td class="orderth">
                <h3>' . $fetch_orders['total_price'] . '</h3>
            </td>
        </tr>
    </table>
</center>
';
    }
} else {
    echo '<p class="empty">no orders placed yet!</p>';
}

$html .= '
<div id="footer">
        <h4 class="signature">Manager,</h4>
        <h4 class="signature">SR Garment</h4>
        <hr>
        <h4>Thank you for your Business</h4>
        <table>
            <tr>
                <td>
                    <h5>Termes & Conditions : </h5>
                </td>
                <td><h5>Kindly remember that the exchange of the items you purchase is done within 7 days.</h5></td>
            </tr>
            <tr>
                <td>
                </td>
                <td><h5>Any item which price tag has been removed will not be exchanged</h5></td>
            </tr>
            <tr>
                <td>
                    <h5>Phone : </h5>
                </td>
                <td> <h5> 077-7424088 </h5></td>
            </tr>
            <tr>
                <td>
                    <h5>Address :  </h5>
                </td>
                <td> <h5> No 17/2, Railway Station Road, Arasady, Batticaloa. </h5></td>
            </tr>
        </table>
    </div>

</body>

</html>
';

use Dompdf\Options;

require 'vendor/autoload.php';
$options = new Options();
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

use Dompdf\Dompdf;

if ($html !== false) {
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'portrait');

    ob_end_clean();

    $dompdf->render();

    $dompdf->stream("invoice.pdf", ["Attachment" => 0]);
}
