<?php

class Contato {

    private $telefone;
    private $email;
    private $cpf_cnpj;

    function __construct($telefone, $email, $cpf_cnpj) {
        $this->telefone = $telefone;
        $this->email = $email;
        $this->cpf_cnpj = $cpf_cnpj;
    }

    function getContato($cpf_cnpj) {
        $sql = "Select * from Contato Where cpf_cnpj Like '" . $cpf_cnpj . "'";
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getEmail() {
        return $this->email;
    }

    function getCpf_cnpj() {
        return $this->cpf_cnpj;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCpf_cnpj($cpf_cnpj) {
        $this->cpf_cnpj = $cpf_cnpj;
    }
}
?>
