<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin | Proof of Delivery Archives</title>
    <?php $page = "pod-archive" ?>
    <?php include "../include/headtags.php"; ?>
</head>
<body>
    <?php include "../include/nav-admin.php"; ?>
    <?php require_once "controller/adminController.php"; ?>

        <div class="row">
            <div class="col-md-12 col-md-offset-">
                        <h2  class="text-center">Proof of Delivery Archive</h2>
                        <br>
                        <div class="container">
                        <center><div id="shipment">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">POD ID</th>
                                    <th class="text-center">SHIPMENT ID</th>
                                    <th class="text-center">RECEIVED BY</th>
                                    <th class="text-center">DATE RECEIVED</th>
                                    <th class="text-center">TIME RECEIVED</th>
                                    <th class="text-center">RELATIONSHIP TO CONSIGNEE</th>
                                    <th class="text-center">REMARKS</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php foreach($podArchive as $row) { ?>
                            <tr>
                                <td><?php echo $row["podID"];?></td>
                                <td><?php echo $row["shipmentID"];?></td>
                                <td><?php echo $row["receivedBy"];?></td>
                                <td><?php echo $row["dateReceived"];?></td>
                                <td><?php echo $row["timeReceived"];?></td>
                                <td><?php echo $row["relToCon"];?></td>
                                <td><?php echo $row["remarks"];?></td>
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