<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../include/headtags.php"; ?>
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript" >
        function InputVal() {
            var empID = document.getElementById('inputEmployee');
            var name = document.getElementById('inputCompName');
            var address = document.getElementById('inputAddress');
            var contactNum = document.getElementById('inputContactNum');
            var contactPerson = document.getElementById('inputContactPerson');
            
            if(empID.value == "" || name.value == "" || address.value == "" || contactNum.value == "" || contactPerson.value == "") {
                alert("Please fill in all the required fields.");
                return false;
            }

            var patt1 = /[^a-z,^A-Z,\s,.]|[0-9]/g;
            var result1 = patt1.test(contactPerson.value);
            if(result1) {
                alert("Numbers and specials characters are not allowed in Contact Person.");
                return false;
            }
        }
    </script>
    <title>Admin | Add Client</title>
    <?php $page = "add-client" ?>
</head>
<body>
    <?php include "../include/nav-admin.php"; ?>
    <div class="container">
        <?php require_once "controller/clientController.php"; ?>
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <h2>Add Client</h2>
                <hr>
                <?php if($isAddedClient) { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Client successfully added.</strong>
                </div>
                <?php } ?>
                <form class="form-horizontal" role="form" method="POST" action="add-client.php">
                    <div class="form-group">
                        <label for="inputEmployee" class="col-lg-3 control-label">Assigned Employee</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="empID" id="inputEmployee">
                                <option value="">--Name of Data Analyst--</option>
                                <?php foreach($selectDataAnalyst as $row) {?>
                                <option value="<?php echo $row['empID']?>"><?php echo $row['firstName'] ." ". $row['lastName']?></option>;
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCompName" class="col-lg-3 control-label">Company Name</label>
                        <div class="col-lg-9">
                            <input type="text" length="1" class="form-control" id="inputCompName" name="name" placeholder="Company Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress" class="col-lg-3 control-label">Address</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContactNum" class="col-lg-3 control-label">Contact Number</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="inputContactNum" name="contactNum" placeholder="Contact Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContactPerson" class="col-lg-3 control-label">Contact Person</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="inputContactPerson" name="contactPerson" placeholder="Contact Person">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-10">
                            <button type="submit" class="btn btn-primary" name="addClient" onclick='return InputVal();'><span class="glyphicon glyphicon-plus-sign"></span> Add Client</button> <a class="btn btn-default" href="clients.php"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include "../include/footer.php"; ?>
    <?php include "../include/bs-script.php"; ?>
</body>
</html>