<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript" >
        function InputVal() {
            var oldPass = document.getElementById('oldPass');
            var newPass = document.getElementById('newPass');
            var cnfPass = document.getElementById('cnfPass');
            
            if(newPass.value.length < 6) {
                alert("Password should be at least 6 characters.");
                return false;
            }
            
            if(newPass.value != cnfPass.value) {
                alert("New password did not match!");
                return false;       
            }

            if(oldPass.value == "" || newPass.value == "" || cnfPass.value == "") {
                alert("Please fill in all the required fields.");
                return false;
            }
        }

        function InputVal2() {
            var fName = document.getElementById('inputFirstName');
            var mName = document.getElementById('inputMiddleName');
            var lName = document.getElementById('inputLastName');
            var address = document.getElementById('inputAddress');
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

            if(fName.value == "" || lName.value == "" || address.value == "" || uName.value == "") {
                alert("Please fill in all the required fields.");
                return false;
            }
        }
    </script>
    <title>Data Analyst | My Account</title>
    <?php include "../include/headtags.php"; ?>
    <?php $page = "my-account" ?>
</head>
<body>
    <?php include "../include/nav-data-analyst.php"; ?>
    <div class="container">
        <?php require_once "controller/dataAnalystController.php"; ?>
        <h2>My Account</h2>
        <hr>
        <?php if($isPasswordChange == "yes") { ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Password was successfully updated</strong>.
        </div>
        <?php } else if($isPasswordChange == "no") { ?>  
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Your old password was incorrect</strong>.
        </div>
        <?php } else if($isDetailsChange == "yes") { ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Profile details was successfully updated</strong>.
        </div>
        <?php } else if($isDetailsChange == "no") { ?>  
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Error updating profile details.</strong>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-3">
                <img src="../img/admin.png" /><br>
                <center><strong>Admin</strong></center>
            </div>
            <div class="col-md-5">
                <h3>Details <button data-toggle="modal" href="#edit" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</button></h3>
                <br>
                <table class="table">                        <tr>
                            <td><strong>Username</strong></td>
                            <td class="profile"> <?php echo $_SESSION["username"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>First name</strong></td>
                            <td class="profile"> <?php echo $_SESSION["firstName"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Middle name</strong></td>
                            <td class="profile"> <?php echo $_SESSION["middleName"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Last name</strong></td>
                            <td class="profile"> <?php echo $_SESSION["lastName"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Address</strong></td>
                            <td class="profile"> <?php echo $_SESSION["address"]; ?></td>
                        </tr>
                </table>

            </div>
            <div class="col-md-4">
                <h3>Change Password</h3>
                <hr>
                <form class="form-horizontal" role="form" method="POST" action="index.php">
                    <div class="form-group">
                        <label for="oldPass" class="col-lg-2 control-label">Old</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="oldPass" placeholder="Password" name="oldPass">
                        </div>
                    </div>
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
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-primary" name="changePass" onclick='return InputVal();'><span class="glyphicon glyphicon-refresh"></span> Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
        ?>
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <center><h4 class="modal-title" style="color: black">Edit Profile Details</h4></center>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" method="POST" action="index.php">
                            <div class="form-group">
                                <label for="inputUsername" class="col-lg-3 control-label">Username</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username" value="<?php echo $_SESSION['username'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputLastName" class="col-lg-3 control-label">Last Name</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="inputLastName" name="lastName" placeholder="Last Name" value="<?php echo $_SESSION['lastName'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFirstName" class="col-lg-3 control-label">First Name</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="inputFirstName" name="firstName" placeholder="First Name" value="<?php echo $_SESSION['firstName'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputMiddleName" class="col-lg-3 control-label">Middle Name</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="inputMiddleName" name="middleName" placeholder="Middle Name" value="<?php echo $_SESSION['middleName'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress" class="col-lg-3 control-label">Address</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Address" value="<?php echo $_SESSION['address'] ?>">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="editDetails" onclick='return InputVal2();'><span class="glyphicon glyphicon-edit"></span> Edit</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <?php include"../include/footer.php"; ?>
    <?php include "../include/bs-script.php"; ?>
</body>
</html>