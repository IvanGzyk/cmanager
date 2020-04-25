<?php

include_once '../../config/conexao.php';
include '../../controllers/condominiocontroller.php';
$db = new Conexao();

$id = $_GET['id'];
$blc = $_POST['blc'];
$apt = $_POST['apt'];

$atualizaPredio = "update Predio set blc= '$blc' , ap= '$apt' where id = '$id'";

$execute = mysqli_query($db->con, $atualizaPredio);

header('Location:../../web/');

?>
