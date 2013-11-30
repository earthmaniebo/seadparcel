<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin | Billing Archives</title>
    <?php $page = "billing-archive" ?>
    <?php include "../include/headtags.php"; ?>
</head>
<body>
    <?php include "../include/nav-admin.php"; ?>
    <?php require_once "controller/adminController.php"; ?>

        <div class="row">
            <div class="col-md-12 col-md-offset-">
                        <h2  class="text-center">Billing Archive</h2>
                        <br>
                        <div class="container">
                        <center><div id="shipment">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">BILLING ID</th>
                                    <th class="text-center">SHIPMENT ID</th>
                                    <th class="text-center">FREIGHT CHARGE</th>
                                    <th class="text-center">ADDON CHARGE</th>
                                    <th class="text-center">CRATING CHARGE</th>
                                    <th class="text-center">OSA CHARGE</th>
                                    <th class="text-center">VALUATION CHARGE</th>
                                    <th class="text-center">TOTAL CHARGE</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php foreach($billingArchive as $row) { ?>
                            <tr>
                                <td><?php echo $row["billingID"];?></td>
                                <td><?php echo $row["shipmentID"];?></td>
                                <td><?php echo $row["freightCharge"];?></td>
                                <td><?php echo $row["addOnCharge"];?></td>
                                <td><?php echo $row["cratingCharge"];?></td>
                                <td><?php echo $row["osaCharge"];?></td>
                                <td><?php echo $row["valuationCharge"];?></td>
                                <td><?php echo $row["totalCharge"];?></td>
                            </tr>
                <?php } ?>
                        </tbody>
                    </table></div></center>
                    <br>
            </div>
        </div>
    <?php include "../include/bs-script.php"; ?>
</body>
</html>