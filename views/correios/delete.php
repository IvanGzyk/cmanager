<?php

include_once '../../config/conexao.php';
$db = new Conexao();
$id = $_GET['deleta'];
$apagar = "DELETE FROM cmanag62_cmanager.Predio where id = '$id';";

$executa = mysqli_query($db->con, $apagar);

echo '<script>
        alert("Apartamento deletado com sucesso.");
		window.location.href = "../../web/index.php";
        </script>';

?>