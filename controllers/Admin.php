<?php
class Admin extends Controller {
    
    public function __construct(){
        $this->usersModel = $this->model("Users");
        $this->noticesModel = $this->model("Notices");
    }

    public function login() {
        $this->usersModel->login("emailparatestes.com.br", "senhaparatestes");
        
        $this->view("admin/login");
    }

    // Gerenciamento de noticias
    public function painel() {
        // Checa se existe uma seção
        session_start();
        if(!isset($_SESSION["email"]) || !isset($_SESSION["password"])) {
            header("location: " . URLROOT);
        }

        if(!empty($_POST["requestxhr"])) {
            if ($_POST["requestxhr"] === "deletenotice") {
                $this->noticesModel->deleteNotice($_POST["id"]);
            }
            die();
        }

        $notices = $this->noticesModel->getNotices();
        $data = [
            "notices" => $notices,
        ];

        $this->view("admin/painel", $data);
    }

    // Criação e edição de noticias
    public function editor($id = null) {
        // Checa se existe uma seção
        session_start();
        if(!isset($_SESSION["email"]) || !isset($_SESSION["password"])) {
            header("location: " . URLROOT);
        }
        
        // Verifica se a requisição é por xhr
        if(!empty($_POST["requestxhr"])) {
            // Verifica qual a requisição
            if($_POST["requestxhr"] === "createnotice") {
                $this->noticesModel->createNotice($_POST["title"]);
            }

            if($_POST["requestxhr"] === "uploadimage") {
                $this->noticesModel->uploadImage();
            }

            if($_POST["requestxhr"] === "savenotice") {
                $this->noticesModel->saveNotice();
            }

            if($_POST["requestxhr"] === "postnotice") {
                $this->noticesModel->saveNotice(true);
            }

            die();
        }

        // Pega a noticia caso já exista
        if($id) {
            $data = ["notice" => $this->noticesModel->getNotice($id)];
        } else {
            $data = ["notice" => null];
        }

        $this->view("admin/editor", $data);
    }

    public function logout() {
        session_destroy($_SESSION['loginPaniel']);
        header('location:' . URLROOT);
        die();
    }
}