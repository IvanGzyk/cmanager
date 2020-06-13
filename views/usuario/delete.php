<?php

include_once '../../config/conexao.php';
$db = new Conexao();
$id = $_GET['deleta'];
$apagar = "DELETE FROM cmanag62_cmanager.Usuario where id = '$id';";

$executa = mysqli_query($db->con, $apagar);

echo '<script>
        alert("O usuário foi deletado com sucesso.");
		window.location.href = "../web/index.php";
        </script>';
?>
