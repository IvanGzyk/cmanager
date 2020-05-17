<script src="../../web/js/funcoes.js" type="text/javascript"></script>
<script src="../../web/js/jquery.min.js" type="text/javascript"></script>

<?php
include_once '../../config/conexao.php';

$dados = array($_POST['cpfCnpj'], $_POST['mensagem']);
date_default_timezone_set('America/Sao_Paulo');
$data_atual = date('d/m/Y H:i:s');


$db = new Conexao();

    $query_correio = "INSERT INTO Correio (cpfCnpj, mensagem, data_registro, data_leitura, status) VALUES ('$dados[0]', '$dados[1]', '$data_atual', '', '0');";

    $execute_1 = mysqli_query($db->con, $query_correio);
	
    echo '<script>
        alert("Notificação de correio foi cadastrada com sucesso.");
		window.location.href = "../../web/index.php";
        </script>';
?>