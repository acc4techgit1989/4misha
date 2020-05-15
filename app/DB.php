<?php

class DB
{
    private static $_instance = null;

    // для безопасности настройки лучше хранить в файле с конфигом
    private static DB_HOST = 'localhost';
    private static DB_NAME = 'Simple_chat';
    private static DB_USER = 'root';
    private static DB_PASS = '';

    private function __construct () {

        $this->_instance = new PDO(
            'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME,
            self::DB_USER,
            self::DB_PASS,
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
            );

    }

    private function __clone () {}
    private function __wakeup () {}

    public static function getInstance()
    {
        if (self::$_instance != null) {
            return self::$_instance;
        }

        return new self;
    }
}
