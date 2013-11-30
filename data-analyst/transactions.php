<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Data Analyst | My Transactions</title>
    <script type="text/javascript">
        function confirmDelete() {
            var test = confirm("Are you sure?");
            if (test == true)
                return true;

            else
                return false;
        }
    </script>
    <?php include "../include/headtags.php"; ?>
    <?php $page = "transactions" ?>
</head>
<body>
    <?php include "../include/nav-data-analyst.php"; ?>
    <div class="container">
        <?php require_once "controller/dataAnalystController.php"; ?>
        <div class="row">
            <div class="col-md-12">
                <h2>Transactions</h2>
                <hr>
                <?php if(isset($_SESSION["status"]) && $_SESSION["status"] == "updated") { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Transaction details was successfully updated.</strong>
                </div>
                <?php } else if($isDeleted) { ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Transaction details was successfully deleted.</strong>
                </div>
                <?php } unset($_SESSION["status"]); ?>
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <a class="btn btn-default" href="add-transaction.php"><span class="glyphicon glyphicon-plus-sign"></span> Add Transaction</a>
                        <form class="form-inline pull-right" role="form" action="transactions.php" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputSearch" placeholder="Search SEAD-AWB #" name="search">
                            </div>
                            <button type="submit" class="btn btn-default" name="searchButton">
                                <span class="glyphicon glyphicon-search"></span> Search
                            </button>
                        </form>
                        <div class="clearfix"></div> 
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th class="text-center">Shipment ID</th>
                                    <th class="text-center">SEAD-AWB #</th>
                                    <th class="text-center">Ref #</th>
                                    <th class="text-center">Company Name</th>
                                    <th class="text-center">Consignee's Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($selectMyShipment as $row) { ?>
                                <tr>
                                    <td class="shipment text-center"><?php echo $row["shipmentID"] ?></td>
                                    <td class="shipment text-center"><?php echo $row["seadawbnum"] ?></td>
                                    <td class="shipment text-center"><?php echo $row["refNum"] ?></td>
                                    <td class="shipment text-center"><?php echo $row["name"] ?></td>
                                    <td class="shipment text-center"><?php echo $row["conName"] ?></td>
                                    <td class="shipment text-center"><?php echo $row["descOfGoods"] ?></td>
                                    <td class="shipment text-center">
                                        <form action="edit-transaction.php" method="POST" style="display:inline;">
                                            <input type='hidden' name='shipmentID' value="<?php echo $row['shipmentID'] ?>">
                                            <button type="submit" class="btn btn-success btn-xs" name="edit" ><span class="glyphicon glyphicon-edit"></span> Edit</button>
                                        </form>
                                        <form action="transactions.php" method="POST" style="display:inline;">
                                            <input type='hidden' name='shipmentID' value="<?php echo $row['shipmentID'] ?>">
                                            <button type="submit" class="btn btn-danger btn-xs" name="delete"  onclick='return confirmDelete();'><span class="glyphicon glyphicon-trash"></span> Delete</button>
                                        </form>
                                        <form action="print-airwaybill.php" method="POST" style="display:inline;">
                                            <input type='hidden' name='hasBilling' value="<?php echo $row['hasBilling'] ?>">
                                            <input type='hidden' name='shipmentID' value="<?php echo $row['shipmentID'] ?>">
                                            <button type="submit" class="btn btn-info btn-xs" name="print" ><span class="glyphicon glyphicon-edit"></span> Print</button>
                                        </form>
                                        <!--<?php 
                                            //if($row["hasPod"] == "Y") {
                                        ?>
                                                <form action="edit-transaction.php" method="POST" style="display:inline;">
                                                    <input type='hidden' name='shipmentID' value="<?php //echo $row['shipmentID'] ?>">
                                                    <button type="submit" class="btn btn-warning btn-xs" name="edit" ><span class="glyphicon glyphicon-edit"></span> Edit</button>
                                                </form>|
                                        <?php
                                            //}

                                            //else if ($row["hasPod"] == "N") {
                                        ?>
                                                <form action="edit-transaction.php" method="POST" style="display:inline;">
                                                    <input type='hidden' name='shipmentID' value="<?php //echo $row['shipmentID'] ?>">
                                                    <button type="submit" class="btn btn-primary btn-xs" name="edit" ><span class="glyphicon glyphicon-edit"></span> Add</button>
                                                </form>|
                                        <?php
                                            //}

                                            //if($row["hasBilling"] == "Y") {
                                        ?>
                                                <form action="edit-transaction.php" method="POST" style="display:inline;">
                                                    <input type='hidden' name='shipmentID' value="<?php //echo $row['shipmentID'] ?>">
                                                    <button type="submit" class="btn btn-warning btn-xs" name="edit" ><span class="glyphicon glyphicon-edit"></span> Edit</button>
                                                </form>|
                                        <?php
                                            //}

                                            //else if($row["hasBilling"] == "N") {
                                        ?>
                                                <form action="edit-transaction.php" method="POST" style="display:inline;">
                                                    <input type='hidden' name='shipmentID' value="<?php //echo $row['shipmentID'] ?>">
                                                    <button type="submit" class="btn btn-primary btn-xs" name="edit" ><span class="glyphicon glyphicon-edit"></span> Add</button>
                                                </form>
                                        <?php
                                            //}
                                        ?>-->
                                    </td>
                                </tr>
                            </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include"../include/footer.php"; ?>
    <?php include "../include/bs-script.php"; ?>
</body>
</html>