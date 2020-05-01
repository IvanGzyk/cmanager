<?php
	include_once '../../config/conexao.php';

    $db = new Conexao();

	$executar = "SELECT referencia, valorMedido FROM ConsumoDeAgua ORDER BY referencia DESC LIMIT 6";

	$resultado = mysqli_query($db->con, $executar);

	$data = array();
		foreach ($resultado as $row) {
			$data[] = $row;
		}
		
	$resultado->close();
	$db->con->close();

	print json_encode($data);
?>