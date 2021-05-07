<?php
class Finance {
    private $db;

    public function __construct() {
        $this->db = new Model();
    }

    public function getFinances() {
        $sql = "SELECT * FROM finance_info ";
        $this->db->query($sql);

        return $this->db->resultSet();
    }

    public function getFinancesJsArray() {
        $finance = $this->getFinances();
        $jsArray = "[";

        foreach (array_reverse($finance) as $value) {
            $date = new DateTime($value->date);
            $jsArray .= "{date: '{$date->format("d/m")}', dollar: '{$value->dollar}', dollarPercentage: 
                '{$value->dollar_percentage}'},";
        }
        $jsArray .= "]";

        return $jsArray;
    }
}