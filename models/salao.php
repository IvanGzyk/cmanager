<?php
include_once 'regra.php';
include_once 'reservas.php';

class Salao {
    private $cpf_cnpj;
    function __construct($cpf_cnpj) {
        $this->cpf_cnpj = $cpf_cnpj;
    }
    function getCpf_cnpj() {
        return $this->cpf_cnpj;
    }

    function setCpf_cnpj($cpf_cnpj) {
        $this->cpf_cnpj = $cpf_cnpj;
    }
}
?>
