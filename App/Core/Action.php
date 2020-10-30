<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Core;


class Action {
    
    protected $view;
    protected $action;

    public function __construct() {
        $this->view = new \stdClass();
    }
    
    public function render($action, $layout = true) {
        $this->action = $action;
        
        if($layout == true && file_exists('../App/Views/layout.phtml')){
            $this->layout();
        }else{
            $this->content();   
        }
    }
    
    public function content() {
        $atual = get_class($this);
        $singleClassName = strtolower(str_replace("App\\Controllers\\", "", $atual));

        include_once '../App/Views/'.$singleClassName.'/'.$this->action.'.phtml'; 
    }
    
    public function layout() {
        include_once '../App/Views/layout.phtml';
    }
}
