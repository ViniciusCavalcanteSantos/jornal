<?php
class Posts{
    private $db; // Armazena o modelo

    public function __construct() {
        $this->db = new Model();
    }

    public function notices($id) {
        $array = array();

        $this->db->query("SELECT * FROM notices WHERE id = :notices and active = 1");
        $this->db->bind(":notices" , $id);
        $dados = $this->db->resultSet();

        try {
            if ($dados) {
                foreach ($dados as $item => $value) {
                    $array = [
                        "title" => $value->title,
                        "notice" => $value->notice,
                        "date" => $value->date
                    ];
                }
            } else {
                echo "não existe essa materia";
            }
        }catch (PDOException $exception) {
            echo "erro 400";
        }

        return $array;
    }
}
