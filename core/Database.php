<?php 
namespace Core;
use PDO;
use PDOException;

class Database
{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $charset;
    private static $db;

    public function __construct(){
        $this->host = getenv('DB_HOST') ?: 'localhost';
        $this->dbname = getenv('DB_NAME') ?: 'umut';
        $this->username = getenv('DB_USER') ?: 'umut';
        $this->password = getenv('DB_PASS') ?: 'umut2024++';
        $this->charset = getenv('DB_CHARSET') ?: 'utf8';

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
            self::$db = new PDO($dsn, $this->username, $this->password);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log("Connection failed: " . $e->getMessage());
            throw new \Exception("Database connection error");
        }
    }

    public static function getDb()
    {
        if (self::$db == null) {
            new self();
        }
        return self::$db;
    }
}