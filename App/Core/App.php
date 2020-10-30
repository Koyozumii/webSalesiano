<?php

namespace App\Core;

class App {
    
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();
        
        //se a posição vier vazia, você destroi ela
        if(empty($url[0])){

            //apaga a posição em branco
            unset($url[0]);
            
            $url[0] = 'index';

            //reordena o array
            $url = array_values($url);
            
        }
        
        //verifica se o controle existe
        if(file_exists('../App/Controllers/' . ucfirst($url[0]) . '.php' )){
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }
        
        //inclui o controle
        require_once '../App/Controllers/' . ucfirst($this->controller) . '.php';
        
        //instancia a classe
        $class = "App\\Controllers\\".ucfirst($this->controller);
        $this->controller = new $class;
        
        //verifica se o metodo existe
        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        
        //se existir parametros reorganiza o array e atribui a params
        $this->params = $url ? array_values($url) :[];
        
        call_user_func_array([$this->controller, $this->method], $this->params);
        
    }
    
    public function parseUrl() {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if($url){
            return $url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
        }
    }
}
