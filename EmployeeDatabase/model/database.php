<?php
//Original Author: Jeffrey Kuhn
//Date Created: 1-31-20
//Version: 2 (First Live Version)
//Date Last Modified: 2-12-20
//Modified by: Jeffrey Kuhn
//Modification log: Added class, contructor and changed variables to private
class Database {
    private static $dsn = 'mysql:host=localhost;dbname=larrytables';
    private static $username = 'root';
    private static $password = 'Pa$$w0rd';
    private static $db;
    
    private function __construct() {}

    public static function getDB () {
    
    try {
        self::$db = new PDO(self::$dsn, self::$username, self::$password);
    } catch (PDOException $e) {
        $error = 'Our database must be down for maintenance. Please check back later.';
        include ('error.php');
        exit();
    }
    return self::$db;
    }
 }
?>