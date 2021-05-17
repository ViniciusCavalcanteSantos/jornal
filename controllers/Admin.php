<?php
class Admin extends Controller {
    
    public function __construct(){
        parent::__construct();
        $this->usersModel = $this->model("Users");
        $this->noticesModel = $this->model("Notices");
    }

    public function login() {
//        $this->usersModel->login("emailparatestes.com.br", "senhaparatestes");

        $email = filter_input(INPUT_POST, "email",FILTER_VALIDATE_EMAIL);
        $user_name = filter_input(INPUT_POST, "user_name",FILTER_DEFAULT);
        $password = filter_input(INPUT_POST, "password",FILTER_DEFAULT);

        if ($email and $user_name and $password) {
            $data = [
                "erro" => $this->usersModel->login($email, $user_name, $password),
            ];
        }else {
            $data ["erro"] = null;
        }

        $this->view("admin/login", $data);
    }

    // Gerenciamento de noticias
    public function painel() {
        // Checa se existe uma seção
        $this->usersModel->checkLogin();

        if(!empty($_POST["requestxhr"])) {
            if ($_POST["requestxhr"] === "deletenotice") {
                $this->noticesModel->deleteNotice($_POST["id"]);
            }

            if ($_POST["requestxhr"] === "toggleactive") {
                $this->noticesModel->toggleActive($_POST["id"]);
            }
            die();
        }

        $notices = $this->noticesModel->getNotices();
        $data = [
            "notices" => $notices,
            "profile" => $this->usersModel->profileSetup($_SESSION['id']),
        ];

        $this->view("admin/painel", $data);
    }

    // Criação e edição de noticias
    public function editor($id = null) {
        // Checa se existe uma seção
        $this->usersModel->checkLogin();
        
        // Verifica se a requisição é por xhr
        if(!empty($_POST["requestxhr"])) {
            if($_POST["requestxhr"] === "uploadimage") {
                $this->noticesModel->uploadImage();
            }

            if($_POST["requestxhr"] === "savenotice") {
                $this->noticesModel->saveNotice();
            }

            die();
        }

        // Pega a noticia caso já exista
        if($id) {
            $data["notice"] = $this->noticesModel->getNotice($id);
        }

        $data["profile"] = $this->usersModel->profileSetup($_SESSION['id']);

        $this->view("admin/editor", $data);
    }

    public function logout() {
        session_destroy();
        header('location:'.URLROOT);
        die();
    }
}