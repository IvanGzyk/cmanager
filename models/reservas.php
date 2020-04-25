<?php

class Reservas{
    private $data;
    
    function __construct($data) {
        $this->data = $data;
    }

    function getData() {
        return $this->data;
    }

    function setData($data) {
        $this->data = $data;
    }
}
?>