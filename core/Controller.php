<?php

// Carrega os models e as views
class Controller {
    public function model($model) {
        // Requisita o arquivo model
        require_once "models/".$model.".php";
        // Instâ3ncia o model
        return new $model();
    }

    // Carrega a view (verifica se existe)
    public function view($view, $data = []) {
        if(file_exists("views/".$view.".php")) {
            require_once "views/".$view.".php";
        } else {
            die("View não existe");
        }
    }

    // Carrega um asset (verifica se existe)
    public function asset($asset, $data = []) {
        if(file_exists("views/".$asset.".php")) {
            require_once "views/".$asset.".php";
        } else {
            die("View não existe");
        }
    }
}