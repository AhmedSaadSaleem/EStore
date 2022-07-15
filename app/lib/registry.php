<?php

namespace PHPMVC\Lib;

class Registry
{

    private static $_instance;
    
    private function __construct() {}

    private function __clone(): void {}

    public static function getInstance(): mixed
    {
        if(self::$_instance === null){
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __set($key, $object): void
    {
        $this->$key = $object;
    }

    public function __get($key): mixed
    {
        return $this->$key;
    }
}