<?php
include_once '../Config/Conexao.php';

$vazao = filter_input(INPUT_GET, 'vazaoagua');
$condominio = filter_input(INPUT_GET, 'condominio');

if (is_null($vazao) || is_null($condominio)){
	echo "Dados retornados do NodeMCU estão incorretos.";
}

$db = new Conexao();
$con = $db->con;

date_default_timezone_set('America/Sao_Paulo');
$data_atual = date('d-m-Y H:i:s');
$referencia = date('m-Y');

$valida = "SELECT * FROM ConsumoDeAgua";
$executar = mysqli_query($con, $valida);
$row = mysqli_fetch_array($executar, MYSQLI_ASSOC);

$new_referencia = $row['referencia'];

if($referencia != $new_referencia){
	$sql1 = "INSERT INTO ConsumoDeAgua (condominio, referencia, atualizacao, valorMedido) VALUES ('$condominio', '$referencia', '$data_atual', '$vazao');";
	mysqli_query($con, $sql1);
	echo 'sucesso';
}
if(mysqli_num_rows($executar) == 0){
	$sql2 = "INSERT INTO ConsumoDeAgua (condominio, referencia, atualizacao, valorMedido) VALUES ('$condominio', '$referencia', '$data_atual', '$vazao');";
	mysqli_query($con, $sql2);
	echo 'sucesso';
}
if (mysqli_num_rows($executar) > 0){
	$sql3 = "UPDATE ConsumoDeAgua SET atualizacao = $data_atual, valorMedido = valorMedido + $vazao WHERE condominio = '$condominio'";
	mysqli_query($con, $sql3);
	echo 'sucesso';
}else{
	echo 'erro';
}
?>
Não é possível acessar esta página.