<?php
include_once 'usuario.php';

class Sugestao {
    private $usuario;
    private $data;
    private $sugestao;
    function __construct($usuario, $data, $sugestao) {
        $this->usuario = $usuario;
        $this->data = $data;
        $this->sugestao = $sugestao;
    }
    function getUsuario() {
        return $this->usuario;
    }

    function getData() {
        return $this->data;
    }

    function getSugestao() {
        return $this->sugestao;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setSugestao($sugestao) {
        $this->sugestao = $sugestao;
    }
}
?>