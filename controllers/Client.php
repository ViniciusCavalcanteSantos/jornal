<?php
class Client extends Controller {
    public function __construct() {
        parent::__construct();
        $this->financeModel = $this->model("Finance");
        $this->noticesModel = $this->model("Notices");
    }

    // Tela inicial
    public function index() {
        $data = [
            "FinanceJsArray" => $this->financeModel->getFinancesJsArray()
        ];

        $this->view("client/index", $data);
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