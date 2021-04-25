<?php

class Core {
    protected $currentController = "Client";
    protected $currentMethod = "index";
    protected $params = [];

    public function __construct() {
        $url = $this->getUrl();

        // Checa que partes da URL foram informadas
		if(isset($url[0]) && isset($url[1])) {
		    // Caso se informe o controller e o método
            if(file_exists("controllers/".ucwords($url[0]).".php") && method_exists(ucwords($url[0]), $url[1])) {
			    $this->currentController = ucwords($url[0]);
                $this->currentMethod = $url[1];

                unset($url[0]);
                unset($url[1]);
			}
		}

        // Requisita o controller
        require_once "controllers/".$this->currentController.".php";
        $this->currentController = new $this->currentController;

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
