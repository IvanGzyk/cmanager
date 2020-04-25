<?php

class Regra {
    private $regra;
    private $aplica;
    function __construct($regra, $aplica) {
        $this->regra = $regra;
        $this->aplica = $aplica;
    }
    function getRegra() {
        return $this->regra;
    }

    function getAplica() {
        return $this->aplica;
    }

    function setRegra($regra) {
        $this->regra = $regra;
    }

    function setAplica($aplica) {
        $this->aplica = $aplica;
    }
}
?>
