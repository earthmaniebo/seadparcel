<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript">
        function confirmDelete() {
            var test = confirm("Are you sure?");
            if (test == true)
                return true;

            else
                return false;
        }

        function InputVal() {
            var name = document.getElementById('inputCompName');
            var address = document.getElementById('inputAddress');
            var contactNum = document.getElementById('inputContactNum');
            var contactPerson = document.getElementById('inputContactPerson');
            var patt1 = /[^a-z,^A-Z,\s,.]|[0-9]/g;
            var result1 = patt1.test(contactPerson.value);
            
            if(name.value == "" || address.value == "" || contactNum.value == "" || contactPerson.value == "") {
                alert("Please fill in all the required fields.");
                return false;
            }

            if(result1) {
                alert("Numbers and specials characters are not allowed in Contact Person.");
                return false;
            }
        }
    </script>
    <title>Admin | Clients</title>
    <?php include "../include/headtags.php"; ?>
    <?php $page = "clients" ?>
</head>
<body>
    <?php include "../include/nav-admin.php"; ?>
    <div class="container">
        <?php require_once "controller/clientController.php"; ?>
        <div class="row">
            <div class="col-md-12">
                <h2>Clients</h2>
                <hr>
                <?php if($status == "updated") { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Client details was successfully updated</strong>.
                </div>
                <?php } else if($status == "deleted") { ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Client was successfully deleted</strong>.
                </div>
                <?php } ?>
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <a class="btn btn-default" href="add-client.php"><span class="glyphicon glyphicon-plus-sign"></span> Add Client</a>
                        <form class="form-inline pull-right" role="form" action="clients.php" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputSearch" placeholder="Search" name="search">
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
                                    <th>Client ID</th>
                                    <th>Company Name</th>
                                    <th>Address</th>
                                    <th>Contact Number</th>
                                    <th>Contact Person</th>
                                    <th>Assigned Employee</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $editCount = 1; foreach($selectClientAndEmployee as $row) { ?>
                                <tr>
                                    <td class="client"><?php echo $row["clientID"] ?></td>
                                    <td class="client"><?php echo $row["name"]; ?></td>
                                    <td class="client"><?php echo $row["cAddress"] ?></td>
                                    <td class="client"><?php echo $row["contactNum"] ?></td>
                                    <td class="client"><?php echo $row["contactPerson"] ?></td>
                                    <td class="client"><?php echo $row["firstName"] . " " . $row["lastName"] ?></td>
                                    <td class="client text-center">
                                        <button data-toggle="modal" <?php echo "href='#edit".$editCount."'";?> class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                                        <form action="clients.php" method="POST" style="display:inline;">
                                            <?php echo "<input type='hidden' name='clientID' value='".$row["clientID"]."'>"?>
                                            <button type="submit" class="btn btn-danger btn-xs" name="deleteClient" onclick="return confirmDelete();"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $editCount++; }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php $modalCount = 1; foreach($selectClientAndEmployee as $row) { ?>
                <div class="modal fade" <?php echo "id='edit".$modalCount."'";?> tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <center><h4 class="modal-title" style="color: black">Edit <?php echo $row["name"]. "'s " ?>Account Details</h4></center>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" role="form" method="POST" action="clients.php">
                                    <div class="form-group">
                                        <label for="inputEmployee" class="col-lg-3 control-label">Assign Employee</label>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="empID" id="inputEmployee">
                                                <option value="<?php echo $row["empID"] ?>"><?php echo $row["firstName"] . " ". $row["lastName"] ?></option>
                                                <?php foreach($selectDataAnalyst as $row2) {?>
                                                <option value="<?php echo $row2['empID']?>"><?php echo $row2['firstName'] ." ". $row2['lastName']?></option>;
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCompName" class="col-lg-3 control-label">Company Name</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" id="inputCompName" name="name" placeholder="Company Name" value="<?php echo $row["name"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress" class="col-lg-3 control-label">Address</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Address" value="<?php echo $row["cAddress"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputContactNum" class="col-lg-3 control-label">Contact Number</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" id="inputContactNum" name="contactNum" placeholder="Contact Number" value="<?php echo $row["contactNum"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputContactPerson" class="col-lg-3 control-label">Contact Person</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" id="inputContactPerson" name="contactPerson" placeholder="Contact Person" value="<?php echo $row["contactPerson"] ?>">
                                        </div>
                                    </div>
                                    <input type='hidden' name='clientID' value="<?php echo $row['clientID']?>">

                                </div>
                                <div class="modal-footer">
                                    
                                    <a class="btn btn-default" href="clients.php"><span class="glyphicon glyphicon-remove"></span> Cancel</a><button type="submit" class="btn btn-primary" name="editClient" onclick="return InputVal();"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <?php $modalCount++; } ?>
            </div>
        </div>
    </div>
    <?php include"../include/footer.php"; ?>
    <?php include "../include/bs-script.php"; ?>
</body>
</html>