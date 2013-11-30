<?php
    require_once "include/database.php";
    require_once "include/globalFunctions.php";
    require_once "model/loginModel.php";
    require_once "model/auditTrailModel.php";

    $errorLogin = false;

    /** 
    * Check if there's already a logged in user,
    * then redirects him/her to his/her respective
    * my-account page.
    */
    if(isset($_SESSION["dataAnalyst"])) {
        header("Location: data-analyst/index.php");
    }

    else if(isset($_SESSION["admin"])) {
        header("Location: admin/index.php");
    }

    /** If the login button is clicked. **/
    else if(isset($_POST["login"])) {
        
        /** Instantiate the Login model. **/
        $login = new Login();

        /** Assign variables **/
        $login->setUsername($_POST["username"]);
        $login->setPassword($_POST["password"]);

        /** 
        * Call the function userLogin from the Login model
        * and assign it to a variable.
        */
        $position = $login->userLogin($login->getUsername(), $login->getPassword());
        
        /** Check if login is successful. **/
        if($position != "error") {

            /**
            * Call the auditTrail function from the globalFunctions.php
            * and assign it to a variable.
            */
            auditTrail($_SESSION["empID"], "Employee " . $login->getUsername() ." has logged in.");

            /** Check what is the position of the logged in user, 
            * then redirects him/her to his/her respective
            * my-account page. Else return an error.
            */
            if($position == "admin") {
                $_SESSION["admin"] = true;
                header("Location: admin/index.php");
            }

            else if ($position  == "dataAnalyst") {
                $_SESSION["dataAnalyst"] = true;
                header("Location: data-analyst/index.php");
            }
        }

        else {
            $errorLogin = true;
        }
    }
?>