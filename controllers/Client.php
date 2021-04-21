<?php
class Client extends Controller {
    public function __construct() {
    }

    // Tela inicial
    public function index() {
        $this->view("client/index");
    }
}