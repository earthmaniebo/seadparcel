<?php
    ob_start();
    include("airwaybill.php");
    $content = ob_get_clean();
    require_once('../html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('L', 'A4','en', false, 'ISO-8859-15', array(5,5,0,0));
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('exemple.pdf');

?>