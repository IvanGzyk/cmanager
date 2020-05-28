<?php

class Reservas{
    private $salao;
    private $data;
    private $apartamento;
    
    function __construct($salao, $data, $apartamento) {
        $this->data = $data;
        $this->apartamento = $apartamento;
        $this->salao = $salao;
    }

    function getData() {
        return $this->data;
    }

    function setData($data) {
        $this->data = $data;
    }
    
    function getApartamento() {
        return $this->apartamento;
    }

    function setApartamento($cpf): void {
        $this->apartamento = $apartamento;
    }
    function getSalao() {
        return $this->salao;
    }

    function setSalao($salao): void {
        $this->salao = $salao;
    }


}
?>