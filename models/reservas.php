<?php

class Reservas{
    private $data;
    private $cpf;
    
    function __construct($data, $cpf) {
        $this->data = $data;
        $this->cpf = $cpf;
    }

    function getData() {
        return $this->data;
    }

    function setData($data) {
        $this->data = $data;
    }
    
    function getCpf() {
        return $this->cpf;
    }

    function setCpf($cpf): void {
        $this->cpf = $cpf;
    }
}
?>