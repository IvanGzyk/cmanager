<?php
include_once '../../config/conexao.php';
$db = new Conexao();
$query = "SELECT * FROM Saldo;";
$result = mysqli_query($db->con, $query);
$data = date("Y-m-d");
while ($row = mysqli_fetch_row($result)){
    $entradas = "";
    $saidas = "";
    $saldo = "";
    $query = "SELECT SUM(valor) valor FROM Financeira WHERE `data` = '$data' - INTERVAL 1 DAY "
            . "AND entrada_saida = 'entarda'"
            . "AND condominio = '$row[1]'";
    $resultado = mysqli_query($db->con, $query);
    while ($row1 = mysqli_fetch_row($resultado)){
        $entradas = $row1[0];
    }
    $query = "SELECT SUM(valor) valor FROM Financeira WHERE `data` = '$data' - INTERVAL 1 DAY "
            . "AND entrada_saida = 'saida'"
            . "AND condominio = '$row[1]'";
    $resultado = mysqli_query($db->con, $query);
    while ($row1 = mysqli_fetch_row($resultado)){
        $saidas = $row1[0];
    }
    $saldo_dia = $entradas - $saidas;
    $query = "SELECT saldo FROM Saldo WHERE condo = '$row[1]'";
    $resultado = mysqli_query($db->con, $query);
    //echo $query;    exit();
    while ($row2 = mysqli_fetch_row($resultado)){
        $saldo = $row2[0];
    }
    $saldo_novo = $saldo + $saldo_dia;
    $atualiza = "UPDATE Saldo SET saldo = '$saldo_novo' WHERE condo = '$row[1]'";
    if(mysqli_query($db->con, $atualiza)){
        echo 'Saldo Atualizado!';
    }else{
        echo 'Saldo não Atualizado.';
    }
}