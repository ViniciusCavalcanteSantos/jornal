<?php
// Autoload
spl_autoload_register(function ($class) {
    // Chama o Controller
    if (file_exists("controllers/".$class.".php")) {
        require_once "controllers/".$class.".php";
    }
    
    // Chama o Modelo
    if (file_exists('models/'.$class.'.php')) {
        require_once "models/".$class.".php";
    }
    
    // Chama o Core
    if(file_exists('core/'.$class.'.php')) {
        require_once "core/".$class.".php";
    }
});

global $config;

// Parâmetros para o banco de dados
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "jornal");

// BASE_URL (links dinâmicos)
define("URLROOT", "http://localhost/jornal-");

// APPROOT
define("APPROOT", dirname(dirname(__FILE__)));

// NOME DO SITE
define("SITENAME", "MVC Structure");