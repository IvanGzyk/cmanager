<?php
//include_once '../../controllers/condominiocontroller.php';
include_once '../../config/conexao.php';
$db = new Conexao();
$con = $db->con;

$query = "SELECT * FROM Predio
INNER JOIN CadastrCpf_Cnpj ON condominio = CadastrCpf_Cnpj.cpf_cnpj;";

$result = mysqli_query($con, $query);
$tabela = "";

while ($row = mysqli_fetch_row($result)) {
    $id = $row[0];
    $atualiza = "'../views/condominio/form_update.php?atualiza=" . $id . "'";
    $deleta = "'../views/condominio/delete.php?deleta=" . $id . "'";
    $tabela .= "<tr>";
    $tabela .= "<td>$row[5]</td>";
    $tabela .= "<td>$row[1]</td>";
    $tabela .= "<td>$row[2]</td>";
    $tabela .= "<td>$row[3]</td>";
    $tabela .= '<td><input type="button" value="Atualizar" class="btn btn-info btn-sm" onclick="Conteudo(' . $atualiza . ')">'; //lincar em uma função de Update.php row[0]
    $tabela .= '&nbsp;<input type="button" value="Deletar" class="btn btn-danger btn-sm" onclick="Conteudo(' . $deleta . ')"></td>'; //lincar em uma função de Delete.php row[0]
    $tabela .= "</tr>";
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
                        <h1 class="mt-3">Gerenciar Apartamentos</h1>
                        <div class="card mb-2"></div>
<div class="w-100"><button type="button" class="btn btn-info btn-sm float-right" onclick="Conteudo('../views/condominio/form.php')">CADASTRAR APARTAMENTO</button><br><br></div>
<table class="table table-hover">
    <thead>
        <tr>
            <td>Condomínio</td>
            <td>CNPJ</td>
            <td>Bloco</td>
            <td>Apartamento</td>
            <td>Ações</td>
        </tr>
    </thead>
    <tbody>
        <?php echo $tabela ?>
    </tbody>
</table>
</body>
</html>