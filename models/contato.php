<?php
class Contato {

    private $telefone;
    private $celular;
    private $email;
    private $email_altenativo;
    private $cpf_cnpj;

    function __construct($telefone, $celular, $email, $email_altenativo, $cpf_cnpj) {
        $this->telefone = $telefone;
        $this->celular = $celular;
        $this->email = $email;
        $this->email_altenativo = $email_altenativo;
        $this->cpf_cnpj = $cpf_cnpj;
    }

    function getCelular() {
        return $this->celular;
    }

    function getEmail_altenativo() {
        return $this->email_altenativo;
    }

    function setCelular($celular): void {
        $this->celular = $celular;
    }

    function setEmail_altenativo($email_altenativo): void {
        $this->email_altenativo = $email_altenativo;
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
