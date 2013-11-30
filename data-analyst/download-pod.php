<?php
    session_start();
    if(isset($_POST["content"]))
    {
        $client = "N/A";
        if($_POST["client"] != 'DEFAUL') {
            $client = $_POST["client"];
        }
        $header = "<style>td{padding: 0 20px 0 20px; text-align:center;} th{text-align:center;}</style><h1 text-align='center'>Proof of Delivery Reports of Sead Parcel Services</h1><p text-align='center'><strong>Client: </strong>".$client."<br><strong>From:</strong> ". $_POST["fromDate"] . " <strong>To:</strong> ". $_POST["toDate"] . "<br><strong>Printed by:</strong> " . $_SESSION["firstName"] . " " . $_SESSION["lastName"]."</p><br><br>";
        
        $content = $header . $_POST["content"];
        require_once('../html2pdf/html2pdf.class.php');
        $html2pdf = new HTML2PDF('L','A4','fr');
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('exemple.pdf');
    }

    else {
        header("Location: pod.php");
    }
?>