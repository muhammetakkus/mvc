<?php
class Database {
    private $connection;
    private static $instance; //Buraya Dikkat
    private $host = "localhost";
    private $username = "onurcanalp";
    private $password = "12345";
    private $database = "Deneme";

    public static function getInstance() {
        if(!self::$instance) { // instance tanımlı mı bakalım, değilse oluşturalım
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        if(mysqli_connect_error()) {
            trigger_error("MySQLi: " . mysql_connect_error(),E_USER_ERROR);
        }
    }

    // Bağlantının klonlanabilmesini önlemek için boş döndürüyoruz
    private function __clone() { }

    // mysqli bağlantısını döndürelim
    public function getConnection() {
        return $this->connection;
    }
}

/*usage*/
$db = Database::getInstance();
$mysqli = $db->getConnection();