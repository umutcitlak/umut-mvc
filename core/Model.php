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

// tum verileri cek tamamlandı  
    public function all()
    {
        $this->variableNames();
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

    public function create()
    {

        // Check if database connection is established before executing the query
        if ($this->db === null) {
            throw new Exception('Database connection not established');
        }

        // Check if table name is set

        if (empty($this->table)) {
            throw new Exception('Table name is not set');
        }


        // Prepare the SQL query
        $columns = implode(', ', array_values($this->variableNames()));

        $placeholders = ' :' . implode(', :', array_values($this->variableNames()));
        
        $query = $this->db->prepare("INSERT INTO $this->table ($columns) VALUES ($placeholders)");

        // Bind values to the query

        foreach ($this->variableNames() as $key) {
            $query->bindValue(':' . $key, strval($this->$key));
            
        }
      
        // Execute the query
        $query->execute();



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

    public function variableNames()
    {
        $childvars = array_keys(get_class_vars(get_class($this)));


        $parentVars = array_keys(get_class_vars(Model::class));


        $vars = array_diff($childvars, $parentVars);

        return $vars;
    }
}
