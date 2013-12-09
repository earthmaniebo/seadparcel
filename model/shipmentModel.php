<?php
    class Shipment {
        public $shipmentID;
        public $clientID;
        public $seadawbnum;
        public $refNum;
        public $shipperName;
        public $conName;
        public $designation;
        public $conAddress;
        public $state;
        public $conContactNum;
        public $pickUpDate;
        public $descOfGoods;
        public $totalWeight;
        public $remarks;
        public $status;

        /** Setters **/
        function setShipmentID($shipmentID) {
            $this->shipmentID = htmlspecialchars($shipmentID);
        }

        function setClientID($clientID) {
            $this->clientID = htmlspecialchars($clientID);
        }

        function setSeadawbnum($seadawbnum) {
            $this->seadawbnum = htmlspecialchars($seadawbnum);
        }

        function setRefNum($refNum) {
            $this->refNum = htmlspecialchars($refNum);
        }

        function setShipperName($shipperName) {
            $this->shipperName = htmlspecialchars($shipperName);
        }

        function setConName($conName) {
            $this->conName = htmlspecialchars($conName);
        }

        function setDesignation($designation) {
            $this->designation = htmlspecialchars($designation);
        }

        function setConAddress($conAddress) {
            $this->conAddress = htmlspecialchars($conAddress);
        }

        function setState($state) {
            $this->state = htmlspecialchars($state);
        }

        function setConContactNum($conContactNum) {
            $this->conContactNum = htmlspecialchars($conContactNum);
        }

        function setPickUpDate($pickUpDate) {
            $this->pickUpDate = htmlspecialchars($pickUpDate);
        }

        function setDescOfGoods($descOfGoods) {
            $this->descOfGoods = htmlspecialchars($descOfGoods);
        }

        function setTotalWeight($totalWeight) {
            $this->totalWeight = htmlspecialchars($totalWeight);
        }

        function setRemarks($remarks) {
            $this->remarks = htmlspecialchars($remarks);
        }

        function setStatus($status) {
            $this->status = htmlspecialchars($status);
        }
        /** End setters **/

        /** Getters **/
        function getShipmentID() {
            return $this->shipmentID;
        }

        function getClientID() {
            return $this->clientID;
        }

        function getSeadawbnum() {
            return $this->seadawbnum;
        }

        function getRefNum() {
            return $this->refNum;
        }

        function getShipperName() {
            return $this->shipperName;
        }

        function getConName() {
            return $this->conName;
        }

        function getDesignation() {
            return $this->designation;
        }

        function getConAddress() {
            return $this->conAddress;
        }

        function getState() {
            return $this->state;
        }

        function getConContactNum() {
            return $this->conContactNum;
        }

        function getPickUpDate() {
            return $this->pickUpDate;
        }

        function getDescOfGoods() {
            return $this->descOfGoods;
        }

        function getTotalWeight() {
            return $this->totalWeight;
        }

        function getRemarks() {
            return $this->remarks;
        }

        function getStatus() {
            return $this->status;
        }
        /** End getters **/

        /**
        * Retrieve a shipment using its shipmentID.
        * @param int
        * return array
        */
        function selectUsingShipmentID($shipmentID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT * FROM shipment JOIN clients ON shipment.clientID=clients.clientID WHERE status != 'Deleted' AND shipmentID = :shipmentID");

                /** Bind the parameter to the sql query. **/
                $stmt->bindParam(':shipmentID', $shipmentID);

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
        * Select all the shipment transaction under
        * the provided empID.
        * @param int
        * @return array
        */
        function selectMyShipment($empID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT shipmentID, clients.empID, name, seadawbnum, refNum, shipperName, conName, descOfGoods, hasBilling, hasPod FROM shipment JOIN clients ON shipment.clientID=clients.clientID WHERE status != 'Deleted' AND clients.empID = :empID");

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
        * Add a shipment entry to the shipment table.
        * @param int
        * @param int
        * @param string
        * @param string
        * @param string
        * @param string
        * @param string
        * @param string
        * @param string
        * @param string
        * @param float
        * @param string
        * @return boolean
        */
        function addShipment($clientID, $seadawbnum, $refNum, $shipperName, $conName, $designation, $conAddress, $state, $conContactNum, $pickUpDate, $descOfGoods, $totalWeight, $remarks) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Query to check if seadawbnum already exists in the database. **/
                $checkExisting = $dbh->prepare("SELECT COUNT(*) FROM shipment WHERE seadawbnum = :seadawbnum");

                /** Bind seadawbnum **/
                $checkExisting->bindParam(':seadawbnum', $seadawbnum);

                /** Execute. **/
                $checkExisting->execute();

                /** Check if there are rows fetch. **/
                if($checkExisting->fetchColumn() > 0) {
                		return "false";
                }

                else {
                		/** Prepare the sql query to be used. **/
		                $stmt = $dbh->prepare("INSERT INTO shipment (clientID, seadawbnum, refNum, shipperName, conName, designation, conAddress, state, conContactNum, pickUpDate, descOfGoods, totalWeight, remarks) VALUES (:clientID, :seadawbnum, :refNum, :shipperName, :conName, :designation, :conAddress, :state, :conContactNum, :pickUpDate, :descOfGoods, :totalWeight, :remarks)");

		                /** Bind the parameters to the sql query. **/
		                $stmt->bindParam(':clientID', $clientID);
		                $stmt->bindParam(':seadawbnum', $seadawbnum);
		                $stmt->bindParam(':refNum', $refNum);
		                $stmt->bindParam(':shipperName', $shipperName);
		                $stmt->bindParam(':conName', $conName);
		                $stmt->bindParam(':designation', $designation);
		                $stmt->bindParam(':conAddress', $conAddress);
		                $stmt->bindParam(':state', $state);
		                $stmt->bindParam(':conContactNum', $conContactNum);
		                $stmt->bindParam(':pickUpDate', $pickUpDate);
		                $stmt->bindParam(':descOfGoods', $descOfGoods);
		                $stmt->bindParam(':totalWeight', $totalWeight);
		                $stmt->bindParam(':remarks', $remarks);

		                /** Execute the query. **/
		                $stmt->execute();

		                /** Check if insert was successful. **/
		                $count = $stmt->rowCount();
		                if($count > 0) {
		                    return "true";
		                }

		                else {
		                    return "false";
		                }
                }

                
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        /**
        * Edit a shipment entry and update the shipment table.
        * @param int
        * @param int
        * @param int
        * @param string
        * @param string
        * @param string
        * @param string
        * @param string
        * @param string
        * @param string
        * @param string
        * @param float
        * @param string
        * @return boolean
        */
        function editShipment($shipmentID, $clientID, $seadawbnum, $refNum, $shipperName, $conName, $designation, $conAddress, $state, $conContactNum, $pickUpDate, $descOfGoods, $totalWeight, $remarks) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("UPDATE shipment SET shipment.clientID = :clientID, seadawbnum = :seadawbnum, refNum = :refNum, shipperName = :shipperName, conName = :conName, designation = :designation, conAddress = :conAddress, state = :state, conContactNum = :conContactNum, pickUpDate = :pickUpDate, descOfGoods = :descOfGoods, totalWeight = :totalWeight, remarks = :remarks WHERE shipment.shipmentID = :shipmentID");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':clientID', $clientID);
                $stmt->bindParam(':seadawbnum', $seadawbnum);
                $stmt->bindParam(':refNum', $refNum);
                $stmt->bindParam(':shipperName', $shipperName);
                $stmt->bindParam(':conName', $conName);
                $stmt->bindParam(':designation', $designation);
                $stmt->bindParam(':conAddress', $conAddress);
                $stmt->bindParam(':state', $state);
                $stmt->bindParam(':conContactNum', $conContactNum);
                $stmt->bindParam(':pickUpDate', $pickUpDate);
                $stmt->bindParam(':descOfGoods', $descOfGoods);
                $stmt->bindParam(':totalWeight', $totalWeight);
                $stmt->bindParam(':remarks', $remarks);
                $stmt->bindParam(':shipmentID', $shipmentID);

                /** Execute the query. **/
                $stmt->execute();

                /** Check if update was successful. **/
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
        * Update the status of a shipment using
        * shipmentID.
        * @param int
        * @return boolean
        */
        function updateStatus($shipmentID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("UPDATE shipment SET status = 'Received' WHERE shipmentID = :shipmentID");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':shipmentID', $shipmentID);

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
        * Update the hasPod of a shipment using
        * shipmentID.
        * @param int
        * @return boolean
        */
        function updateHasPod($shipmentID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("UPDATE shipment SET hasPod = 'Y' WHERE shipmentID = :shipmentID");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':shipmentID', $shipmentID);

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
        * Update the hasBilling of a shipment using
        * shipmentID.
        * @param int
        * @return boolean
        */
        function updateHasBilling($shipmentID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("UPDATE shipment SET hasBilling = 'Y' WHERE shipmentID = :shipmentID");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':shipmentID', $shipmentID);

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
        * Search for a specific string in the shipment table.
        * @param string
        * @return array
        */
        function searchMyShipment($empID, $query) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT shipmentID, clients.empID, name, seadawbnum, refNum, shipperName, conName, descOfGoods, hasPod, hasBilling FROM shipment JOIN clients ON shipment.clientID=clients.clientID JOIN employees ON clients.empID=employees.empID WHERE status != 'Deleted' AND clients.empID = ? AND seadawbnum LIKE ?");

                /** Bind the parameter to the sql query. **/
                $stmt->bindValue(1, "$empID");
                $stmt->bindValue(2, "$query");

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
                $stmt = $dbh->prepare("SELECT * FROM shipment");

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
        * Track using seadawbnum
        * @param string
        * @return array
        */
        function track($seadawbnum) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT * FROM shipment WHERE status != 'Deleted' AND  seadawbnum = :seadawbnum");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':seadawbnum', $seadawbnum);

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
        * Set the status of a shipment to deleted.
        * @param int
        * @return boolean
        */
        function deleteShipment($shipmentID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("UPDATE shipment SET status = 'Deleted' WHERE shipmentID = :shipmentID");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':shipmentID', $shipmentID);

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
    }
?>