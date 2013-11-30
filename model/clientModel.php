<?php
    class Client {
        public $clientID;
        public $empID;
        public $name;
        public $address;
        public $contactNum;
        public $contactPerson;
        private $isDeleted;

        /** Setters **/
        function setClientID($clientID) {
            $this->clientID = htmlspecialchars($clientID);
        }

        function setEmpID($empID) {
            $this->empID = htmlspecialchars($empID);
        }

        function setName($name) {
            $this->name = htmlspecialchars($name);
        }

        function setAddress($address) {
            $this->address = htmlspecialchars($address);
        }

        function setContactNum($contactNum) {
            $this->contactNum = htmlspecialchars($contactNum);
        }

        function setContactPerson($contactPerson) {
            $this->contactPerson = htmlspecialchars($contactPerson);
        }

        function setIsDeleted($isDeleted) {
            $this->isDeleted = htmlspecialchars($isDeleted);
        }
        /** End setters **/

        /** Getters **/
        function getClientID() {
            return $this->clientID;
        }

        function getEmpID() {
            return $this->empID;
        }

        function getName() {
            return $this->name;
        }

        function getAddress() {
            return $this->address;
        }

        function getContactNum() {
            return $this->contactNum;
        }

        function getContactPerson() {
            return $this->contactPerson;
        }

        function getIsDeleted() {
            return $this->isDeleted;
        }
        /** End getters **/

        /**
        * Retrieve all data analyst with their
        * respective clients.
        * @return array
        */
        function selectClientWithDataAnalyst() {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT clients.clientID, clients.empID, name, clients.address cAddress, contactNum, contactPerson, firstName, lastName FROM clients JOIN employees ON clients.empID=employees.empID WHERE clients.isDeleted='N'");

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
        * Retrieve all clients.
        * @return array
        */
        function displayAll() {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT * FROM clients WHERE  isDeleted = 'N' ORDER BY name");

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
        * Retrieve all clients except
        * the provided clientID.
        * @param int
        * @param int
        * @return array
        */
        function selectAllExcept($empID, $clientID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT clients.clientID, clients.empID, name, clients.address cAddress, contactNum, contactPerson, firstName, lastName FROM clients JOIN employees ON clients.empID=employees.empID WHERE clients.isDeleted='N' AND clients.empID = :empID AND clients.clientID != :clientID");

                /** Bind the parameter to the sql query. **/
                $stmt->bindParam(':empID', $empID);
                $stmt->bindParam(':clientID', $clientID);

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
        * Retrieve a client using its clientID.
        * @param int
        * @return array
        */
        function selectUsingClientID($clientID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT * FROM clients WHERE clientID = :clientID");

                /** Bind the parameter to the sql query. **/
                $stmt->bindParam(':clientID', $clientID);

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
        * Retrieve a client using its empID.
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
                $stmt = $dbh->prepare("SELECT clients.clientID, clients.empID, name, clients.address cAddress, contactNum, contactPerson, firstName, lastName FROM clients JOIN employees ON clients.empID=employees.empID WHERE clients.isDeleted='N' AND clients.empID = :empID");

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
        * Add new client to the database.
        * @param int
        * @param string
        * @param string
        * @param string
        * @param string
        * @return boolean
        */
        function addClient($empID, $name, $address, $contactNum, $contactPerson) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("INSERT INTO clients (empID, name, address, contactNum, contactPerson) VALUES (:empID, :name, :address, :contactNum, :contactPerson)");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':empID', $empID);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':contactNum', $contactNum);
                $stmt->bindParam(':contactPerson', $contactPerson);

                /** Execute the query. **/
                $stmt->execute();

                /** Check if insert was successful. **/
                $count = $stmt->rowCount();
                if($count > 0) {
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
        * Edit client and update the database.
        * @param int
        * @param int
        * @param string
        * @param string
        * @param string
        * @param string
        * @return string
        */
        function editClient($clientID, $empID, $name, $address, $contactNum, $contactPerson) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("UPDATE clients SET empID = :empID, name = :name, address = :address, contactNum = :contactNum, contactPerson = :contactPerson WHERE clientID = :clientID");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':empID', $empID);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':contactNum', $contactNum);
                $stmt->bindParam(':contactPerson', $contactPerson);
                $stmt->bindParam(':clientID', $clientID);

                /** Execute the query. **/
                $stmt->execute();

                /** Check if update was successful. **/
                $count = $stmt->rowCount();
                if($count > 0) {
                    return "updated";
                }
                
                else {
                    return "error";
                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        /**
        * Delete client from the database.
        * @param int
        * @return string
        */
        function deleteClient($clientID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("UPDATE clients SET isDeleted = :isDeleted, empID = null WHERE clientID = :clientID");

                /** Bind the parameters to the sql query. **/
                $isDeleted = "Y";
                $stmt->bindParam(':isDeleted', $isDeleted);
                $stmt->bindParam(':clientID', $clientID);

                /** Execute the query. **/
                $stmt->execute();

                /** Check if delete was successful. **/
                $count = $stmt->rowCount();
                if($count > 0) {
                    return "deleted";
                }
                
                else {
                    return "error";
                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        /**
        * Search for a specific string in the clients table.
        * @param string
        * @return array
        */
        function searchClient($query) {
            try {
                /** Sanitize the search query. **/
                $query = htmlspecialchars($query);

                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT clients.clientID, clients.empID, name, clients.address cAddress, employees.address, contactNum, contactPerson, firstName, lastName, middleName, username FROM clients JOIN employees ON clients.empID=employees.empID WHERE clients.isDeleted = 'N' AND (clients.empID LIKE ? OR username LIKE ? OR lastName LIKE ? OR firstName LIKE ? OR middleName LIKE ? OR clients.address LIKE ? OR name LIKE ? OR contactPerson LIKE ?)");

                /** Bind the parameters to the sql query. **/
                $stmt->bindValue(1, "%$query%");
                $stmt->bindValue(2, "%$query%");
                $stmt->bindValue(3, "%$query%");
                $stmt->bindValue(4, "%$query%");
                $stmt->bindValue(5, "%$query%");
                $stmt->bindValue(6, "%$query%");
                $stmt->bindValue(7, "%$query%");
                $stmt->bindValue(8, "%$query%");

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
        * Search for a specific string in the clients table.
        * @param string
        * @return array
        */
        function searchMyClient($empID, $query) {
            try {
                /** Sanitize the search query. **/
                $query = htmlspecialchars($query);

                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT clients.clientID, clients.empID, name, clients.address cAddress, employees.address, contactNum, contactPerson, firstName, lastName, middleName, username FROM clients JOIN employees ON clients.empID=employees.empID WHERE clients.isDeleted = 'N' AND (clients.empID LIKE ? OR username LIKE ? OR lastName LIKE ? OR firstName LIKE ? OR middleName LIKE ? OR clients.address LIKE ? OR name LIKE ? OR contactPerson LIKE ?) AND clients.empID = ?");

                /** Bind the parameters to the sql query. **/
                $stmt->bindValue(1, "%$query%");
                $stmt->bindValue(2, "%$query%");
                $stmt->bindValue(3, "%$query%");
                $stmt->bindValue(4, "%$query%");
                $stmt->bindValue(5, "%$query%");
                $stmt->bindValue(6, "%$query%");
                $stmt->bindValue(7, "%$query%");
                $stmt->bindValue(8, "%$query%");
                $stmt->bindValue(9, "$empID");

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
                $stmt = $dbh->prepare("SELECT * FROM clients");

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