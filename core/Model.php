<?php

namespace Core;

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
        $table = $this->getClassName();
        // sadece ilk harfini küçültür
        $this->table = lcfirst($table);

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
            $query->bindParam(':id', $id);
            $query->execute();

            return $query->fetch();
        } catch (PDOException $e) {
            // Handle any PDO exceptions that occur during the query execution
            throw new Exception('Error executing the query: ' . $e->getMessage());
        }
    }


    public function all()
    {

        // Check if database connection is established before executing the query
        if ($this->db === null) {
            throw new Exception('Database connection not established');
        }

        try {
            // Prepare the SQL query
            $query = $this->db->prepare("SELECT * FROM $this->table");

            // Execute the query
            $query->execute();

            // Fetch all rows as an associative array
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle any PDO exceptions that occur during the query execution
            throw new Exception('Error executing the query: ' . $e->getMessage());
        }
    }

    public function create($data)
    {
        // Check if database connection is established before executing the query
        if ($this->db === null) {
            throw new Exception('Database connection not established');
        }

        // Check if table name is set
        if (empty($this->table)) {
            throw new Exception('Table name is not set');
        }

        // Check if data is provided
        if (empty($data)) {
            throw new Exception('Data is required to create a new record');
        }

        // Extract keys of the data array
        $keys = array_keys($data);

        // Prepare the SQL query
        $query = $this->db->prepare("INSERT INTO $this->table (" . implode(',', $keys) . ") VALUES (:" . implode(',:', $keys) . ")");

        // Bind values to the query
        foreach ($data as $key => $value) {
            $query->bindValue(':' . $key, $value);
        }

        // Execute the query
        return $query->execute();
    }

    public function update($id, $data)
    {
        // Check if database connection is established before executing the query
        if ($this->db === null) {
            throw new Exception('Database connection not established');
        }

        // Check if table name is set
        if (empty($this->table)) {
            throw new Exception('Table name is not set');
        }

        // Check if data is provided
        if (empty($data)) {
            throw new Exception('Data is required to update the record');
        }

        // Extract keys of the data array
        $keys = array_keys($data);

        // Prepare the SQL query
        $query = $this->db->prepare("UPDATE $this->table SET " . implode(',:', $keys) . " WHERE id = :id");

        // Bind values to the query
        foreach ($data as $key => $value) {
            $query->bindValue(':' . $key, $value);
        }

        // Bind the ID parameter
        $query->bindValue(':id', $id);

        // Execute the query
        return $query->execute();
    }


    public function delete($id)
    {
        // Check if database connection is established before executing the query
        if ($this->db === null) {
            throw new Exception('Database connection not established');
        }

    }
}
