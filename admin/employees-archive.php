<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin | Employees Archive</title>
    <?php $page = "employees-archive" ?>
    <?php include "../include/headtags.php"; ?>
</head>
<body>
    <?php include "../include/nav-admin.php"; ?>
    <?php require_once "controller/adminController.php"; ?>

        <div class="row">
            <div class="col-md-12 col-md-offset-">
                        <h2  class="text-center">Employees Archive</h2>
                        <br>
                        <div class="container">
                        <center><div id="shipment">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">EMP ID</th>
                                    <th class="text-center">USERNAME</th>
                                    <th class="text-center">PASSWORD</th>
                                    <th class="text-center">LASTNAME</th>
                                    <th class="text-center">FIRSTNAME</th>
                                    <th class="text-center">MIDDLENAME</th>
                                    <th class="text-center">ADDRESS</th>
                                    <th class="text-center">POSITION</th>
                                    <th class="text-center">ISDELETED</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php foreach($empArchive as $row) { ?>
                            <tr>
                                <td><?php echo $row["empID"];?></td>
                                <td><?php echo $row["username"];?></td>
                                <td><?php echo $row["password"];?></td>
                                <td><?php echo $row["lastName"];?></td>
                                <td><?php echo $row["firstName"];?></td>
                                <td><?php echo $row["middleName"];?></td>
                                <td><?php echo $row["address"];?></td>
                                <td><?php echo $row["position"];?></td>
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