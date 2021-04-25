<?php
class Client extends Controller {
    public function __construct() {
        $this->postsModel = $this->model("posts");
    }

    // Tela inicial
    public function index() {
        $this->view("client/index");
    }

    public function posts($id) {
        $dados = array();
        $extrair = array();

            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $extrair['noticia'] = $this->postsModel->notices($id);
            } else {
                echo "algo de errado! 404";
            }


        $this->view("client/materia",$dados, $extrair);

    }
}