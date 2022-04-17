<?php

namespace PHPMVC\Lib\Database;

class PDODatabaseHandler extends DatabaseHandler
{

    private static $_instance;
    private static $_handler;

    private function __construct()
    {
        self::init();
    }

    protected static function init()
    {
        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        );
        try{
            self::$_handler = new \PDO('mysql:host=' . DATABASE_HOST_NAME . ':' . DATABASE_PORT_NUMBERE . ';dbname=' . DATABASE_DB_NAME,
                                DATABASE_USER_NAME,
                                DATABASE_PASSWORD,
                                $options
                            );
        } catch(\PDOException $e){
            
        }
    }
    protected static function getInstance()
    {
        if(self::$_handler === null){
            new self();
        }

        return self::$_handler;
    }
}