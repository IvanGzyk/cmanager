<?php
include_once '../config/conexao.php';

$db = new Conexao();
$con = $db->con;

date_default_timezone_set('America/Sao_Paulo');
$data_atual = date('d/m/Y H:i:s');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!empty($id)){
	$result_usuario = "UPDATE Correio SET status ='1', data_leitura ='$data_atual' WHERE id ='$id'";
	mysqli_query($con, $result_usuario);
	header("Location: index.php");
}
?>