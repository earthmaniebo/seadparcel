<?php
    class Employee {
        public $empID;
        public $username;
        private $password;
        public $lastName;
        public $firstName;
        public $middleName;
        public $address;
        public $position;
        private $isDeleted;

        /** Setters **/
        function setEmpID($empID) {
            $this->empID = htmlspecialchars($empID);
        }

        function setUsername($username) {
            $this->username = htmlspecialchars($username);
        }

        function setPassword($password) {
            $this->password = sha1($password);
        }

        function setLastName($lastName) {
            $this->lastName = htmlspecialchars($lastName);
        }

        function setFirstName($firstName) {
            $this->firstName = htmlspecialchars($firstName);
        }

        function setMiddleName($middleName) {
            $this->middleName = htmlspecialchars($middleName);
        }

        function setAddress($address) {
            $this->address = htmlspecialchars($address);
        }

        function setPosition($position) {
            $this->position = htmlspecialchars($position);
        }

        function setIsDeleted($isDeleted) {
            $this->isDeleted = htmlspecialchars($isDeleted);
        }
        /** End setters **/

        /** Getters **/
        function getEmpID() {
            return $this->empID;
        }

        function getPassword() {
            return $this->password;
        }

        function getUsername() {
            return $this->username;
        }

        function getLastName() {
            return $this->lastName;
        }

        function getFirstName() {
            return $this->firstName;
        }

        function getMiddleName() {
            return $this->middleName;
        }

        function getAddress() {
            return $this->address;
        }

        function getPosition() {
            return $this->position;
        }

        function getIsDeleted() {
            return $this->isDeleted;
        }
        /** End getters **/

        /**
        * Retrieve all employees except
        * the provided empID.
        * @param int
        * @return array
        */
        function selectAllExcept($empID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT * FROM employees WHERE isDeleted='N' AND empID != :empID");

                /** Bind the parameter to the sql query. **/
                $stmt->bindParam(':empID', $empID);

                /** Execute the query. **/
                $stmt->execute();

                /** Store the query result to a variable. **/
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        /**
        * Retrieve an employee using its empID.
        * @param int
        * @return array
        */
        function selectUsingEmpID($empID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT * FROM employees WHERE empID = :empID");

                /** Bind the parameter to the sql query. **/
                $stmt->bindParam(':empID', $empID);

                /** Execute the query. **/
                $stmt->execute();

                /** Store the query result to a variable. **/
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        /**
        * Edit his/her own account details.
        * @param int
        * @param string
        * @param string
        * @param string
        * @param string
        * @param string
        * @return string
        */
        function editDetails($empID, $username, $lastName, $firstName, $middleName, $address) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("UPDATE employees SET username = :username, lastName = :lastName, firstName = :firstName, middleName = :middleName, address = :address WHERE empID = :empID");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':lastName', $lastName);
                $stmt->bindParam(':firstName', $firstName);
                $stmt->bindParam(':middleName', $middleName);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':empID', $empID);

                /** Execute the query. **/
                $stmt->execute();

                /** Check if edit details was successful. **/
                $count = $stmt->rowCount();
                if($count > 0) {

                    /** Prepare the sql query to be used. **/
                    $stmt = $dbh->prepare("SELECT * FROM employees WHERE empID = :empID");

                    /** Bind the parameters to the sql query. **/
                    $stmt->bindParam(':empID', $_SESSION["empID"]);

                    /** Execute the query. **/
                    $stmt->execute();

                    /** Iterate through the result. **/
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  

                        /** Unset session variables. **/
                        unset($_SESSION["username"]);
                        unset($_SESSION["firstName"]);
                        unset($_SESSION["middleName"]);
                        unset($_SESSION["lastName"]);
                        unset($_SESSION["address"]);
                        unset($_SESSION["position"]);

                        /** Update session variables and assign values from the database. **/
                        $_SESSION["empID"] = $row["empID"];
                        $_SESSION["username"] = $row["username"];
                        $_SESSION["firstName"] = $row["firstName"];
                        $_SESSION["middleName"] = $row["middleName"];
                        $_SESSION["lastName"] = $row["lastName"];
                        $_SESSION["address"] = $row["address"];
                        $_SESSION["position"] = $row["position"];
                    }

                    return "yes";
                }

                else {
                    return "no";
                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        /** 
        * Change password for employee.
        * @param int
        * @param string
        * @param string
        * @return string
        */
        function changePassword($empID, $oldPassword, $newPassword) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("UPDATE employees SET password = :newPassword WHERE empID = :empID AND password = :oldPassword");

                /** Bind the parameters to the sql query. **/
                $oldPassword = sha1($oldPassword);
                $stmt->bindParam(':newPassword', $newPassword);
                $stmt->bindParam(':oldPassword', $oldPassword);
                $stmt->bindParam(':empID', $empID);

                /** Execute the query. **/
                $stmt->execute();

                /** Check if change password was successful. **/
                $count = $stmt->rowCount();
                if($count > 0) {
                    return "yes";
                }

                else {
                    return "no";
                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        /**
        * Check if an employee has clients
        * under him/her.
        * @param int
        * @return boolean
        */
        function hasClients($empID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT * FROM clients WHERE empID = :empID");

                /** Bind the parameter to the sql query. **/
                $stmt->bindParam(':empID', $empID);

                /** Execute the query. **/
                $stmt->execute();

                /** Check if the query has returned a row **/
                if($stmt->fetch(PDO::FETCH_NUM) > 0) {
                    return true;
                }

                else {
                    return false;
                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        /**
        * Generate reports from all shipment 
        * and billing transactions.
        * @param string
        * @param date
        * @param date
        * @return array
        */
        function reports($company, $fromDate, $toDate) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();


                /** company **/
                if($company != 'DEFAULT' && $fromDate == '--' && $toDate == '--') {

                    /** Prepare the sql query to be used. **/
                    $stmt1 = $dbh->prepare("SELECT * FROM shipment JOIN pod ON shipment.shipmentID=pod.shipmentID JOIN billing ON shipment.shipmentID=billing.shipmentID WHERE status != 'Deleted' AND shipperName = :company ORDER BY pickUpDate");

                    /** Bind the parameter to the sql query. **/
                    $stmt1->bindParam(':company', $company);

                    /** Execute the query. **/
                    $stmt1->execute();

                    $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }

                /** company, date **/
                else if($company != 'DEFAULT' && $fromDate != '' && $toDate != '') {

                    /** Prepare the sql query to be used. **/
                    $stmt2 = $dbh->prepare("SELECT * FROM shipment JOIN pod ON shipment.shipmentID=pod.shipmentID JOIN billing ON shipment.shipmentID=billing.shipmentID WHERE status != 'Deleted' AND shipperName = :company AND pickUpDate BETWEEN :fromDate AND :toDate ORDER BY pickUpDate");

                    /** Bind the parameter to the sql query. **/
                    $stmt2->bindParam(':company', $company);
                    $stmt2->bindParam(':fromDate', $fromDate);
                    $stmt2->bindParam(':toDate', $toDate);

                    /** Execute the query. **/
                    $stmt2->execute();

                    $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }

                /** date **/
                else if($company == 'DEFAULT' && $fromDate != '' && $toDate != '') {

                    /** Prepare the sql query to be used. **/
                    $stmt3 = $dbh->prepare("SELECT * FROM shipment JOIN pod ON shipment.shipmentID=pod.shipmentID JOIN billing ON shipment.shipmentID=billing.shipmentID WHERE status != 'Deleted' AND pickUpDate BETWEEN :fromDate AND :toDate ORDER BY pickUpDate");

                    /** Bind the parameter to the sql query. **/
                    $stmt3->bindParam(':fromDate', $fromDate);
                    $stmt3->bindParam(':toDate', $toDate);

                    /** Execute the query. **/
                    $stmt3->execute();

                    $result = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }

                else if($company == 'DEFAULT' && $fromDate == '' && $toDate == '') {

                    /** Prepare the sql query to be used. **/
                    $stmt4 = $dbh->prepare("SELECT * FROM shipment JOIN pod ON shipment.shipmentID=pod.shipmentID JOIN billing ON shipment.shipmentID=billing.shipmentID WHERE status != 'Deleted' ORDER BY pickUpDate");

                    /** Execute the query. **/
                    $stmt4->execute();

                    $result = $stmt4->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }

            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        /**
        * Generate reports from pod transactions.
        * @param string
        * @param date
        * @param date
        * @return array
        */
        function podReports($company, $fromDate, $toDate) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();


                /** company **/
                if($company != 'DEFAULT' && $fromDate == '--' && $toDate == '--') {

                    /** Prepare the sql query to be used. **/
                    $stmt1 = $dbh->prepare("SELECT * FROM shipment JOIN pod ON shipment.shipmentID=pod.shipmentID WHERE status != 'Deleted' AND shipperName = :company ORDER BY pickUpDate");

                    /** Bind the parameter to the sql query. **/
                    $stmt1->bindParam(':company', $company);

                    /** Execute the query. **/
                    $stmt1->execute();

                    $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }

                /** company, date **/
                else if($company != 'DEFAULT' && $fromDate != '' && $toDate != '') {

                    /** Prepare the sql query to be used. **/
                    $stmt2 = $dbh->prepare("SELECT * FROM shipment JOIN pod ON shipment.shipmentID=pod.shipmentID WHERE status != 'Deleted' AND shipperName = :company AND pickUpDate BETWEEN :fromDate AND :toDate ORDER BY pickUpDate");

                    /** Bind the parameter to the sql query. **/
                    $stmt2->bindParam(':company', $company);
                    $stmt2->bindParam(':fromDate', $fromDate);
                    $stmt2->bindParam(':toDate', $toDate);

                    /** Execute the query. **/
                    $stmt2->execute();

                    $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }

                /** date **/
                else if($company == 'DEFAULT' && $fromDate != '' && $toDate != '') {

                    /** Prepare the sql query to be used. **/
                    $stmt3 = $dbh->prepare("SELECT * FROM shipment JOIN pod ON shipment.shipmentID=pod.shipmentID WHERE status != 'Deleted' AND pickUpDate BETWEEN :fromDate AND :toDate ORDER BY pickUpDate");

                    /** Bind the parameter to the sql query. **/
                    $stmt3->bindParam(':fromDate', $fromDate);
                    $stmt3->bindParam(':toDate', $toDate);

                    /** Execute the query. **/
                    $stmt3->execute();

                    $result = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }

                else if($company == 'DEFAULT' && $fromDate == '' && $toDate == '') {

                    /** Prepare the sql query to be used. **/
                    $stmt4 = $dbh->prepare("SELECT * FROM shipment JOIN pod ON shipment.shipmentID=pod.shipmentID WHERE status != 'Deleted' ORDER BY pickUpDate");

                    /** Execute the query. **/
                    $stmt4->execute();

                    $result = $stmt4->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }

            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        /** 
        * For viewing archives.
        * @return array
        */
        function viewArchive() {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT * FROM employees");

                /** Execute the query. **/
                $stmt->execute();

                /** Store the query result to a variable. **/
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>