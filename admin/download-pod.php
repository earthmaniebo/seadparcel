<?php
    session_start();
    if(isset($_POST["content"]))
    {
        $client = "N/A";
        if($_POST["client"] != 'DEFAUL') {
            $client = $_POST["client"];
        }
        $header = "<style>td{padding: 0 20px 0 20px; text-align:center;} th{text-align:center;}</style><p><strong>Sead Parcel Services</strong><br>4113 Kalayaan Avenue<br>
Brgy Olympia<br>
Makati City<br>
</p><h1 text-align='center'>Proof of Delivery Reports of Sead Parcel Services</h1><p text-align='center'><strong>Client: </strong>".$client."<br><strong>From:</strong> ". $_POST["fromDate"] . " <strong>To:</strong> ". $_POST["toDate"] . "</p><br><br>";

        $footer = "<br><p style='margin: 0 0 0 862px'><strong>Printed by:</strong> " . $_SESSION["firstName"] . " " . $_SESSION["lastName"] . "</p>";
        $content = $header . $_POST["content"] . $footer;
        require_once('../html2pdf/html2pdf.class.php');
        $html2pdf = new HTML2PDF('L','A4','fr');
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('exemple.pdf');
    }

    else {
        header("Location: pod.php");
    }
?>