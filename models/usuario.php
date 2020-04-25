<?php

include_once 'condominio.php';
include_once 'contato.php';

class Usuario extends Condominio {

    private $cpf_cnpj;
    private $nome;
    private $senha;
    private $tipo;
    private $condominio;
    
	function __construct($cpf_cnpj, $nome, $senha, $tipo, $condominio) {
        $this->cpf_cnpj = $cpf_cnpj;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->tipo = $tipo;
        $this->condominio = $condominio;
    }

    function getCpf_cnpj() {
        return $this->cpf_cnpj;
    }

    function getNome() {
        return $this->nome;
    }

    function getSenha() {
        return $this->senha;
    }
    
    function getTipo() {
        return $this->tipo;
    }
    
    function getCondominio() {
        return $this->condominio;
    }

    function setCpf_cnpj($cpf_cnpj): void {
        $this->cpf_cnpj = $cpf_cnpj;
    }

    function setNome($nome): void {
        $this->nome = $nome;
    }

    function setSenha($senha): void {
        $this->senha = $senha;
    }
    
    function setTipo($tipo): void {
        $this->tipo = $tipo;
    }
    
    function setCondominio($condominio): void {
        $this->condominio = $condominio;
    }
}