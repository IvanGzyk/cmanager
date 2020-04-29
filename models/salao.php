<?php

include_once 'regra.php';
include_once 'reservas.php';

class Salao extends Regra {

    private $cpf_cnpj;
    private $salao;

    function __construct($cpf_cnpj, $salao) {
        $this->cpf_cnpj = $cpf_cnpj;
        $this->$salao = $salao;
    }

    function getCpf_cnpj() {
        return $this->cpf_cnpj;
    }

    function setCpf_cnpj($cpf_cnpj) {
        $this->cpf_cnpj = $cpf_cnpj;
    }

    function getSalao() {
        return $this->salao;
    }

    function setSalao($salao) {
        $this->salao = $salao;
    }

    function setReservas($cpf, $data) {
        $reservas = new Reservas($cpf, $data);
        return $reservas;
    }

    function getReservas() {
        
    }
}

?>
