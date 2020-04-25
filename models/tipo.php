<?php

class Tipo {
    private $tipo;
    private $cpf_cnpj;
    function __construct($tipo, $cpf_cnpj) {
        $this->tipo = $tipo;
        $this->cpf_cnpj = $cpf_cnpj;
    }
    function getTipo() {
        return $this->tipo;
    }

    function getCpf_cnpj() {
        return $this->cpf_cnpj;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setCpf_cnpj($cpf_cnpj) {
        $this->cpf_cnpj = $cpf_cnpj;
    }
}

?>