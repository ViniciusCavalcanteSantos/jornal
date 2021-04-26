<?php
class Client extends Controller {
    public function __construct() {
        $this->noticesModel = $this->model("Notices");
    }

    // Tela inicial
    public function index() {
        $this->view("client/index");
    }

    public function posts($id) {
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {
            $data = [
                "notice" => $this->noticesModel->getNotice($id)
            ];
            $this->view("client/materia", $data);
        } else {
            header("location: " . URLROOT);
        }
    }
}