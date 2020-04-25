<?php

class Entradas {
    private $data;
    private $valor;
    private $descricao;
    function __construct($data, $valor, $descricao) {
        $this->data = $data;
        $this->valor = $valor;
        $this->descricao = $descricao;
    }
    function getData() {
        return $this->data;
    }

    function getValor() {
        return $this->valor;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
}
?>