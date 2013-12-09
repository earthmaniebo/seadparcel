<?php if(isset($_POST["shipmentID"])) { ?>
<style type="text/css">
<!--
body {
    color: black;
    padding-top: 40px;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 14px;
    line-height: 1.428571429;
}

*, *:before, *:after {
    box-sizing: border-box;
}

div {
    display: block;
}

.paper {
    width: 939px;
    height: 610px;
    margin: 0px auto;
    padding-top: 21.5px;
    background:url(../img/awb.png);
    background-size:939px 610px;
    background-repeat:no-repeat;
    z-index: -1;
}

.shipperNameAddress {
    position: absolute;
    margin: 75px 0 0 590px;
    padding: 10px;
    width: 334px;
    height: 77px;
    word-wrap: break-word;  
}


.fCharge {
    position: absolute;
    margin: 242px 0 0 101px;
    padding: 6px 3px 0 0;
    width: 89px;
    height: 24px;   
}

.addOnCharge {
    position: absolute;
    margin: 268px 0 0 103px;
    padding: 6px 3px 0 2px;
    width: 86px;
    height: 25px; 
}

.odaCharge {
    position: absolute;
    margin: 293px 0 0 80px;
    padding: 6px 3px 0 2px;
    width: 110px;
    height: 27px;  
}

.valuationCharge {
    position: absolute;
    margin: 471px 0 0 72px;
    padding: 6px 3px 0 2px;
    width: 119px;
    height: 27px;  
    
}

.cratingCharge {
    position: absolute;
    margin: 496px 0 0 116px;
    padding: 6px 3px 0 2px;
    width: 74px;
    height: 26px;  
}

.conNameAddress {
    position: absolute;
    margin: 210px 0 0 590px;
    padding: 10px;
    width: 333px;
    height: 145px;     
}

.conContact {
    position: absolute;
    margin: 360px 0 0 660px;
    padding: 4px 3px 0 0;
    width: 263px;
    height: 28px;
}

.nature {
    position: absolute;
    margin: 414px 0 0 590px;
    padding: 10px;
    width: 333px;
    height: 107px;
}

.totalCharge {
    position: absolute;
    margin: 527px 0 0 80px;
    padding: 5px 0 0 5px;
    width: 94px;
    height: 30px;
    text-align: center;
}

.shipperName {
    position: absolute;
    margin: 527px 0 0 280px;
    padding: 5px 0 0 5px;
    width: 210px;
    height: 30px;
}

.date {
    position: absolute;
    margin: 527 0 0 635px;
    padding: 5px 0 0 5px;
    width: 110px;
    height: 30px;
    font-weight: bold;
}
-->
</style>
<page>
<body>
    <?php session_start(); ?>
    <?php $page = 'airwaybill'; ?>
    <?php require_once "controller/dataAnalystController.php";?>
    <div class="paper">
        <div class="shipperNameAddress"><?php echo $data["shipperName"]?></div> 
            <div class="fCharge"><?php if($hasBilling == "Y") { echo $data["freightCharge"]; }?></div>
            <div class="conNameAddress"><?php echo $data["conName"]?><br><?php echo $data["conAddress"]?></div>
            <div class="addOnCharge"><?php if($hasBilling == "Y") { echo $data["addOnCharge"]; }?></div>
            <div class="odaCharge"><?php if($hasBilling == "Y") { echo $data["osaCharge"]; }?></div>
            <div class="valuationCharge"><?php if($hasBilling == "Y") { echo $data["valuationCharge"]; }?></div>
            <div class="cratingCharge"><?php if($hasBilling == "Y") { echo $data["cratingCharge"]; }?></div>

            <div class="conNameAddress"><?php echo $data["conName"]?><br><?php echo $data["conAddress"]?></div>
            <div class="conContact">
                <?php echo $data["conContactNum"]?>
            </div>
            <div class="nature"><?php echo $data["descOfGoods"]?></div>

        
            <div class="totalCharge"><?php if($hasBilling == "Y") { echo $data["totalCharge"]; }?></div>
            <div class="shipperName"><?php echo $_SESSION["firstName"] . " " . $_SESSION["lastName"]?></div>
            <div class="date"><?php echo $data["pickUpDate"]?></div>
 
    </div>
</body>
</page>
<?php } else { header("Location: transactions.php"); } ?>