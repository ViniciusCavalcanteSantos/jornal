<?php


class Notices {
    private $db; // Armazena o modelo


    public function __construct() {
        $this->db = new Model();
    }

    public function createNotice($title) {
        // Cria a noticia com o titúlo fornecido
        $this->db->query("INSERT INTO notices (title) VALUES (:title)");
        $this->db->bind(":title", $title);

        try {
            if($this->db->execute()) {
                echo json_encode(array("title" => $title, "id" => $this->db->getLastInsertId(), "success" => true,
                    "message" => "Notícia criada com sucesso!"),
                    JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(array("title" => $title, "success" => false, "message" => "Ocorreu um erro inesperado!"),
                    JSON_UNESCAPED_UNICODE);
            }
        } catch (PDOException $e) {
            echo json_encode(array("title" => $title, "success" => false, "message" => "Ocorreu um erro inesperado!"),
                JSON_UNESCAPED_UNICODE);
        }
    }

    public function uploadImage() {
        // Gerencia o upload de imagens
        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT); // Id da noticia

        // Cria a pasta das imagens caso não exista
        if(!is_dir("assets/image")) {
            mkdir("assets/image");
        }

        // Cria a pasta das imagens caso não exista
        if(!is_dir("assets/image/notices")) {
            mkdir("assets/image/notices");
        }

        // Verifica a existencia de id e um arquivo para upload
        if(isset($_FILES["upload"]["name"]) && $id) {
            $file = $_FILES["upload"];
            $fileName = time() . mb_strstr($file["name"], ".");

            // Tipos de arquivos permitidos
            $typesAllowed = [
                "image/png",
                "image/jpg",
                "image/jpeg",
                "application/pdf"
            ];

            // Cria a pasta das noticias caso não exista
            $path = "assets/image/notices/{$id}";
            if (!is_dir($path)) {
                mkdir($path);
            }

            // Verifica o tipo do arquvo recebido
            if(in_array($file["type"], $typesAllowed)) {
                // Salva o arquivo
                if(move_uploaded_file($file["tmp_name"], $path."/".$fileName)) {
                    echo json_encode(array("message" => "Arquivo salvo com sucesso!", "success" => true, "url" => $path."/".$fileName), JSON_UNESCAPED_UNICODE);
                } else {
                    echo json_encode(array("message" => "Ocorreu um erro inesperado!", "success" => false), JSON_UNESCAPED_UNICODE);
                }
            } else {
                echo json_encode(array("message" => "Tipo de arquivo não permitido (Enviar JPG, PNG, JPEG ou PDF)", "success" => false), JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function saveNotice($activate = false) {
        // Recebe e trata as informações recebidas
        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        $editor = filter_input(INPUT_POST, "editor", FILTER_DEFAULT);
        $imagesUsed = filter_input(INPUT_POST, "imagesUsed", FILTER_DEFAULT);

        // Verifica a existencia da pasta da noticia
        if(file_exists("assets/image/{$id}") && is_dir("assets/image/{$id}")) {
            $imagesUsedArray = explode(',', $imagesUsed); // Array com as imagens ultilizadas
            $imagesSaved = array_diff(scandir("assets/image/{$id}"), array(".", "..")); // Array com as imagens salvas

            $imagesToDelete = array_diff($imagesSaved, $imagesUsedArray); // Array com imagens inutilizadas

            // Deleta todas as imagens que não estão sendo usadas
            foreach ($imagesToDelete as $imageToDelete) {
                $path = "assets/image/{$id}/{$imageToDelete}";
                if(file_exists($path) && is_file($path)) {
                    unlink($path);
                }
            }
        }

        // Salva a noticia
        $this->db->query("UPDATE notices SET notice = :editor WHERE id = :id");
        $this->db->bind(":id", $id);
        $this->db->bind(":editor", $editor);

        try {
            if($this->db->execute()) {
                echo json_encode(array("success" => true, "message" => "Noticia salva com sucesso!"),
                    JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(array("success" => false, "message" => "Ocorreu um erro inesperado!"),
                    JSON_UNESCAPED_UNICODE);
            }
        } catch(PDOException $e) {
            echo json_encode(array("success" => false, "message" => "Ocorreu um erro inesperado!"),
                JSON_UNESCAPED_UNICODE);
        }

    }

    // Pega uma noticia
    public function getNotice($id) {
        $this->db->query("SELECT * FROM notices WHERE id = :id");
        $this->db->bind(":id", $id);

        return $this->db->single();
    }

    // Pega todas as noticias
    public function getNotices() {
        $this->db->query("SELECT * FROM notices ORDER BY date");
        $this->db->execute();

        if($this->db->rowCount() > 0) {
            return $this->db->resultSet();
        } else {
            return [];
        }
    }

    // Apaga uma noticia
    public function deleteNotice($id) {
        $this->db->query("DELETE FROM notices WHERE id = :id");
        $this->db->bind(":id", $id);

        if($this->db->execute()) {
            echo json_encode(array("success" => true, "message" => "Noticia apagada com sucesso"));
        } else {
            echo json_encode(array("success" => false, "message" => "Não foi possivel apagar a noticia"));
        }
    }
}