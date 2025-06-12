<?php

namespace Core;
use PDO;

class Database {
    private static $instance = null;
    private $db;

    public function __construct($config) {
        $this->db = new PDO($this->getDsn($config));
    }

    public static function getInstance($config = null) {
        if (self::$instance === null) {
            if ($config === null) {
                throw new \Exception('Database config required on first call');
            }
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    private function getDsn($config) {
        $driver = $config['driver'];
        unset($config['driver']);

        $dsn = $driver . ':' . http_build_query($config, '', ';');

        return $dsn;
    }

    public function query($query, $class = null, $params = []) {
        $prepare = $this->db->prepare($query);

        if ($class && is_string($class)) {
            $prepare->setFetchMode(PDO::FETCH_CLASS, $class);
        }

        $prepare->execute($params);
        return $prepare;
    }

}

$DB = new Database($config['database']);