
<?php

include_once 'regra.php';
include_once 'reservas.php';
include_once '../../config/conexao.php';

class Salao extends Regra {

    private $cpf_cnpj;
    private $salao;

    function __construct($cpf_cnpj, $salao) {
        $this->cpf_cnpj = $cpf_cnpj;
        $this->$salao = $salao;
    }

    function getCpf_cnpj() {
        return $this->cpf_cnpj;
    }

    function setCpf_cnpj($cpf_cnpj) {
        $this->cpf_cnpj = $cpf_cnpj;
    }

    function getSalao() {
        return $this->salao;
    }

    function setSalao($salao) {
        $this->salao = $salao;
    }

    function setReservas($salao, $cpf, $data) {
        $db = new Conexao();
        $query = "SELECT * FROM Reservas WHERE dataReserva <> $data";
        $result = mysqli_query($db->con, $query);
        if (mysqli_num_rows($result) == 1) {
            return false;
        } else {
            $reservas = new Reservas($salao, $data, $cpf);
            return $reservas;
        }
    }

    function getReservas() {
        
    }

}

?>
