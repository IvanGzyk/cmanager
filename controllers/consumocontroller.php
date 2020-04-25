<?php
include_once '../config/conexao.php';

$vazao = filter_input(INPUT_GET, 'vazaoagua');
$condominio = filter_input(INPUT_GET, 'condominio');

if (is_null($vazao) || is_null($condominio)) {
    echo "Dados retornados do NodeMCU estão incorretos.";
}

$db = new Conexao();
$con = $db->con;

date_default_timezone_set('America/Sao_Paulo');
$data_atual = date('d-m-Y H:i:s');
$referencia = date('m-Y');

$valida = "SELECT * FROM ConsumoDeAgua WHERE condominio = '$condominio'";
$executar = mysqli_query($con, $valida);
$new_referencia = array();
while ($row = mysqli_fetch_row($executar)) {
    $new_referencia[] = $row[2];
}
if (mysqli_num_rows($executar) == 0) {
    $sql2 = "INSERT INTO ConsumoDeAgua (condominio, referencia, atualizacao, valorMedido) VALUES ('$condominio', '$referencia', '$data_atual', '$vazao');";
    mysqli_query($con, $sql2);
    echo 'sucesso';
}else if (!(in_array($referencia, $new_referencia))) {
    $sql1 = "INSERT INTO ConsumoDeAgua (condominio, referencia, atualizacao, valorMedido) VALUES ('$condominio', '$referencia', '$data_atual', '$vazao');";
    mysqli_query($con, $sql1);
    echo 'sucesso';
}else if (in_array($referencia, $new_referencia)) {
    $sql3 = "UPDATE ConsumoDeAgua SET atualizacao = '".$data_atual."', valorMedido = valorMedido + $vazao WHERE condominio = '$condominio' AND referencia = '".$referencia."'";
    mysqli_query($con, $sql3);
    echo 'sucesso';
} else {
    echo 'erro';
}
?>