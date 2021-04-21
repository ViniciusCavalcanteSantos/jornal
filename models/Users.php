<?php
class Users {
    private $db; // Armazena o modelo

    public function __construct() {
        $this->db = new Model();
    }

    // Faz o login do usúario
    public function login($email, $password) {
        session_start();
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
    }
}