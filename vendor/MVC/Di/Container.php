<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MVC\Di;


class Container {
    public static function getClass($name) {
        $str_class = "\\App\\Models\\Dao\\".  ucfirst($name);
        $class = new $str_class(\App\Init::getDB());
        return $class;
    }
}
