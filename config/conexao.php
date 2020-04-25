<?php

class Conexao {

    private $caminho = 'cmanager.com.br';
    private $usuario = 'cmanag62';
    private $senha = 'WyR1eo58j4';
    private $banco = 'cmanag62_cmanager';
    public $con;

    public function __construct() {
        $this->con = mysqli_connect($this->caminho, $this->usuario, $this->senha) or die("Falha ao se conectar." . mysqli_error($this->con));
		mysqli_set_charset($this->con, 'utf8');
        mysqli_select_db($this->con, $this->banco) or die("Falha ao selecionar o banco de dados." . mysqli_error($this->con));
    }

    public function getCon() {
        return $this->con;
    }
}
?>