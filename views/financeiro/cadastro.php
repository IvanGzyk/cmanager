<?php

session_start();
include_once '../../config/conexao.php';
include_once '../../controllers/financeirocontroller.php';
$db = new Conexao();
$financeiro = new financeirocontroller();
$condominio = "";
$valor = str_replace(',', '.', $_POST['valor']);
$data = $_POST['data'];
$entrada_saida = $_POST['entrada_saida'];
$descricao = $_POST['descricao'];
$usuario = unserialize($_SESSION['usuario']);
$doc = $usuario['doc'];
$query = "SELECT condominio FROM Usuario WHERE cpfCnpj = '$doc'";
$result = mysqli_query($db->con, $query);
while ($row = mysqli_fetch_row($result)) {
    $condominio = $row[0];
}
$financeiro->CadastrpFinanceiro($condominio, $data, $valor, $descricao, $entrada_saida);
