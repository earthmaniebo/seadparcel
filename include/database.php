<?php
    class Database {
        private $_connection;
        private static $_instance;

        /**
        * Instantiate the Databse class.
        * @return object
        */
        public static function getInstance() {
            if(!self::$_instance) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
        * Connect to the database using PDO.
        * This function is called whenever a new
        * Database class is instantiated.
        */
        public function __construct() {
            $this->_connection = new PDO("mysql:host=localhost;dbname=seadparcel", 'root', 'maniebo12', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        }

        /** PHP magic method to avoid duplicate connection **/
        private function __clone() {}

        /**
        * Provide the database connection to any
        * class who called this function.
        */
        public function getConnection() {
            return $this->_connection;
        }
    }
?>