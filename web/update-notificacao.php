<?php
include_once '../config/conexao.php';

$db = new Conexao();
$con = $db->con;

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!empty($id)){
	$result_usuario = "UPDATE Correio SET status ='1' WHERE id ='$id'";
	mysqli_query($con, $result_usuario);
	header("Location: index.php");
}
?>