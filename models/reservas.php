<?php

class Reservas{
    private $salao;
    private $data;
    private $cpf;
    
    function __construct($salao, $data, $cpf) {
        $this->data = $data;
        $this->cpf = $cpf;
        $this->salao = $salao;
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
    function getSalao() {
        return $this->salao;
    }

    function setSalao($salao): void {
        $this->salao = $salao;
    }


}
?>