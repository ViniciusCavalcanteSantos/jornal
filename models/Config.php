<?php
class Config {
    private $db;
    public function __construct() {
        $this->db = new Model();
    }
    public function getConfig() {

        $array = array();

        $sql = "SELECT * FROM config ";
        $sql = $this->db->query($sql);
        $resultdata = $this->db->resultSet();

        if($resultdata) {
            foreach($resultdata as $item){
                $array[$item->nameOfFunction] = $item->value;

            }
        }

        return $array;
    }
}