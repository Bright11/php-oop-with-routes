<?php

class Database
{
    protected $conn;

    public function __construct()
    {
        $host = 'localhost';
        $dbname = 'php_mvc_crud';  // Make sure the database exists
        $user = 'root';
        $pass = '';

        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
            $this->conn = new PDO($dsn, $user, $pass, $options);

            //   echo "Database connection successful.<br>";
            $this->runMigrations();  // Run migrations after successful connection

        } catch (PDOException $e) {
            die("DB Connection Failed: " . $e->getMessage());
        }
    }

    protected function runMigrations()
    {
        // $migrationDir = __DIR__ . '/../migrations';  // Path to the migrations directory
        $migrationDir = __DIR__ . '/migrations';

        $migrationFiles = glob($migrationDir . '/*.php'); // Get all PHP files in the migrations folder

        if (empty($migrationFiles)) {
            echo "No migration files found.<br>";
            return;
        }

        // echo "Running migrations...<br>";

        foreach ($migrationFiles as $file) {
            include $file;  // Include the migration file, which should set $sql
            if (isset($sql)) {
                try {
                    //  echo "Running migration: $file<br>";  // Display the name of the current migration file
                    $this->conn->exec($sql);  // Execute the SQL
                    //  echo "Migration executed successfully.<br>";
                } catch (PDOException $e) {
                    echo "Error in migration ($file): " . $e->getMessage() . "<br>";
                }
                unset($sql);  // Clear the $sql variable for the next migration
            }
        }
    }
}
