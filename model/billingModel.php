<?php
    class Billing {
        public $billingID;
        public $shipmentID;
        public $freightCharge;
        public $addOnCharge;
        public $cratingCharge;
        public $osaCharge;
        public $valuationCharge;
        public $totalCharge;

        /** Setters **/
        function setBillingID($billingID) {
            $this->billingID = htmlspecialchars($billingID);
        }

        function setShipmentID($shipmentID) {
            $this->shipmentID = htmlspecialchars($shipmentID);
        }

        function setFreightCharge($freightCharge) {
            $this->freightCharge = htmlspecialchars($freightCharge);
        }

        function setAddOnCharge($addOnCharge) {
            $this->addOnCharge = htmlspecialchars($addOnCharge);
        }

        function setCratingCharge($cratingCharge) {
            $this->cratingCharge = htmlspecialchars($cratingCharge);
        }

        function setOsaCharge($osaCharge) {
            $this->osaCharge = htmlspecialchars($osaCharge);
        }

        function setValuationCharge($valuationCharge) {
            $this->valuationCharge = htmlspecialchars($valuationCharge);
        }

        function setTotalCharge($totalCharge) {
            $this->totalCharge = htmlspecialchars($totalCharge);
        }
        /** End setters **/

        /** Getters **/
        function getBillingID() {
            return $this->billingID;
        }

        function getShipmentID() {
            return $this->shipmentID;
        }

        function getFreightCharge() {
            return $this->freightCharge;
        }

        function getAddOnCharge() {
            return $this->addOnCharge;
        }

        function getCratingCharge() {
            return $this->cratingCharge;
        }

        function getOsaCharge() {
            return $this->osaCharge;
        }

        function getValuationCharge() {
            return $this->valuationCharge;
        }

        function getTotalCharge() {
            return $this->totalCharge;
        }
        /** End getters **/

        /**
        * Retrieve a billing using its shipmentID.
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
                $stmt = $dbh->prepare("SELECT * FROM billing JOIN shipment ON billing.shipmentID=shipment.shipmentID WHERE status != 'Deleted' AND billing.shipmentID = :shipmentID");

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
        * Add a billing entry to the billing table.
        * @param int
        * @param float
        * @param float
        * @param float
        * @param float
        * @param float
        * @param float
        * @return boolean
        */
        function addBilling($shipmentID, $freightCharge, $addOnCharge, $cratingCharge, $osaCharge, $valuationCharge, $totalCharge) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("INSERT INTO billing (shipmentID, freightCharge, addOnCharge, cratingCharge, osaCharge, valuationCharge, totalCharge) VALUES(:shipmentID, :freightCharge, :addOnCharge, :cratingCharge, :osaCharge, :valuationCharge, :totalCharge)");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':shipmentID', $shipmentID);
                $stmt->bindParam(':freightCharge', $freightCharge);
                $stmt->bindParam(':addOnCharge', $addOnCharge);
                $stmt->bindParam(':cratingCharge', $cratingCharge);
                $stmt->bindParam(':osaCharge', $osaCharge);
                $stmt->bindParam(':valuationCharge', $valuationCharge);
                $stmt->bindParam(':totalCharge', $totalCharge);

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
        * Edit a billing entry and update the billing table.
        * @param int
        * @param float
        * @param float
        * @param float
        * @param float
        * @param float
        * @param float
        * @return boolean
        */
        function editBilling($shipmentID, $freightCharge, $addOnCharge, $cratingCharge, $osaCharge, $valuationCharge, $totalCharge) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("UPDATE billing SET freightCharge = :freightCharge, addOnCharge = :addOnCharge, cratingCharge = :cratingCharge, osaCharge = :osaCharge, valuationCharge = :valuationCharge, totalCharge = :totalCharge WHERE billing.shipmentID = :shipmentID");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':freightCharge', $freightCharge);
                $stmt->bindParam(':addOnCharge', $addOnCharge);
                $stmt->bindParam(':cratingCharge', $cratingCharge);
                $stmt->bindParam(':osaCharge', $osaCharge);
                $stmt->bindParam(':valuationCharge', $valuationCharge);
                $stmt->bindParam(':totalCharge', $totalCharge);
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
                $stmt = $dbh->prepare("SELECT * FROM billing");

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