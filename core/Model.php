<?php


class Model {
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $statement;
    private $dbHandler;
    private $error;

    public function __construct() {
        $conection = "mysql:host=".$this->dbHost.";dbname=".$this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        );

        try {
            $this->dbHandler = new PDO($conection, $this->dbUser, $this->dbPass, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function getLastInsertId() {
        return $this->dbHandler->lastInsertId();
    }

    // Permite escrever query
    public function query($sql) {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    // Vinula os valores
    public function bind($parameter, $value, $type = null) {
        switch(is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
                break;
        }

        $this->statement->bindValue($parameter, $value, $type);
    }

    // Executa a declaração preparada
    public function execute() {
        return $this->statement->execute();
    }

    // Retorna um array
    public function resultSet() {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    // Retorna a linha especificada
    public function single() {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    // Retorna o número de linhas
    public function rowCount() {
        return $this->statement->rowCount();
    }
}