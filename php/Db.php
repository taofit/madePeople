<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Db
 *
 * @author tao
 */
class Db {
    //put your code here
    protected static $connection;
    public function connect() {
        if (!isset(self::$connection)) {
            $config = parse_ini_file('../config.ini');
            self::$connection = new mysqli('localhost', $config['username'], $config['password'], $config['dbname']);
        }
        if (self::$connection === FALSE) {
            return FALSE;
        }
        return self::$connection;
    }
    public function query($query) {
        $connection = $this->connect();
        $result = $connection->query($query);
        return $result;
    }
    /**
     * escape and add quote to the input value for database query
     */
    public function processValue($value) {
        $connection = $this->connect();
        return "'" . $connection->real_escape_string($value) . "'";
    }        
}
