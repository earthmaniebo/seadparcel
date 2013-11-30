<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin | Clients Archive</title>
    <?php $page = "clients-archive" ?>
    <?php include "../include/headtags.php"; ?>
</head>
<body>
    <?php include "../include/nav-admin.php"; ?>
    <?php require_once "controller/adminController.php"; ?>

        <div class="row">
            <div class="col-md-12 col-md-offset-">
                        <h2  class="text-center">Clients Archive</h2>
                        <br>
                        <div class="container">
                        <center><div id="shipment">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">CLIENT ID</th>
                                    <th class="text-center">EMP ID</th>
                                    <th class="text-center">NAME</th>
                                    <th class="text-center">ADDRESS</th>
                                    <th class="text-center">CONTACT NUM</th>
                                    <th class="text-center">CONTACT PERSON</th>
                                    <th class="text-center">IS DELETED</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php foreach($clientArchive as $row) { ?>
                            <tr>
                                <td><?php echo $row["clientID"];?></td>
                                <td><?php echo $row["empID"];?></td>
                                <td><?php echo $row["name"];?></td>
                                <td><?php echo $row["address"];?></td>
                                <td><?php echo $row["contactNum"];?></td>
                                <td><?php echo $row["contactPerson"];?></td>
                                <td><?php echo $row["isDeleted"];?></td>
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