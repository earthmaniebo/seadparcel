<?php
    require_once "../include/database.php";
    require_once "../include/globalFunctions.php";
    require_once "../model/auditTrailModel.php";
    require_once "../model/clientModel.php";

    /** Check if the logged in employee is a data analyst. **/
    if(isset($_SESSION["dataAnalyst"])) {

        /** If current page is my-clients.php **/
        if($page == "my-clients") {
            
            /** -- START -- Variables to be provided to view. **/

            /** 
            * Display all clients under the current 
            * logged in data analyst 
            */
            $clientView = new Client();
            $selectMyClient = $clientView->selectUsingEmpID($_SESSION["empID"]);

            /** -- END -- Variables to be provided to view. **/

            /** If the search button is clicked. **/
            if(isset($_POST["searchButton"])) {

                /** Instantiate the Client model. **/
                $client = new Client();

                /**
                * Call the searchClient function from the Client model
                * and assign it to a variable.
                */
                $selectMyClient = $client->searchMyClient($_SESSION["empID"], $_POST["search"]);
            }
        }
    }

    /** If not a data analyst, redirect to login page. **/
    else {
        header("Location: ../login.php");
    }
?>