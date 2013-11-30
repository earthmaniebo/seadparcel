<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin | Audit Trail Reports</title>
    <?php include "../include/headtags.php"; ?>
    <?php $page = "audit-trail" ?>
</head>
<body>
    <?php include "../include/nav-admin.php"; ?>
    <div class="container">
        <?php require_once "controller/adminController.php"; ?>
        <div class="row">
            <div class="col-md-12 col-md-offset-">
                <h2  class="text-center">Audit Trail Reports</h2>
                <br/>
                <a class="btn btn-primary" text-align='right' href="download-audit-trail.php">Download</a>
                <br><br>
                <table class="table table-hover table-condensed table-bordered text-center">
                    <thead>
                        <tr>
                            <th class="text-center">ACTOR</th>
                            <th class="text-center">ACTION</th>
                            <th class="text-center">DATE AND TIME</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($selectAudit as $row) { ?>
                        <tr>
                            <td><?php echo $row["firstName"]." ". $row["lastName"];?></td>
                            <td><?php echo $row["action"];?></td>
                            <td><?php echo $row["dateNtime"];?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include "../include/bs-script.php"; ?>
</body>
</html>