<?php
include_once '../../config/conexao.php';

$db = new Conexao();
$con = $db->con;

$query = "SELECT * FROM Alerta";
$result = mysqli_query($con, $query);
$tabela = "";

while ($row = mysqli_fetch_row($result)) {
	$query1 = "SELECT * FROM CadastrCpf_Cnpj WHERE cpf_cnpj = '$row[1]'";
	$result1 = mysqli_query($con, $query1);
	while ($row1 = mysqli_fetch_row($result1)) {
    $id = $row[0];
    $deleta = "'../views/alerta/delete.php?deleta=" . $id . "'";
    $tabela .= "<tr>";
	$tabela .= "<td>$row1[1]</td>";
    $tabela .= "<td>$row[1]</td>";
    $tabela .= "<td>$row[2]</td>";
    $tabela .= "<td>$row[3]</td>";
    $tabela .= '<td><input type="button" value="Deletar" class="btn btn-danger btn-sm" onclick="Conteudo(' . $deleta . ')"></td>'; //lincar em uma função de Delete.php row[0]
    $tabela .= "</tr>";
}
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
        <!--<link href="../../web/css/styles.css" rel="stylesheet" />
        <script src="../web/js/all.min.js"></script>-->
    </head>
    <body>
            <div id="layoutSidenav_content">
                    <div class="container-fluid">
                        <h1 class="mt-3">Alerta de Vazamento - Controle de Água</h1>
<div class="w-100"><br><br></div>
<table class="table table-hover">
    <thead>
        <tr>
            <td>Autor do Alerta</td>
            <td>CPF/CNPJ</td>
            <td>Cadastro do Alerta</td>
            <td>Mensagem</td>
			<td>Ações</td>
        </tr>
    </thead>
    <tbody>
        <?php echo $tabela ?>
    </tbody>
</table>
</body>
</html>