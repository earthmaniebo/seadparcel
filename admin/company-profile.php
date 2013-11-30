<?php
    session_start();
    if(isset($_SESSION["admin"]))
    {
        $content = '<div style="margin: 40px 40px auto;"><img src="../img/logo2.png" style="width:420px; height:134px; margin-left: 120px;" /><p align="justify"><strong>SEAD PARCEL SERVICES</strong> is a full service in logistics firm with worldwide Courier and Freight Cargo services based in Manila, Philippines. We are an aggressive, organized, high professional field personnel and proactive goal. Our goal will always be provide safe,  on time and quality services to build customer partnership by “doing it right”  the first time.</p>

        <p align="justify">Furthermore, we are most reliable in courier services and freight cargo forwarding with immediate response time and very competitive rates.</p>

        <p align="justify">Having served big and small firms, we have a built reputation for speed and reliability while adhering to the specific needs of our customers.</p>

        <p align="justify">Our current clients have come to appreciate our honesty and work ethic with the help of our positively minded team of professionals that takes pride in providing the highest level of operational efficiency, integrity, high quality performance and customer responsive.</p>

        <p align="justify">With an eye of the future, we continually strive to improve communications with the courier and the forwarding industry to easily monitor shipments from port of origin until reach its final destination. We are equipped with the latest IT system to update our clients and monitor every shipment of the clients.</p>

        <p align="justify">With the experienced staff of our agents and counterparts around the world, we have intimate knowledge of local markets and conditions. We are ready to offer expert advice in every aspect of shipping and cargo handling operations ensuring your documents, parcels and cargo shipments reaches its destination on time.</p>

        <p align="justify">Our goal is to exceed our customers’ expectations by ensuring quality service and excellence performance in every aspect of our business. We do providing complete global logistics services and multi-model transportations for our customers.</p>

        <p align="justify">By placing emphasis on employee satisfaction, we will ensure our success in market leadership, shareholder value and most importantly, customer satisfaction service, reliability and quality service are the keystones on SEAD PARCEL SERVICES.</p></div>';
        require_once('../html2pdf/html2pdf.class.php');
        $html2pdf = new HTML2PDF('P','A4','fr');
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('exemple.pdf');
    }

    else {
        header("Location: ../login.php");
    }
?>