<?php
include '../vendor/autoload.php';

\Sounoob\pagseguro\config\Config::setAccountCredentials('ivangzyk@gmail.com', '710e1100-a3a1-4df1-b952-535ff57d0ae1cb1bd94a4da2a1c4c4a90bde3a7fca2634ee-bbe7-4f76-ab31-4bcd60ed0287');

$caminho = 'cmanager.com.br';
$usuario = 'cmanag62';
$senha = 'WyR1eo58j4';
$banco = 'cmanag62_cmanager';

$con = mysqli_connect($caminho, $usuario, $senha) or die("Falha ao se conectar." . mysqli_error($con));
mysqli_set_charset($con, 'utf8');
mysqli_select_db($con, $banco) or die("Falha ao selecionar o banco de dados." . mysqli_error($con));

$query = "SELECT id, cod FROM boleto where status <> 3 OR status <> 4";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_row($result)) {
    $transactionV2 = new \Sounoob\pagseguro\TransactionDetails($row[1], 'v2');
    $array = map($transactionV2);
    $status = $array['result']['status'];
    $id = $row[0];
    $update = "UPDATE boleto SET status = $status WHERE id = $id;";
    $execut = mysqli_query($con, $update);
}

//Função para transformar xml em array.
function map($param) {
    if (is_object($param)) {
        $param = get_object_vars($param);
    }
    if (is_array($param)) {
        return array_map(__FUNCTION__, $param);
    }
    return $param;
}