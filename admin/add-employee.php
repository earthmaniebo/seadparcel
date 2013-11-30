<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../include/headtags.php"; ?>
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript">
        function InputVal() {
            var fName = document.getElementById('inputFirstName');
            var mName = document.getElementById('inputMiddleName');
            var lName = document.getElementById('inputLastName');
            var address = document.getElementById('inputAddress');
            var position = document.getElementById('inputPosition');
            var uName = document.getElementById('inputUsername');
            
            var password = document.getElementById('inputPassword');
            var cnfPassword = document.getElementById('inputPasswordCnf');
            
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
            
            else if(fName.value == "" || lName.value == "" || address.value == "" || position.value == "" || uName.value == "" || password.value == "" || cnfPassword.value == "") {
                alert("Please fill in all the required fields.");
                return false;
            }
        }
    </script>
    <title>Admin | Add Employee</title>
    <?php $page = "add-employee" ?>
</head>
<body>
    <?php include "../include/nav-admin.php"; ?>
    <div class="container">
        <?php require_once "controller/adminController.php"; ?>
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <h2>Add Employee</h2>
                <hr>
                <?php if($isAddedEmployee) { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Employee successfully added.</strong> 
                </div>
                <?php } ?>
                <form class="form-horizontal" role="form" method="POST" action="add-employee.php">
                    <div class="form-group">
                        <label for="inputUsername" class="col-lg-3 control-label">Username</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-3 control-label">Password</label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPasswordCnf" class="col-lg-3 control-label">Confirm Password</label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" id="inputPasswordCnf" name="passwordCnf" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLastName" class="col-lg-3 control-label">Last Name</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="inputLastName" name="lastName" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputFirstName" class="col-lg-3 control-label">First Name</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="inputFirstName" name="firstName" placeholder="First Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMiddleName" class="col-lg-3 control-label">Middle Name</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="inputMiddleName" name="middleName" placeholder="Middle Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress" class="col-lg-3 control-label">Address</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPosition" class="col-lg-3 control-label">Position</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="position" id="inputPosition">
                                <option value="admin">Admin</option>
                                <option value="dataAnalyst">Data Analyst</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-10">
                            <button type="submit" class="btn btn-primary" name="addEmployee" onclick='return InputVal();'><span class="glyphicon glyphicon-plus-sign"></span> Add Employee</button> <a class="btn btn-default" href="employees.php"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include"../include/footer.php"; ?>
    <?php include"../include/bs-script.php"; ?>
</body>
</html>