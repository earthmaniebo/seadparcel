<?php
    session_start();
    if(isset($_POST["content"]))
    {
        $total = (float)$_POST["total"];
            $vat = 0;
        if(isset($_POST["vat"])) {
            $vat = $total * .12;
        }

        $client = "N/A";
        if($_POST["client"] != 'DEFAUL') {
            $client = $_POST["client"];
        }
        
        $grandTotal = $total + $vat;
        $header = "<style>td{padding: 0 20px 0 20px; text-align:center;} th{text-align:center;}</style><h1 text-align='center'>Billing Reports of Sead Parcel Services</h1><p text-align='center'><strong>Client: </strong>".$client."<br><strong>From:</strong> ". $_POST["fromDate"] . " <strong>To:</strong> ". $_POST["toDate"] . "<br><strong>Printed by:</strong> " . $_SESSION["firstName"] . " " . $_SESSION["lastName"]."</p><br><br>";

        $table = "<table style='margin:50px 0 0 780px;'>";
        if(isset($_POST["vat"])) {
            $displayTotal = "<tr>
                                <td style='text-align:right;'>TOTAL</td>
                                <td style='text-align:right;'>".number_format($total, 2)."</td>
                            </tr>";

            $displayVat =   "<tr>
                                <td style='text-align:right;'>12% VAT</td>
                                <td style='text-align:right;'>".number_format($vat, 2)."</td>
                            </tr>";
        }

        else {
            $displayTotal = "";
            $displayVat = "";
        }

        $displayGrandTotal =        "<tr>
                            <td style='text-align:right;'>GRAND TOTAL</td>
                            <td style='text-align:right;'>".number_format($grandTotal, 2)."</td>
                        </tr>
                    </table>";

        $footer = $table . $displayTotal . $displayVat . $displayGrandTotal;
        $content = $header . $_POST["content"] . $footer;
        require_once('../html2pdf/html2pdf.class.php');
        $html2pdf = new HTML2PDF('L','A4','fr');
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('exemple.pdf');
    }

    else {
        header("Location: billing.php");
    }
?>