<?php
    class Admin extends Employee {

        /**
        * Add new employee to the database.
        * @param string
        * @param string
        * @param string
        * @param string
        * @param string
        * @param string
        * @param string
        * @return boolean
        */
        function addEmployee($username, $password, $lastName, $firstName, $middleName, $address, $position) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("INSERT INTO employees (username, password, lastName, firstName, middleName, address, position) VALUES (:username, :password, :lastName, :firstName, :middleName, :address, :position)");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':lastName', $lastName);
                $stmt->bindParam(':firstName', $firstName);
                $stmt->bindParam(':middleName', $middleName);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':position', $position);

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
        * Edit employee and update the database.
        * @param string
        * @param string
        * @param string
        * @param string
        * @param string
        * @param string
        * @param int
        * @return string
        */
        function editEmployee($username, $lastName, $firstName, $middleName, $address, $position, $empID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("UPDATE employees SET username = :username, lastName = :lastName, firstName = :firstName, middleName = :middleName, address = :address, position = :position WHERE empID = :empID");

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':lastName', $lastName);
                $stmt->bindParam(':firstName', $firstName);
                $stmt->bindParam(':middleName', $middleName);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':position', $position);
                $stmt->bindParam(':empID', $empID);

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
        * Delete employee from the database.
        * @param int
        * @return string
        */
        function deleteEmployee($empID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("UPDATE employees SET isDeleted = :isDeleted WHERE empID = :empID");

                /** Bind the parameters to the sql query. **/
                $isDeleted = "Y";
                $stmt->bindParam(':isDeleted', $isDeleted);
                $stmt->bindParam(':empID', $empID);

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
        * Reset the password of an employee.
        * @param int
        * @return string
        */
        function resetPassword($empID) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("UPDATE employees SET password = :newPassword WHERE empID = :empID");

                /** Bind the parameters to the sql query. **/
                $newPassword = sha1("1234");
                $stmt->bindParam(':newPassword', $newPassword);
                $stmt->bindParam(':empID', $empID);

                /** Execute the query. **/
                $stmt->execute();

                /** Check if reset was successful. **/
                $count = $stmt->rowCount();
                if($count > 0) {
                    return "passwordReset";
                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        /**
        * Search for a specific string in the employees database.
        * @param int
        * @param string
        * @return array
        */
        function searchEmployee($empID, $query) {
            try {
                /** Sanitize the search query. **/
                $query = htmlspecialchars($query);

                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT * FROM employees WHERE isDeleted = 'N' AND empID != ? AND (empID LIKE ? OR username LIKE ? OR lastName LIKE ? OR firstName LIKE ? OR middleName LIKE ? OR address LIKE ? OR position LIKE ?)");

                /** Bind the parameters to the sql query. **/
                $stmt->bindValue(1, $empID);
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
    }
?>