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

        if($this->db->execute()) {
            return $this->db->getLastInsertId();
        } else {
            return false;
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

    public function saveNotice() {
        // Recebe e trata as informações recebidas
        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        $title = filter_input(INPUT_POST, "title", FILTER_DEFAULT);
        $subtitle = filter_input(INPUT_POST, "subtitle", FILTER_DEFAULT);
        $editor = filter_input(INPUT_POST, "editor", FILTER_DEFAULT);
        $background = filter_input(INPUT_POST, "background", FILTER_DEFAULT);

        $imagesUsed = filter_input(INPUT_POST, "imagesUsed", FILTER_DEFAULT);

        // Validações
        if(!$title || !$subtitle) {
            echo json_encode(array("success" => false, "message" => "Selecione o título e o subtítulo"),
                JSON_UNESCAPED_UNICODE);
            return;
        }

        if(mb_strlen($title) > 80) {
            echo json_encode(array("success" => false, "message" => "Título muito longo (máximo de 80 letras)"),
                JSON_UNESCAPED_UNICODE);
            return;
        }

        if(mb_strlen($subtitle) > 80) {
            echo json_encode(array("success" => false, "message" => "Subtítulo muito longo (máximo de 80 letras)"),
                JSON_UNESCAPED_UNICODE);
            return;
        }

        if(!$id) {
            $id = $this->createNotice($title);

            if(!$id) {
                echo json_encode(array("success" => false, "message" => "Não foi possivel criar a noticia!"),
                    JSON_UNESCAPED_UNICODE);
                return;
            }
        }

        if($background) {
            $path = "assets/image/notices/{$id}";
            $this->saveBackgroundCanvas($background, $path);
        }

        // Salva a noticia
        $this->db->query("UPDATE notices SET title = :title, subtitle = :subtitle, notice = :editor WHERE id = :id");
        $this->db->bind(":id", $id);
        $this->db->bind(":title", $title);
        $this->db->bind(":subtitle", $subtitle);
        $this->db->bind(":editor", $editor);

        if($this->db->execute()) {
            echo json_encode(array("success" => true, "message" => "Noticia salva com sucesso!"),
                JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(array("success" => false, "message" => "Ocorreu um erro inesperado!"),
                JSON_UNESCAPED_UNICODE);
        }

        // Deleta imagens sem uso
        if(file_exists("assets/image/notices/{$id}") && is_dir("assets/image/notices/{$id}")) {
            $imagesUsedArray = explode(',', $imagesUsed); // Array com as imagens ultilizadas
            $imagesSaved = array_diff(scandir("assets/image/notices/{$id}"), array(".", "..", "background.png")); // Array com as imagens salvas

            $imagesToDelete = array_diff($imagesSaved, $imagesUsedArray); // Array com imagens inutilizadas

            // Deleta todas as imagens que não estão sendo usadas
            foreach ($imagesToDelete as $imageToDelete) {
                $path = "assets/image/notices/{$id}/{$imageToDelete}";
                if(file_exists($path) && is_file($path)) {
                    unlink($path);
                }
            }
        }
    }

    public function saveBackgroundCanvas($canvas, $path) {
        if(!file_exists($path) || !is_dir($path)) {
            mkdir($path);
        }
        $img = str_replace("data:image/png;base64,", "", $canvas);
        $img = str_replace(" ", "+", $img);

        $fileData = base64_decode($img);
        $fileName = "background.png";

        file_put_contents($path."/".$fileName, $fileData);
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

        if(file_exists("assets/image/notices/$id") && is_dir("assets/image/notices/$id")) {
            $images = array_diff(scandir("assets/image/notices/{$id}"), array(".", ".."));

            foreach($images as $image) {
                $path = "assets/image/notices/{$id}/{$image}";
                if(file_exists($path) && is_file($path)) {
                    unlink($path);
                }
            }

            rmdir("assets/image/notices/$id");
        }

        if($this->db->execute()) {
            echo json_encode(array("success" => true, "message" => "Noticia apagada com sucesso"));
        } else {
            echo json_encode(array("success" => false, "message" => "Não foi possivel apagar a noticia"));
        }
    }

    public function toggleActive($id) {
        $notice = $this->getNotice($id);

        if($notice) {
            if($notice->active) {
                $active = 0;
                $message = "Noticia desativada com sucesso!";
            } else {
                $active = 1;
                $message = "Noticia ativada com sucesso!";
            }

            $this->db->query("UPDATE notices SET active = :active WHERE id = :id");
            $this->db->bind(":id", $id);
            $this->db->bind(":active", $active);

            if($this->db->execute()) {
                echo json_encode(array("success" => true, "message" => $message));
            } else {
                echo json_encode(array("success" => false, "message" => $message));
            }
        } else {
            echo json_encode(array("success" => true, "message" => "Não foi possivel ativar/desativar a noticia"));
        }
    }
}