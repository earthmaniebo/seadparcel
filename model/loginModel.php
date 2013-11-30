<?php
    class Login {
        private $username;
        private $password;

        /** Setters **/
        function setUsername($username) {
            $this->username = htmlspecialchars($username);
        }

        function setPassword($password) {

            $this->password = sha1($password);
        }
        /** End setters **/

        /** Getters **/
        function getUsername() {
            return $this->username;
        }

        function getPassword() {
            return $this->password;
        }
        /** End getters **/

        /**
        * Check if username and password exist in the dabatase.
        * @param string
        * @param string
        * @return string
        */
        function userLogin($username, $password) {
            try {
                /** Instantiate the Database model. **/
                $db = Database::getInstance();

                /** Connect to the database. **/
                $dbh = $db->getConnection();

                /** Prepare the sql query to be used. **/
                $stmt = $dbh->prepare("SELECT * FROM employees WHERE username = :username AND password = :password AND isDeleted = :isDeleted");
                $isDeleted = "N";

                /** Bind the parameters to the sql query. **/
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':isDeleted', $isDeleted);

                /** Execute the query. **/
                $stmt->execute();

                /** Check if the query has returned a row **/
                if($stmt->fetch(PDO::FETCH_NUM) > 0) {

                    /** Prepare the sql query to be used. **/
                    $stmt = $dbh->prepare("SELECT * FROM employees WHERE username = :username AND password = :password AND isDeleted = :isDeleted");
                    $isDeleted = "N";

                    /** Bind the parameters to the sql query. **/
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':isDeleted', $isDeleted);

                    /** Execute the query. **/
                    $stmt->execute();
                
                    /** Iterate through the result. **/
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  

                        /** Creates session variables and assign values from the database. **/
                        $_SESSION["empID"] = $row["empID"];
                        $_SESSION["username"] = $row["username"];
                        $_SESSION["firstName"] = $row["firstName"];
                        $_SESSION["middleName"] = $row["middleName"];
                        $_SESSION["lastName"] = $row["lastName"];
                        $_SESSION["address"] = $row["address"];
                        $_SESSION["position"] = $row["position"];

                        /** Identify the position of the employee. **/
                        if($_SESSION["position"] == 'admin') {
                            return "admin";
                        }

                        else if($_SESSION["position"] == 'dataAnalyst') {
                            return "dataAnalyst"; 
                        }
                        
                        else {
                            return "hehe";
                        }
                    }
                }

                else {
                    return "error";
                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>