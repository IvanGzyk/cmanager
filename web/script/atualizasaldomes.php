<?php
$caminho = 'cmanager.com.br';
$usuario = 'cmanag62';
$senha = 'WyR1eo58j4';
$banco = 'cmanag62_cmanager';

$con = mysqli_connect($caminho, $usuario, $senha) or die("Falha ao se conectar." . mysqli_error($con));
mysqli_set_charset($con, 'utf8');
mysqli_select_db($con, $banco) or die("Falha ao selecionar o banco de dados." . mysqli_error($con));
$query = "SELECT condo, saldo FROM Saldo;";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_row($result)){
    $data = date('Y-m-d', strtotime('-1 days'));
    $condo = $row[0];
    $saldo = $row[1];
    $insert = "INSERT INTO SaldoMes(condominio, mes, saldo) Values('$condo', '$data', '$saldo');";
    $execut = mysqli_query($con, $insert);
}
