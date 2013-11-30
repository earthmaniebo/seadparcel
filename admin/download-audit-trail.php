<?php
        include "../include/connection.php";
        $content = "
    <page>
        <style>
            td {
                padding: 0 60px 0 60px;
            }
        </style>
        <h1 text-align='center'>Audit Trail Reports</h1>
        <table border='1' text-align='center'>
                <thead>
                    <tr text-align='center'>
                        <th class='text-center'>ACTOR</th>
                        <th class='text-center'>ACTION</th>
                        <th class='text-center'>DATE AND TIME</th>
                    </tr>
                </thead>
                <tbody>
    ";

            $audittrail = mysql_query("SELECT * FROM audittrail JOIN employees ON employees.empID=audittrail.empID ORDER BY dateNtime");

            while ($row = mysql_fetch_array($audittrail))
            {

                $content.= '<tr text-align="center">
                    <td>'. $row["firstName"]." ". $row["lastName"] . '</td>
                    <td>'. $row["action"] .'</td>
                    <td>'. $row["dateNtime"].'</td>
                </tr>';
        
            }
        $content = $content . "</tbody></table></page>";
        require_once('../html2pdf/html2pdf.class.php');
        $html2pdf = new HTML2PDF('L','A4','fr');
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('exemple.pdf');
?>