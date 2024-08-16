<?php

namespace Core;

use App\Models\User;
use App\Models\Patient;
use PDO;
use PDOException;
use Exception;

// MVC için base bir model sınıfı oluştur

class Model
{
    // Veritabanı bağlantısı için PDO nesnesi
    private $db;
    private $table;

    public function __construct()
    {
        // Veritabanı bağlantısını başlat
        $this->db = Database::getDb();
        $this->table = $this->getClassName(); // Correctly assign to $this->table
    }

    public function getClassName()
    {
        // böyle bir değer geliyor App\Controllers\HomeController sadece Home kısmını almak istiyorum
        $class = explode('\\', get_class($this));
        $class = end($class);
        $class = lcfirst($class);
        return $class;
    }

    public function findById($id)
    {
        // Check if database connection is established before executing the query
        if ($this->db === null) {
            throw new Exception('Database connection not established');
        }

        // Check if table name is set
        if (empty($this->table)) {
            throw new Exception('Table name is not set');
        }

        try {
            $query = $this->db->prepare("SELECT * FROM $this->table WHERE id = :id");
            // Bind the id parameter
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Database query error: ' . $e->getMessage());
        }
    }
}