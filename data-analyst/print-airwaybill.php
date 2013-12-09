<?php
    ob_start();
    include("airwaybill.php");
    $content = ob_get_clean();
    require_once('../html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('L', 'A4','en');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('exemple.pdf');

?>