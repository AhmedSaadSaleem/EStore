<?php

namespace PHPMVC\Lib\Database;
abstract class DatabaseHandler
{

    const DATABASE_DRIVER_PDO = 1;
    const DATABASE_DRIVER_MSQLI = 2;

    public function __construct(){}

    abstract protected static function init();
    abstract protected static function getInstance();

    public static function factory(): object
    {
        $driver = DATABASE_CONN_DRIVER;
        if($driver == self::DATABASE_DRIVER_PDO){
            return PDODatabaseHandler::getInstance();
        } else {
            return MySqliDatabaseHandler::getInstance();
        }
    }
}