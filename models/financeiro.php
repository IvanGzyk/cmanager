<?php
include_once 'condominio.php';
include_once 'entradas.php';
include_once 'saidas.php';

class Financeiro extends Condominio{
    private $saldo;
    private $cpf_cnpj;
    function __construct($saldo, $cpf_cnpj) {
        $this->saldo = $saldo;
        $this->cpf_cnpj = $cpf_cnpj;
    }
    function getSaldo() {
        return $this->saldo;
    }

    function getCpf_cnpj() {
        return $this->cpf_cnpj;
    }

    function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    function setCpf_cnpj($cpf_cnpj) {
        $this->cpf_cnpj = $cpf_cnpj;
    }
}
?>