<?php

class Core {
    protected $currentController = "client";
    protected $currentMethod = "index";
    protected $params = [];

    public function __construct() {
        $url = $this->getUrl();

        // Procura em "controllers" pelo primeiro URL do array, ucwords capitaliza a primeira letra
		if(isset($url[0])) {
			if(file_exists("controllers/".ucwords($url[0]).".php")) {
			    $this->currentController = ucwords($url[0]);
			    unset($url[0]);
			}
		}

        // Requisita o controller
        require_once "controllers/".$this->currentController.".php";
        $this->currentController = new $this->currentController;

        // Checa a segunda parte da URL
        if(isset($url[1])) {
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // Pega parâmetros
        $this->params = $url ? array_values($url) : [];

        // Chama os atuais controller, e método, mais qualquer parametro passado para o método
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl() {
        if(isset($_GET["url"])) {
            // Filtra a url, remove caracteres especiais
            $url = rtrim($_GET["url"], "/");
            $url = filter_var($url, FILTER_SANITIZE_URL);
			
            // Separa em um array
            $url = explode("/", $url);
            return $url;
			
        }
    }
}
