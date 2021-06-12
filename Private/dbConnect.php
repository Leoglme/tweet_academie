<?php
/* Connexion à la base MySQL via PDO */
class dbConnect{

    private static $dbHost = "localhost";
    private static $dbName = "common-database";
    private static $dbUser = "root";
    private static $dbUserPassword = "";
    private static $connection = null;
    public static function connect()
    {
        try
        {
            $strConn     = 'mysql:host='.self::$dbHost.';dbname='.self::$dbName.';charset=utf8';    // UTF-8
                            $extraParam    = array(
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // exceptions
                                PDO::ATTR_PERSISTENT => true,                         // stay Connexions
                                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,     // fetch mode by défault
                                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"    // UTF-8
                                );
            self::$connection = new PDO($strConn,self::$dbUser,self::$dbUserPassword,$extraParam);
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }

        return self::$connection;

    }

    public static function disconnect()
    {
        self::$connection = null;
    }
}
dbConnect::connect();
