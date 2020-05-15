<?php
session_start();
include_once '../../controllers/financeirocontroller.php';
$usuario = unserialize($_SESSION['usuario']);
$data = $_POST['data'];
$valor = $_POST['valor'];
$apartamento = $_POST['ap'];
$descricao = $_POST['descricao'];
$cpf = $usuario['doc'];

$financeiro = new financeirocontroller();
$financeiro->GerarMultas($cpf, $apartamento, $valor, $data, $descricao);