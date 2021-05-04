<?php
class Users {
    private $db; // Armazena o modelo

    public function __construct() {
        $this->db = new Model();
    }

    // Checa se está logado
    public function checkLogin() {
        if (!isset($_SESSION['id']) || empty($_SESSION['id']) ) {

            header("location: ".URLROOT."/admin/login");
            die();
        }
    }

    // Faz o login do usúario
    public function login($email, $user_name, $password) {
        $message = '';

//        $this->db->query("SELECT * FROM usuarios where senha = ':password' and email = ':email'");
        $this->db->query("SELECT * FROM usuarios where user_name = :user_name");
        $this->db->bind(":user_name", $user_name);
        $resultdata = $this->db->resultSet();

        foreach ($resultdata as $data) {
            $passwordHash = password_verify($password, $data->password);
            $emailHash = password_verify($email, $data->email);
            if($passwordHash and $emailHash) {
                $_SESSION['id'] = $data->id;
                header("location: ".URLROOT."/admin/painel");
                die();
            } else {
                $message = 'verifique os campos se estão certos';
            }
        }
            return $message;
    }

    public function profileSetup($id) {

    $this->db->query("SELECT id,name,office FROM usuarios where id = :id");
    $this->db->bind(":id", "$id");
    return $this->db->resultSet();



    }
}