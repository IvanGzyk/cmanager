<?php

include_once '../../config/conexao.php';
$db = new Conexao();
$id = $_GET['deleta'];
$apagar = "DELETE FROM cmanag62_cmanager.Correio where id = '$id';";

$executa = mysqli_query($db->con, $apagar);

echo '<script>
        alert("Notificação de correspondência deletada com sucesso.");
		window.location.href = "../web/index.php";
        </script>';

?>