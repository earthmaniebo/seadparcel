<?php
    class Pod {
        public $podID;
        public $shipmentID;
        public $receivedBy;
        public $dateReceived;
        public $timeReceived;
        public $relToCon;
        public $remarks;

        /** Setters **/
        function setPodID($podID) {
            $this->podID = htmlspecialchars($podID);
        }

        function setShipmentID($shipmentID) {
            $this->shipmentID = htmlspecialchars($shipmentID);
        }

        function setReceivedBy($receivedBy) {
            $this->receivedBy = htmlspecialchars($receivedBy);
        }

        function setDateReceived($dateReceived) {
            $this->dateReceived = htmlspecialchars($dateReceived);
        }

        function setTimeReceived($timeReceived) {
            $this->timeReceived = htmlspecialchars($timeReceived);
        }

        function setRelToCon($relToCon) {
            $this->relToCon = htmlspecialchars($relToCon);
        }

        function setRemarks($remarks) {
            $this->remarks = htmlspecialchars($remarks);
        }
        /** End setters **/

        /** Getters **/
        function getPodID() {
            return $this->podID;
        }

        function getShipmentID() {
            return $this->shipmentID;
        }

        function getReceivedBy() {
            return $this->receivedBy;
        }

        function getDateReceived() {
            return $this->dateReceived;
        }

        function getTimeReceived() {
            return $this->timeReceived;
        }

        function getRelToCon() {
            return $this->relToCon;
        }

        function getRemarks() {
            return $this->remarks;
        }
        /** End getters **/

        /**
        * Retrieve a pod using its shipmentID.
        * @param int
        * @return array
        */
        function selectUsingShipmentID($shipmentID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT podID, pod.shipmentID, receivedBy, dateReceived, timeReceived, relToCon, pod.remarks remarksPod FROM pod JOIN shipment ON pod.shipmentID=shipment.shipmentID WHERE status != 'Deleted' AND pod.shipmentID = :shipmentID");

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
        * Add a pod entry to the pod table.
        * @param int
        * @param string
        * @param date
        * @param time
        * @param string
        * @param string
        * @return boolean
        */
        function addPod($shipmentID, $receivedBy, $dateReceived, $timeReceived, $relToCon, $remarks) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("INSERT INTO pod (shipmentID, receivedBy, dateReceived, timeReceived, relToCon, remarks) VALUES (:shipmentID, :receivedBy, :dateReceived, :timeReceived, :relToCon, :remarks)");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':shipmentID', $shipmentID);
                $stmt->bindParam(':receivedBy', $receivedBy);
                $stmt->bindParam(':dateReceived', $dateReceived);
                $stmt->bindParam(':timeReceived', $timeReceived);
                $stmt->bindParam(':relToCon', $relToCon);
                $stmt->bindParam(':remarks', $remarks);

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
        * Edit a pod entry and update the pod table.
        * @param int
        * @param string
        * @param date
        * @param time
        * @param string
        * @param string
        * @return boolean
        */
        function editPod($shipmentID, $receivedBy, $dateReceived, $timeReceived, $relToCon, $remarks) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("UPDATE pod SET receivedBy = :receivedBy, dateReceived = :dateReceived, timeReceived = :timeReceived, relToCon = :relToCon, remarks = :remarks WHERE pod.shipmentID = :shipmentID");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':receivedBy', $receivedBy);
                $stmt->bindParam(':dateReceived', $dateReceived);
                $stmt->bindParam(':timeReceived', $timeReceived);
                $stmt->bindParam(':relToCon', $relToCon);
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
                $stmt = $dbh->prepare("SELECT * FROM pod");

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