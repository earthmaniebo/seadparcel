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
            var fName = document.getElementById('inputFirstName');
            var mName = document.getElementById('inputMiddleName');
            var lName = document.getElementById('inputLastName');
            var address = document.getElementById('inputAddress');
            var position = document.getElementById('inputPosition');
            var uName = document.getElementById('inputUsername');

            var patt1 = /[^\w,\s,.]|[0-9]/g;
            var result1 = patt1.test(fName.value);
            var result2 = patt1.test(mName.value);
            var result3 = patt1.test(lName.value);

            if(result1) {
                alert("Numbers and specials characters are not allowed in First Name.");
                return false;
            }

            if(result2) {
                alert("Numbers and specials characters are not allowed in Middle Name.");
                return false;
            }

            if(result3) {
                alert("Numbers and specials characters are not allowed in Last Name.");
                return false;
            }

            if(password.value.length < 6) {
                alert("Password should be at least 6 characters.");
                return false;
            }

            if(password.value != cnfPassword.value) {
                alert("Password did not match!");
                return false;       
            }

            else if(fName.value == "" || lName.value == "" || address.value == "" || position.value == "" || uName.value == "") {
                alert("Please fill in all the required fields.");
                return false;
            }
        }
    </script>
    <title>Admin | Employees</title>
    <?php include "../include/headtags.php"; ?>
    <?php $page = "employees" ?>
</head>
<body>
    <?php include "../include/nav-admin.php"; ?>
    <div class="container">
        <?php require_once "controller/adminController.php"; ?>
        <div class="row">
            <div class="col-md-12">
                <h2>Employees</h2>
                <hr>
                <?php if($status == "updated") { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Employee details was successfully updated.</strong>
                </div>
                <?php } else if($status == "deleted") { ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Employee was successfully deleted.</strong>
                </div>
                <?php } else if($status == 'notDeleted') { ?>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Cannot delete employee because he/she still has client(s) under him/her.</strong>
                </div>
                <?php } else if($status == 'passwordReset') { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Password reset was successful.</strong>
                </div>
                <?php } ?>
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <a class="btn btn-default" href="add-employee.php"><span class="glyphicon glyphicon-plus-sign"></span> Add Employee</a>
                        <form class="form-inline pull-right" role="form" action="employees.php" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputSearch" placeholder="Search" name="search">
                            </div>
                            <button type="submit" class="btn btn-default" name="searchButton"><span class="glyphicon glyphicon-search"></span> Search</button>
                        </form>
                        <div class="clearfix"></div>                 
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Address</th>
                                    <th>Position</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $editCount = 1; foreach($selectEmployee as $row) { ?>
                                <tr>
                                    <td class="employee"><?php echo $row["empID"] ?></td>
                                    <td class="employee"><?php echo $row["username"] ?></td>
                                    <td class="employee"><?php echo $row["firstName"] ?></td>
                                    <td class="employee"><?php echo $row["middleName"] ?></td>
                                    <td class="employee"><?php echo $row["lastName"] ?></td>
                                    <td class="employee"><?php echo $row["address"] ?></td>
                                    <td class="employee"><?php echo $row["position"] ?></td>
                                    <td class="employee text-center">
                                        <button data-toggle="modal" <?php echo "href='#edit".$editCount."'";?> class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                                        <form action="employees.php" method="POST" style="display:inline;">
                                            <input type='hidden' name='empID' value='<?php echo $row["empID"] ?>'>
                                            <button type="submit" class="btn btn-danger btn-xs" name="deleteEmployee" onclick="return confirmDelete();"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $editCount++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php $modalCount = 1; foreach($selectEmployee as $row) { ?>
                <div class="modal fade" <?php echo "id='edit".$modalCount."'";?> tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <center><h4 class="modal-title" style="color: black">Edit <?php echo $row["firstName"]. "'s" ?> Account Details</h4></center>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" role="form" method="POST" action="employees.php">
                                    <div class="form-group">
                                        <label for="inputUsername" class="col-lg-3 control-label">Username</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username" value="<?php echo $row['username'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputLastName" class="col-lg-3 control-label">Last Name</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" id="inputLastName" name="lastName" placeholder="Last Name" value="<?php echo $row['lastName'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputFirstName" class="col-lg-3 control-label">First Name</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" id="inputFirstName" name="firstName" placeholder="First Name" value="<?php echo $row['firstName'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputMiddleName" class="col-lg-3 control-label">Middle Name</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" id="inputMiddleName" name="middleName" placeholder="Middle Name" value="<?php echo $row['middleName'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress" class="col-lg-3 control-label">Address</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Address" value="<?php echo $row['address'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPosition" class="col-lg-3 control-label">Position</label>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="position" id="inputPosition">
                                                <?php if($row["position"] == 'admin') { ?>
                                                <option value="admin">Admin</option>
                                                <option value="dataAnalyst">Data Analyst</option>
                                                <?php } else { ?>
                                                <option value="dataAnalyst">Data Analyst</option>
                                                <option value="admin">Admin</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <input type='hidden' name='empID' value='<?php echo $row["empID"] ?>'>
                                </div>
                                <div class="modal-footer">
                                    <input type='hidden' name='empID' value='<?php echo $row["empID"] ?>'>
                                    <button type="submit" name="resetPass" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-refresh"></span> Reset Password</button>
                                    <button type="submit" class="btn btn-primary" name="editEmployee" onclick='return InputVal();'><span class="glyphicon glyphicon-edit"></span> Edit</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <div class="modal modalPassword fade" <?php echo "id='editPassword".$modalCount."'";?> tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modalDialogPassword">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <center><h4 class="modal-title" style="color: black">Reset Password for <?php echo $row["username"] ?></h4></center>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" role="form" method="POST" action="employees.php">
                                    <div class="form-group">
                                        <label for="newPass" class="col-lg-2 control-label">New</label>
                                        <div class="col-lg-10">
                                            <input type="password" class="form-control" id="newPass" placeholder="Password" name="newPass">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cnfPass" class="col-lg-2 control-label">Confirm</label>
                                        <div class="col-lg-10">
                                            <input type="password" class="form-control" id="cnfPass" placeholder="Password" name="cnfPass">
                                        </div>
                                    </div>
                                    <input type='hidden' name='empID' value='<?php echo $row["empID"] ?>'>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" name="resetPass" onclick='return InputVal2();'><span class="glyphicon glyphicon-refresh"></span> Update Password</button>
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