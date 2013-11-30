<?php
    class AuditTrail {
        public $auditID;
        public $empID;
        public $action;
        public $dateNtime; 

        /** Setters **/
        function setAuditID($auditID) {
            $this->auditID = htmlspecialchars($auditID);
        }

        function setEmpID($empID) {
            $this->empID = htmlspecialchars($empID);
        }

        function setAction($action) {
            $this->action = htmlspecialchars($action);
        }

        function setDateNtime($dateNtime) {
            $this->dateNtime = htmlspecialchars($dateNtime);
        }
        /** End setters **/

        /** Getters **/
        function getAuditID() {
            return $this->auditID;
        }

        function getEmpID() {
            return $this->empID;
        }

        function getAction() {
            return $this->action;
        }

        function getDateNtime() {
            return $this->dateNtime;
        }
        /** End getters **/

        /**
        * Add new audit trail to the dabatase.
        * @param int
        * @param string
        * @return boolean
        */
        function addAuditTrail($empID, $action) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("INSERT INTO audittrail (empID, action, dateNtime) VALUES (:empID, :action, NOW())");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':empID', $empID);
                $stmt->bindParam(':action', $action);

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
        * Retrieve all audit trail
        * @return array
        */
        function displayAll() {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT * FROM audittrail JOIN employees ON employees.empID=audittrail.empID ORDER BY dateNtime desc");

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