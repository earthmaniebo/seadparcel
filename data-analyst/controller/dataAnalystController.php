<?php
    ob_start();
    require_once "../include/database.php";
    require_once "../include/globalFunctions.php";
    require_once "../model/employeeModel.php";
    require_once "../model/dataAnalystModel.php";
    require_once "../model/clientModel.php";
    require_once "../model/shipmentModel.php";
    require_once "../model/podModel.php";
    require_once "../model/billingModel.php";
    require_once "../model/auditTrailModel.php";

    /** Check if the logged in employee is a data analyst. **/
    if(isset($_SESSION["dataAnalyst"])) {

        /** If current page is my-account.php **/
        if($page == "my-account") {

            /** -- START -- Variables to be provided to view. **/

            /** Check if which details was updated. **/
            $isPasswordChange = "";
            $isDetailsChange = "";

            /** -- END -- Variables to be provided to view. **/

            /** If the change password button is clicked. **/
            if(isset($_POST["changePass"])) {

                /** Instantiate the Employee model. **/
                $employee = new Employee();

                /** Assign variables. **/
                $employee->setPassword($_POST["newPass"]);

                /**
                * Call the changePassword function from the Employee model
                * and assign it to a variable.
                */
                $isPasswordChange = $employee->changePassword($_SESSION["empID"], $_POST["oldPass"], $employee->getPassword());

                if($isPasswordChange == "yes") {

                    /** Call the auditTrail function from the globalFunctions.php **/
                    auditTrail($_SESSION["empID"], "Change Password");
                }
            }

            /** If the edit detail button is clicked. **/
            else if(isset($_POST["editDetails"])) {

                /** Instantiate the Employee model. **/
                $employee = new Employee();

                /** Assign variables. **/
                $employee->setEmpID($_SESSION["empID"]);
                $employee->setUsername($_POST["username"]);
                $employee->setLastName($_POST["lastName"]);
                $employee->setFirstName($_POST["firstName"]);
                $employee->setMiddleName($_POST["middleName"]);
                $employee->setAddress($_POST["address"]);

                /**
                * Call the editDetails function from the Employee model
                * and assign it to a variable.
                */
                $isDetailsChange = $employee->editDetails($employee->getEmpID(), $employee->getUsername(), $employee->getLastName(), $employee->getFirstName(), $employee->getMiddleName(), $employee->getAddress());

                if($isDetailsChange == "yes") {

                    /** Call the auditTrail function from the globalFunctions.php **/
                    auditTrail($_SESSION["empID"], "Update Profile Details");

                    $isDetailsChange = true;
                }

                else {
                    $isDetailsChange = false;
                }
            }
        }

        /** If current page is add-transaction.php **/
        else if($page == "add-transaction") {

            /** -- START -- Variables to be provided to view. **/

            /** Check if adding client is successful. **/
            $isAdded = "lyka";

            /** Display all client under the current logged in employee. **/
            $clientView = new Client();
            $selectMyClient = $clientView->selectUsingEmpID($_SESSION["empID"]);

            /** -- END -- Variables to be provided to view. **/

            /** If the addShipment button is clicked. **/
            if(isset($_POST["addShipment"])) {

                /** Instantiate the Shipment Model. **/
                $shipment = new Shipment();

                /** Assign variables. **/
                $shipment->setClientID($_POST["clientID"]);
                $shipment->setSeadawbnum($_POST["seadawbnum"]);
                $shipment->setRefNum($_POST["refNum"]);
                $shipment->setShipperName($_POST["shipperName"]);
                $shipment->setConName($_POST["conName"]);
                $shipment->setDesignation($_POST["designation"]);
                $shipment->setConAddress($_POST["conAddress"]);
                $shipment->setState($_POST["state"]);
                $shipment->setConContactNum($_POST["conContactNum"]);
                $shipment->setPickUpDate($_POST["pickUpDate"]);
                $shipment->setDescOfGoods($_POST["descOfGoods"]);
                $shipment->setTotalWeight($_POST["totalWeight"]);
                $shipment->setRemarks($_POST["remarks"]);

                /**
                * Call the addShipment function from the Shipment model
                * and assign it to a variable.
                */
                $isAdded = $shipment->addShipment($shipment->getClientID(), $shipment->getSeadawbnum(), $shipment->getRefNum(), $shipment->getShipperName(), $shipment->getConName(), $shipment->getDesignation(), $shipment->getConAddress(), $shipment->getState(), $shipment->getConContactNum(), $shipment->getPickUpDate(), $shipment->getDescOfGoods(), $shipment->getTotalWeight(), $shipment->getRemarks());

                if($isAdded) {

                    /** Call the auditTrail function from the globalFunctions.php **/
                    auditTrail($_SESSION["empID"], "Added Shipment transaction for Shipper: " . $shipment->getShipperName());
                }
            }
        }

        /** If current page is edit-transaction.php **/
        else if($page == "edit-transaction") {


            /** -- START -- Variables to be provided to view. **/

            /** The shipmentID of the shipment currently being edited. **/
            $shipmentID = $_POST["shipmentID"];

            /** Display the shipment details. **/
            $shipmentView = new Shipment();
            $selectShipment = $shipmentView->selectUsingShipmentID($shipmentID);

            /** Display the pod details. **/
            $podView = new Pod();
            $selectPod = $podView->selectUsingShipmentID($shipmentID);

            /** Display the billing details. **/
            $billingView = new Billing();
            $selectBilling = $billingView->selectUsingShipmentID($shipmentID);

            /** Responsible for displaying the client in the dropdown. **/
            $clientView = new Client();

            /** Display the clients in the dropdown **/
            $selectMyClient = $clientView->selectAllExcept($_SESSION["empID"], $selectShipment["clientID"]);

            /** Display the current client as the first option in the dropdown. **/
            $originalClient = $clientView->selectUsingClientID($selectShipment["clientID"]);

            /** 
            * Check if the data analyst is currently 
            * adding or updating pod/billing details.
            */
            $hasPod = $selectShipment["hasPod"];
            $hasBilling = $selectShipment["hasBilling"];

            /** -- END -- Variables to be provided to view. **/

            /** If the upadte button is clicked. **/
            if(isset($_POST["updateButton"])) {

                /** Instantiate the Shipment model. **/
                $shipment = new Shipment();

                /** Assign variables. **/
                $shipment->setClientID($_POST["clientID"]);
                $shipment->setSeadawbnum($_POST["seadawbnum"]);
                $shipment->setRefNum($_POST["refNum"]);
                $shipment->setShipperName($_POST["shipperName"]);
                $shipment->setConName($_POST["conName"]);
                $shipment->setDesignation($_POST["designation"]);
                $shipment->setConAddress($_POST["conAddress"]);
                $shipment->setState($_POST["state"]);
                $shipment->setConContactNum($_POST["conContactNum"]);
                $shipment->setPickUpDate($_POST["pickUpDate"]);
                $shipment->setDescOfGoods($_POST["descOfGoods"]);
                $shipment->setTotalWeight($_POST["totalWeight"]);
                $shipment->setRemarks($_POST["remarks"]);

                /**
                * Call the editShipment function from the Shipment model
                * and assign it to a variable.
                */
                $isShipmentUpdated = $shipment->editShipment($shipmentID, $shipment->getClientID(), $shipment->getSeadawbnum(), $shipment->getRefNum(), $shipment->getShipperName(), $shipment->getConName(), $shipment->getDesignation(), $shipment->getConAddress(), $shipment->getState(), $shipment->getConContactNum(), $shipment->getPickUpDate(), $shipment->getDescOfGoods(), $shipment->getTotalWeight(), $shipment->getRemarks());

                if($isShipmentUpdated) {

                    /** Call the auditTrail function from the globalFunctions.php **/
                    auditTrail($_SESSION["empID"], "Transaction with SEAD-AWB No: ".$selectShipment["seadawbnum"]. "was updated.");

                    /** 
                    * Redirect to transactions.php and notify 
                    * the data analyst that the edit was successful.
                    */
                }

                /** Check if Pod is fill up. **/
                if(isset($_POST["receivedBy"]) && $_POST["receivedBy"] != null) {

                    /** Instantiate the Pod model. **/
                    $pod = new Pod();

                    /** Assign variables. **/
                    $pod->setShipmentID($shipmentID);
                    $pod->setReceivedBy($_POST["receivedBy"]);
                    $pod->setDateReceived($_POST["dateReceived"]);
                    $pod->setTimeReceived($_POST["timeReceived"]);
                    $pod->setRelToCon($_POST["relToCon"]);
                    $pod->setRemarks($_POST["remarksPod"]);

                    /** Check if adding pod details. **/
                    if($hasPod == "N") {

                        /**
                        * Call the addPod function from the Pod model
                        * and assign it to a variable.
                        */
                        $isPodAdded = $pod->addPod($pod->getShipmentID(), $pod->getReceivedBy(), $pod->getDateReceived(), $pod->getTimeReceived(), $pod->getRelToCon(), $pod->getRemarks());

                        /** Call the updateStatus function from the Shipment model. **/
                        $shipment->updateStatus($shipmentID);

                        /** Call the updateHasPod function from the Shipment model. **/
                        $shipment->updateHasPod($shipmentID);
                    }

                    /** Check if updating pod details. **/
                    else if($hasPod == "Y") {

                        /**
                        * Call the editPod function from the Pod model
                        * and assign it to a variable.
                        */
                        $isPodUpdated = $pod->editPod($pod->getShipmentID(), $pod->getReceivedBy(), $pod->getDateReceived(), $pod->getTimeReceived(), $pod->getRelToCon(), $pod->getRemarks());
                    }
                }

                /** Check if Billing is fill up. **/
                if(isset($_POST["totalCharge"]) && $_POST["totalCharge"] != null) {

                    /** Instantiate the Billing model. **/
                    $billing = new Billing();

                    /** Assign variables. **/
                    $billing->setShipmentID($shipmentID);
                    $billing->setFreightCharge($_POST["freightCharge"]); 
                    $billing->setAddOnCharge($_POST["addOnCharge"]);
                    $billing->setCratingCharge($_POST["cratingCharge"]);
                    $billing->setOsaCharge($_POST["osaCharge"]);
                    $billing->setValuationCharge($_POST["valuationCharge"]);
                    $billing->setTotalCharge($_POST["totalCharge"]);

                    /** Check if adding billing details. **/
                    if($hasBilling == "N") {

                        /**
                        * Call the addBilling function from the Billing model
                        * and assign it to a variable.
                        */
                        $isBillingAdded = $billing->addBilling($billing->getShipmentID(), $billing->getFreightCharge(), $billing->getAddOnCharge(), $billing->getCratingCharge(), $billing->getOsaCharge(), $billing->getValuationCharge(), $billing->getTotalCharge());

                        /** Call the updateHasBilling function from the Shipment model. **/
                        $shipment->updateHasBilling($shipmentID);
                    }

                    /** Check if updating billing details. **/
                    else if($hasBilling == "Y") {

                        /**
                        * Call the editBilling function from the Billing model
                        * and assign it to a variable.
                        */
                        $isBillingUpdated = $billing->editBilling($billing->getShipmentID(), $billing->getFreightCharge(), $billing->getAddOnCharge(), $billing->getCratingCharge(), $billing->getOsaCharge(), $billing->getValuationCharge(), $billing->getTotalCharge());
                    }
                }
                $_SESSION["status"] = "updated";
                header("Location: transactions.php");
            }
        }

        /** If current page is transactions.php **/
        else if($page == "transactions") {

            /** -- START -- Variables to be provided to view. **/

            /** 
            * Display all transactions under the current 
            * logged in data analyst.
            */
            $shipmentView = new Shipment();
            $selectMyShipment = $shipmentView->selectMyShipment($_SESSION["empID"]);
            $isDeleted = false;

            /** -- END -- Variables to be provided to view. **/

            /** If the delete button is clicked. **/
            if(isset($_POST["delete"])) {

                /**
                * Call the deleteShipment function from the Shipment model
                * adn assign it to a variable.
                */
                $isDeleted = $shipmentView->deleteShipment($_POST["shipmentID"]);

                /** Check if delete was successful. **/
                if($isDeleted) {

                    /** Update the table view in employees.php **/
                    $selectMyShipment = $shipmentView->selectMyShipment($_SESSION["empID"]);
                }
            }

            /** If the search button is clicked. **/
            else if(isset($_POST["searchButton"])) {

                /**
                * Call the searchMyShipment function from the Shipment model
                * and assign it to a variable.
                */
                $selectMyShipment = $shipmentView->searchMyShipment($_SESSION["empID"], $_POST["search"]);
            }

        }

        /** If current page is billing.php or shipment.php **/
        else if($page == "reports") {

            /** -- START -- Variables to be provided to view. **/

            /** Display client dropdown. **/
            $clientView = new Client();
            $selectClient = $clientView->displayAll();

            /** Display billing reports. **/
            $dataAnalyst = new DataAnalyst();
            $reportsView = $dataAnalyst->reports("DEFAULT", "", "");

            /** To be printed to pdf. **/
            $total = 0.00;
            $fromDate = "--";
            $toDate = "--";
            $company = "N/A";

            /** -- END -- Variables to be provided to view. **/

            /** If the sort button is clicked. **/
            if(isset($_POST["sort"])) {

                /** Get variables. **/
                $fromYear = $_POST["fromYear"];
                $toYear = $_POST["toYear"];
                $fromMonth = $_POST["fromMonth"];
                $toMonth = $_POST["toMonth"];
                $fromDay = $_POST["fromDay"];
                $toDay = $_POST["toDay"];
                $company = $_POST["company"];
                $fromDate = $fromYear ."-". $fromMonth ."-". $fromDay;
                $toDate = $toYear ."-". $toMonth ."-". $toDay;

                /**
                * Call the reports function from the Employee model
                * and assign it to a variable.
                */
                $reportsView = $dataAnalyst->reports($company, $fromDate, $toDate);
            }
        }

        /** If current page is pod.php **/
        else if($page == "pod-reports") {

            /** -- START -- Variables to be provided to view. **/

            /** Display client dropdown. **/
            $clientView = new Client();
            $selectClient = $clientView->displayAll();

            /** Display billing reports. **/
            $dataAnalyst = new DataAnalyst();
            $reportsView = $dataAnalyst->podReports("DEFAULT", "", "");

            /** To be printed to pdf. **/
            $fromDate = "--";
            $toDate = "--";
            $company = "N/A";

            /** -- END -- Variables to be provided to view. **/

            /** If the sort button is clicked. **/
            if(isset($_POST["sort"])) {

                /** Get variables. **/
                $fromYear = $_POST["fromYear"];
                $toYear = $_POST["toYear"];
                $fromMonth = $_POST["fromMonth"];
                $toMonth = $_POST["toMonth"];
                $fromDay = $_POST["fromDay"];
                $toDay = $_POST["toDay"];
                $company = $_POST["company"];
                $fromDate = $fromYear ."-". $fromMonth ."-". $fromDay;
                $toDate = $toYear ."-". $toMonth ."-". $toDay;

                /**
                * Call the podReports function from the Employee model
                * and assign it to a variable.
                */
                $reportsView = $dataAnalyst->podReports($company, $fromDate, $toDate);
            }
        }

        /** If current page is airwaybill.php **/
        else if($page == "airwaybill") {

            
            /** -- START -- Variables to be provided to view. **/

            /** Get the shipmentID and hasBilling **/
            $shipmentID = $_POST["shipmentID"];
            $hasBilling = $_POST["hasBilling"];

            $data = null;

            /** -- END -- Variables to be provided to view. **/

            /** Instantiate the DataAnalyst model. **/
            $dataAnalyst = new DataAnalyst();

            /**
            * Call the print function from the DataAnalyst model
            * and assign in to a variable.
            */
            $data = $dataAnalyst->printTransaction($shipmentID, $hasBilling);   
        }
    }

    /** If not a data analyst, redirect to login page. **/
    else {
        header("Location: ../login.php");
    }
?>