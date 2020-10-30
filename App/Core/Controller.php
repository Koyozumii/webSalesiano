<?php

namespace App\Core;

use MVC\Di\Container;
use App\Core\Action;

class Controller extends Action{
    
    public function model($model) {
        return Container::getClass($model);
    }
}
