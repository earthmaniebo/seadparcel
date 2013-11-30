<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript" >
        function InputVal() {
            var username = document.getElementById('inputUsername');
            var password = document.getElementById('inputPassword');

            /**
            * Check if username or password is empty, throws an error when empty.
            */
            if(username.value == "" || password.value == "") {
                alert("Please fill in all the required fields.");
                return false; 
            }
        }
    </script>
    <title>Login</title>
    <?php include "include/headtags.php"; ?>
</head>
<body>
    <?php require_once "controller/loginController.php"; ?>
    <div class="container">
        <div class="row">
        <center><div style="margin:0 0 0 -175px;"><div style="margin:-30px 0 0 -30px;"><img src="img/logo.png"></div><div style="margin:-98px 0 0 295px"><img src="img/logo_text.png"></div></div></center>
            <div class="col-md-6 col-md-offset-3">
                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Login</strong>
                    </div>
                    <div class="panel-body">
                <?php
                    /**
                    * Display an error message when login is invalid.
                    */
                    if($errorLogin) {
                ?>
                        <em><strong> <p class="text-danger text-center">Wrong username or password!</p></strong></em>
                <?php
                    }
                ?>
                        <form class="form-horizontal" role="form" method="POST" action="login.php">
                            <div class="form-group <?php if($errorLogin) echo 'has-error'?>">
                                <label for="inputUsername" class="col-lg-2 control-label">Username</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group <?php if($errorLogin) echo 'has-error'?>">
                                <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-5 col-lg-10">
                                    <button type="submit" class="btn btn-success" name="login" onclick='return InputVal();'>Sign in </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "include/bs-script.php"; ?>
</body>
</html>