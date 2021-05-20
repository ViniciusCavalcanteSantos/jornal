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
        $this->db->query("SELECT * FROM users where user_name = :user_name");
        $this->db->bind(":user_name", $user_name);
        $user = $this->db->single();

        if($user) {
            $passwordHash = password_verify($password, $user->password);
            $emailHash = password_verify($email, $user->email);

            if($passwordHash and $emailHash) {
                $_SESSION['id'] = $user->id;
                header("location: ".URLROOT."/admin/painel");
                die();
            }
        }

        return false;
    }

    public function profileSetup($id) {
        $this->db->query("SELECT id,name,office FROM users where id = :id");
        $this->db->bind(":id", "$id");
        return $this->db->single();
    }
}