<?php
include_once 'endereco.php';
include_once 'salao.php';


class Condominio{
    private $condominio;
    private $cpf_cnpj;
    private $bloco;
    private $apartamento;
    function __construct($condominio, $cpf_cnpj, $bloco, $apartamento) {
        $this->condominio = $condominio;
        $this->cpf_cnpj = $cpf_cnpj;
        $this->bloco = $bloco;
        $this->apartamento = $apartamento;
    }

        function getCondo() {
        return $this->condominio;
    }

    function getCpfCnpj() {
        return $this->cpf_cnpj;
    }

    function getBloco() {
        return $this->bloco;
    }

    function getApartamento() {
        return $this->apartamento;
    }

    function setCondo($condominio) {
        $this->condominio = $condominio;
    }

    function setCpfCnpj($cpf_cnpj) {
        $this->cpf_cnpj = $cpf_cnpj;
    }

    function setBloco($bloco) {
        $this->bloco = $bloco;
    }

    function setApartamento($apartamento) {
        $this->apartamento = $apartamento;
    }
    
    function setEnderesso($rua, $numero, $bairro, $cidade, $estado, $cep){
        $enderesso = new Endereco($rua, $numero, $bairro, $cidade, $estado, $cep);
        return $enderesso;
    }
    
    function setSalao($cpf_cnpj, $salao, $regra, $aplica){
        $salao = new Salao($cpf_cnpj, $salao);
        $regra_salao = $salao->setRegra($regra);
        $aplica_salao = $salao->setAplica($aplica);
        return $salao;
    }
}
?>