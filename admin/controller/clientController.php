<?php
    require_once "../include/database.php";
    require_once "../include/globalFunctions.php";
    require_once "../model/clientModel.php";
    require_once "../model/employeeModel.php";
    require_once "../model/dataAnalystModel.php";
    require_once "../model/auditTrailModel.php";

    /** Check if the logged in employee is an admin. **/
    if(isset($_SESSION["admin"])) {

        /** If current page is add-client.php **/
        if($page == "add-client") {

            /** -- START -- Variables to be provided to view. **/

            /** Will display a success message if this is true. **/
            $isAddedClient = false;

            /** Display all data analyst. **/
            $dataAnalystView = new DataAnalyst();
            $selectDataAnalyst = $dataAnalystView->displayAll(); 

            /** -- END -- Variables to be provided to view. **/ 

            /** If the add client button is clicked. **/
            if(isset($_POST['addClient'])) {

                /** Instantiate the Client model. **/
                $client = new Client();

                /** Assign variables. **/
                $client->setEmpID($_POST["empID"]);
                $client->setName($_POST["name"]);
                $client->setAddress($_POST["address"]);
                $client->setContactNum($_POST["contactNum"]);
                $client->setContactPerson($_POST["contactPerson"]);

                /**
                * Call the addClient function from the Client model
                * and assign it to a variable.
                */
                $isSuccess = $client->addClient($client->getEmpID(), $client->getName(), $client->getAddress(), $client->getContactNum(), $client->getContactPerson());

                /** Check if the client was added. **/
                if($isSuccess) {

                    /**
                    * Call the auditTrail function from the globalFunctions.php
                    * and assign it to a variable.
                    */
                    $isAddedClient = auditTrail($_SESSION["empID"], "Added Client " . $client->getName());
                }

                else {
                    $isAddedClient = false;
                }
            }
        }

        /** If current page is clients.php **/
        else if($page == "clients") {

            /** -- START -- Variables to be provided to view. **/

            /** Identify is a client was updated or deleted. **/
            $status = "";

            $clientView = new Client();
            $dataAnalystView = new DataAnalyst();

            /** Display all data analyst in the dropdown. **/
            $selectDataAnalyst = $dataAnalystView->displayAll();

            /** Display all the clients in the table view. **/
            $selectClientAndEmployee = $clientView->selectClientWithDataAnalyst();

            /** -- END -- Variables to be provided to view. **/

            /** If the edit client button is clicked. **/
            if(isset($_POST["editClient"])) {

                /** Instantiate the Client model. **/
                $client = new Client();

                /** Assign variables. **/
                $client->setClientID($_POST["clientID"]);
                $client->setEmpID($_POST["empID"]);
                $client->setName($_POST["name"]);
                $client->setAddress($_POST["address"]);
                $client->setContactNum($_POST["contactNum"]);
                $client->setContactPerson($_POST["contactPerson"]);

                /**
                * Call the editClient function from the Client model
                * and assign it to a variable.
                */
                $status = $client->editClient($client->getClientID(), $client->getEmpID(), $client->getName(), $client->getAddress(), $client->getContactNum(), $client->getContactPerson());

                /** If edit client is successful. **/
                if($status == "updated") {

                    /** Call the auditTrail function from the globalFunctions.php **/
                    auditTrail($_SESSION["empID"], "Updated Client " . $client->getName() ."'s details.");

                    /** Update the table view in clients.php **/
                    $selectClientAndEmployee = $clientView->selectClientWithDataAnalyst();
                }
            }

            /** If the delete client button is clicked. **/
            else if(isset($_POST["deleteClient"])) {

                /** Instantiate the Client model. **/
                $client = new Client();

                /** Assign variable. **/
                $client->setClientID($_POST["clientID"]);

                /**
                * Call the deleteClient function from the Client model
                * and assign it to a variable.
                */
                $status = $client->deleteClient($client->getClientID());

                /** If delete client is successful. **/
                if($status == "deleted") {

                    /** 
                    * Identify who is the deleted client
                    * for audit trail purposes. 
                    **/
                    $deletedClient = $client->selectUsingClientID($client->getClientID());

                    /** Call the auditTrail function from the globalFunctions.php **/
                    auditTrail($_SESSION["empID"], "Deleted Client " . $deletedClient['name']);
                    
                    /** Update the table view in clients.php **/
                    $selectClientAndEmployee = $clientView->selectClientWithDataAnalyst();
                }
            }

            /** If the search button is clicked. **/
            else if(isset($_POST["searchButton"])) {

                /** Instantiate the Client model. **/
                $client = new Client();

                /**
                * Call the searchClient function from the Client model
                * and assign it to a variable.
                */
                $selectClientAndEmployee = $client->searchClient($_POST["search"]);
            }
        }                                
    }

    /** If not an admin, redirect to login page. **/
    else {
        header("Location: ../login.php");
    }
?>