<?php

namespace App;

class Init{
    public static function getDB() {
        $db = new \PDO('mysql:host=localhost;'
                                    . 'dbname=websalesiano',
                                      'root', '');
        return $db;
    }
}


