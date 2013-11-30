<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin | Shipments Archive</title>
    <?php $page = "shipment-archive" ?>
    <?php include "../include/headtags.php"; ?>
</head>
<body>
    <?php include "../include/nav-admin.php"; ?>
    <?php require_once "controller/adminController.php"; ?>

        <div class="row">
            <div class="col-md-12 col-md-offset-">
                        <h2  class="text-center">Shipment Archive</h2>
                        <br>
                        <div style="padding-left:3px;">
                        <table class="table table-condensed table-bordered table-striped table-responsive text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">SHIPMENTID</th>
                                    <th class="text-center">CLIENTID</th>
                                    <th class="text-center">SEAD #</th>
                                    <th class="text-center">REF #</th>
                                    <th class="text-center">SHIPPERNAME</th>
                                    <th class="text-center">CONNAME</th>
                                    <th class="text-center">DESIGNATION</th>
                                    <th class="text-center">CONADDRESS</th>
                                    <th class="text-center">STATE</th>
                                    <th class="text-center">CONCONTACTNUM</th>
                                    <th class="text-center">PICKUPDATE</th>
                                    <th class="text-center">DESCRIPTION</th>
                                    <th class="text-center">TOTALWEIGHT</th>
                                    <th class="text-center">REMARKS</th>
                                    <th class="text-center">STATUS</th>
                                    <th class="text-center">HASPOD</th>
                                    <th class="text-center">HASBILLING</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php foreach($shipmentArchive as $row) { ?>
                            <tr>
                                <td><?php echo $row["shipmentID"];?></td>
                                <td><?php echo $row["clientID"];?></td>
                                <td><?php echo $row["seadawbnum"];?></td>
                                <td><?php echo $row["refNum"];?></td>
                                <td><?php echo $row["shipperName"];?></td>
                                <td><?php echo $row["conName"];?></td>
                                <td><?php echo $row["designation"];?></td>
                                <td><?php echo $row["conAddress"];?></td>
                                <td><?php echo $row["state"];?></td>
                                <td><?php echo $row["conContactNum"];?></td>
                                <td><?php echo $row["pickUpDate"];?></td>
                                <td><?php echo $row["descOfGoods"];?></td>
                                <td><?php echo $row["totalWeight"];?></td>
                                <td><?php echo $row["remarks"];?></td>
                                <td><?php echo $row["status"];?></td>
                                <td><?php echo $row["hasPod"];?></td>
                                <td><?php echo $row["hasBilling"];?></td>
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