<?php

class App {
    protected $controller = 'HomeController';  // Controller padrão
    protected $method = 'index';              // Método padrão
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();

        // Se existir o controller na URL, use ele
        if(isset($url[0]) && file_exists('app/controllers/' . $url[0] . 'Controller.php')) {
            $this->controller = $url[0] . 'Controller';
            unset($url[0]);
        }

        // Carrega o controller
        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Se existir o método na URL, use ele
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Pega os parâmetros
        $this->params = $url ? array_values($url) : [];

        // Chama o método do controller com os parâmetros
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseURL() {
        if(isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}

?>
