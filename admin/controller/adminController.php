<?php
    require_once "../include/database.php";
    require_once "../include/globalFunctions.php";
    require_once "../model/employeeModel.php";
    require_once "../model/adminModel.php";
    require_once "../model/clientModel.php";
    require_once "../model/billingModel.php";
    require_once "../model/shipmentModel.php";
    require_once "../model/podModel.php";
    require_once "../model/auditTrailModel.php";

    /** Check if the logged in employee is an admin. **/
    if(isset($_SESSION["admin"])) {

        /** If current page is add-employee.php **/
        if($page == "add-employee") {

            /** -- START -- Variables to be provided to view. **/

            /** Will display a success message if this is true. **/
            $isAddedEmployee = false;

            /** -- END -- Variables to be provided to view. **/

            /** If the add employee button is clicked. **/
            if(isset($_POST['addEmployee'])) {

                /** Instantiate the Admin model. **/
                $employee = new Admin();

                /** Assign variables. **/
                $employee->setUsername($_POST["username"]);
                $employee->setPassword($_POST["password"]);
                $employee->setLastName($_POST["lastName"]);
                $employee->setFirstName($_POST["firstName"]);
                $employee->setMiddleName($_POST["middleName"]);
                $employee->setAddress($_POST["address"]);
                $employee->setPosition($_POST["position"]);

                /**
                * Call the addEmployee function from the Admin model
                * and assign it to a variable.
                */
                $isSuccess = $employee->addEmployee($employee->getUsername(), $employee->getPassword(), $employee->getLastName(), $employee->getFirstName(), $employee->getMiddleName(), $employee->getAddress(), $employee->getPosition());

                /** Check if the employee was added. **/
                if($isSuccess) {

                    /**
                    * Call the auditTrail function from the globalFunctions.php
                    * and assign it to a variable.
                    */
                    $isAddedEmployee = auditTrail($_SESSION["empID"], "Added Employee " . $employee->getFirstName() ." ". $employee->getLastName());
                }

                else {
                    $isAddedEmployee = false;
                }
            }
        }

        /** If current page is employees.php **/
        else if($page == "employees") {

            /** -- START -- Variables to be provided to view. **/

            /** Identify if an employee was updated or deleted. **/
            $status = "";

            /** Display all Employee except the current logged in admin. **/
            $employeeView = new Employee();
            $selectEmployee = $employeeView->selectAllExcept($_SESSION["empID"]);

            /** -- END -- Variables to be provided to view. **/
            
            /** If the edit employee button is clicked. **/
            if(isset($_POST["editEmployee"])) {

                /** Instantiate the Admin model. **/
                $employee = new Admin();

                /** Assign variables. **/
                $employee->setUsername($_POST["username"]);
                $employee->setLastName($_POST["lastName"]);
                $employee->setFirstName($_POST["firstName"]);
                $employee->setMiddleName($_POST["middleName"]);
                $employee->setAddress($_POST["address"]);
                $employee->setPosition($_POST["position"]);
                $employee->setEmpID($_POST["empID"]);

                /**
                * Call the editEmployee function from the Admin model
                * and assign it to a variable.
                */
                $status = $employee->editEmployee($employee->getUsername(), $employee->getLastName(), $employee->getFirstName(), $employee->getMiddleName(), $employee->getAddress(), $employee->getPosition(), $employee->getEmpID());

                /** If edit employee is successful. **/
                if($status == "updated") {

                    /** Call the auditTrail function from the globalFunctions.php **/
                    auditTrail($_SESSION["empID"], "Updated Employee " . $employee->getFirstName() . " " . $employee->getLastName() ."'s details.");

                    /** Update the table view in employees.php **/
                    $selectEmployee = $employeeView->selectAllExcept($_SESSION["empID"]);
                }
            }

            /** If the delete employee button is clicked. **/
            else if(isset($_POST["deleteEmployee"])) {

                /** Instantiate the Employee model. **/
                $employee = new Admin();

                /** Assign variables **/
                $employee->setEmpID($_POST["empID"]);

                /**
                * Call the hasClients function from the Employee model
                * and assign it to a variable.
                */
                $hasClients = $employee->hasClients($employee->getEmpID());

                /** Check if employee has clients under him/her. **/
                if($hasClients) {
                    $status = "notDeleted";
                }

                else {
                    
                    /**
                    * Call the deleteEmployee function from the Employee model
                    * and assign it to a variable.
                    */
                    $status = $employee->deleteEmployee($employee->getEmpID());

                    /** If delete employee is successful. **/
                    if($status == "deleted") {

                        /** 
                        * Identify who is the deleted employee
                        * for audit trail purposes. 
                        **/
                        $deletedEmployee = $employee->selectUsingEmpID($employee->getEmpID());

                        /** Call the auditTrail function from the globalFunctions.php **/
                        auditTrail($_SESSION["empID"], "Deleted Employee " . $deletedEmployee['firstName'] ." ". $deletedEmployee["lastName"]);
                        
                        /** Update the table view in employees.php **/
                        $selectEmployee = $employeeView->selectAllExcept($_SESSION["empID"]);
                    }
                }
            }

            /** If the reset password button is clicked. **/
            else if(isset($_POST["resetPass"])) {

                /** Instantiate the Employee model. **/
                $employee = new Admin();

                /** Assign variables. **/
                $employee->setEmpID($_POST["empID"]);

                /**
                * Call the resetPassword function from the Employee model
                * and assign it to a variable.
                */
                $status = $employee->resetPassword($employee->getEmpID());

                /** If password reset is successful. **/
                if($status == "passwordReset") {

                    /** 
                    * Identify who asked for a password
                    * reset for audit trail purposes. 
                    **/
                    $resetPasswordEmployee = $employee->selectUsingEmpID($employee->getEmpID());

                    /** Call the auditTrail function from the globalFunctions.php **/
                    auditTrail($_SESSION["empID"], "Reset Password for Employee " . $resetPasswordEmployee["firstName"] . " " . $resetPasswordEmployee["lastName"]);
                }
            }

            /** If the search button is clicked. **/
            else if(isset($_POST["searchButton"])) {

                /** Instantiate the Employee model. **/
                $employee = new Admin();

                /**
                * Call the searchEmployee function from the Employee model
                * and assign it to a variable.
                */
                $selectEmployee = $employee->searchEmployee($_SESSION["empID"], $_POST["search"]);
            }
        }

        /** If current page is my-account.php **/
        else if($page == "my-account") {

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

        /** If current page is billing.php or shipment.php **/
        else if($page == "reports") {

            /** -- START -- Variables to be provided to view. **/

            /** Display client dropdown. **/
            $clientView = new Client();
            $selectClient = $clientView->displayAll();

            /** Display billing reports. **/
            $admin = new Admin();
            $reportsView = $admin->reports("DEFAULT", "", "");

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
                $reportsView = $admin->reports($company, $fromDate, $toDate);
            }
        }

        /** If current page is pod.php **/
        else if($page == "pod-reports") {

            /** -- START -- Variables to be provided to view. **/

            /** Display client dropdown. **/
            $clientView = new Client();
            $selectClient = $clientView->displayAll();

            /** Display billing reports. **/
            $admin = new Admin();
            $reportsView = $admin->podReports("DEFAULT", "", "");

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
                $reportsView = $admin->podReports($company, $fromDate, $toDate);
            }
        }

        /** If current page is audit-trail.php **/
        else if($page == "audit-trail") {

            /** -- START -- Variables to be provided to view. **/

            /** Display client dropdown. **/
            $auditView = new AuditTrail();
            $selectAudit = $auditView->displayAll();

            /** -- END -- Variables to be provided to view. **/
        }

        /** If current page is employees-archive.php **/
        else if($page == "employees-archive") {
            $employee = new Employee();
            $empArchive = $employee->viewArchive();
        }

        /** If current page is clients-archive.php **/
        else if($page == "clients-archive") {
            $client = new Client();
            $clientArchive = $client->viewArchive();
        }

        /** If current page is billing-archive.php **/
        else if($page == "billing-archive") {
            $billing = new Billing();
            $billingArchive = $billing->viewArchive();
        }

        /** If current page is pod-archive.php **/
        else if($page == "pod-archive") {
            $pod = new Pod();
            $podArchive = $pod->viewArchive();
        }

        /** If current page is shipment-archive.php **/
        else if($page == "shipment-archive") {
            $shipment = new Shipment();
            $shipmentArchive = $shipment->viewArchive();
        }
    }

    /** If not an admin, redirect to login page. **/
    else {
        header("Location: ../login.php");
    }
?>