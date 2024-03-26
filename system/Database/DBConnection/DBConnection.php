<?php

namespace System\Database\DBConnection;

use PDO;
use PDOException;

class DBConnection
{
    // Singleton instance of the database connection
    private static $dbConnectionInstance = null;

    // Private constructor to prevent direct instantiation
    private function __construct()
    {
    }

    /**
     * Retrieves the singleton instance of the database connection.
     *
     * @return PDO|null The PDO instance representing the database connection
     */
    public static function getDBConnectionInstance()
    {
        // If the instance is not initialized, create a new one
        if (self::$dbConnectionInstance == null) {
            $DBConnectionInstance = new DBConnection();
            self::$dbConnectionInstance = $DBConnectionInstance->dbConnection();
        }

        // Return the singleton instance
        return self::$dbConnectionInstance;
    }

    /**
     * Establishes a new database connection.
     *
     * @return PDO|false The PDO instance representing the database connection, or false on failure
     */
    private function dbConnection()
    {
        // Set PDO options for error handling and result fetching
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

        try {
            // Attempt to establish a new PDO connection using database credentials
            return new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD, $options);
        } catch (PDOException $e) {
            // Handle any exceptions that occur during database connection
            echo "Error in database connection: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Retrieves the last inserted ID from the database connection.
     *
     * @return string The last inserted ID
     */
    public static function newInsertId()
    {
        // Get the last inserted ID from the database connection
        return self::getDBConnectionInstance()->lastInsertId();
    }
}
