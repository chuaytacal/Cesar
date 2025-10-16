<?php
class Database {
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            $dbFile = __DIR__ . '/../data/db.sqlite';
            self::$instance = new PDO('sqlite:' . $dbFile);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}
