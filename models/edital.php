<?php
include_once 'condominio.php';

class Edital extends Condominio {
    private $cpf_cnpj;
    private $dataPostagem;
    private $dataRealizacao;
    private $edital;
    private $arquivo;
    function __construct($cpf_cnpj, $dataPostagem, $dataRealizacao, $edital, $arquivo) {
        $this->cpf_cnpj = $cpf_cnpj;
        $this->dataPostagem = $dataPostagem;
        $this->dataRealizacao = $dataRealizacao;
        $this->edital = $edital;
        $this->arquivo = $arquivo;
    }
    function getCpf_cnpj() {
        return $this->cpf_cnpj;
    }

    function getDataPostagem() {
        return $this->dataPostagem;
    }

    function getDataRealizacao() {
        return $this->dataRealizacao;
    }

    function getEdital() {
        return $this->edital;
    }

    function getArquivo() {
        return $this->arquivo;
    }

    function setCpf_cnpj($cpf_cnpj) {
        $this->cpf_cnpj = $cpf_cnpj;
    }

    function setDataPostagem($dataPostagem) {
        $this->dataPostagem = $dataPostagem;
    }

    function setDataRealizacao($dataRealizacao) {
        $this->dataRealizacao = $dataRealizacao;
    }

    function setEdital($edital) {
        $this->edital = $edital;
    }

    function setArquivo($arquivo) {
        $this->arquivo = $arquivo;
    }
}
?>