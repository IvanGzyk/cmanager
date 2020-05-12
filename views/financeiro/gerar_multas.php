<?php
include_once '../../controllers/financeirocontroller.php';

$data = $_POST['data'];
$valor = $_POST['valor'];
$apartamento = $_POST['ap'];
$descricao = $_POST['descricao'];

$financeiro = new financeirocontroller();
$financeiro->GerarMultas($apartamento, $valor, $data, $descricao);