<?php 
namespace Core;
use PDO;
use PDOException;

class Database
{
    private $host = "localhost";
    private $dbname = "umut";
    private $username = "umut";
    private $password = "umut2024++";
    private $charset = "utf8";
    private static $db;

    public function __construct(){
        if (self::$db === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
                self::$db = new PDO($dsn, $this->username, $this->password);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                exit;
            }

        }
    }

    public static function getDb()
    {
        if (self::$db === null) {
            new self();
    }    

}