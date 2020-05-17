<?php
include_once '../config/conexao.php';

$db = new Conexao();
$con = $db->con;

date_default_timezone_set('America/Sao_Paulo');
$data_atual = date('d/m/Y H:i:s');

$cpfCnpj = filter_input(INPUT_GET, 'cpfCnpj');
if(!empty($cpfCnpj)){
	$result_insert = "INSERT INTO Alerta (cpfCnpj, data_registro, mensagem) VALUES ('$cpfCnpj', '$data_atual', 'Reporte de possível vazamento de água');";
	mysqli_query($con, $result_insert);
	
	echo '<script>
        alert("O reporte de vazamento foi enviado com sucesso.");
		window.location.href = "../web/index.php";
        </script>';
}
?>