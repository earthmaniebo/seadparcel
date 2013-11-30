<?php
    class DataAnalyst extends Employee {
        
        /** 
        * Retrieve all data analyst
        * @return array
        */
        function displayAll() {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT * FROM employees WHERE position = :position AND isDeleted = 'N'");

                /** Bind the parameters to the sql query. **/
                $position = "dataAnalyst";
                $stmt->bindParam(':position', $position);

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
        * Print transaction
        * @param int
        * @return array
        */
        function printTransaction($shipmentID, $hasBilling) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                if($hasBilling == "Y") {
                    /** Prepare the sql query to be used. **/
                    $stmt = $dbh->prepare("SELECT * FROM shipment JOIN billing ON shipment.shipmentID=billing.shipmentID WHERE status != 'Deleted' AND shipment.shipmentID = :shipmentID");

                    /** Bind the parameters to the sql query. **/
                    $stmt->bindParam(':shipmentID', $shipmentID);

                        /** Execute the query. **/
                    $stmt->execute();

                    /** Store the query result to a variable. **/
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    return $result;
                }

                else {
                    /** Prepare the sql query to be used. **/
                    $stmt = $dbh->prepare("SELECT * FROM shipment WHERE status != 'Deleted' AND shipment.shipmentID = :shipmentID");

                    /** Bind the parameters to the sql query. **/
                    $stmt->bindParam(':shipmentID', $shipmentID);

                        /** Execute the query. **/
                    $stmt->execute();

                    /** Store the query result to a variable. **/
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    return $result;
                }

                
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>