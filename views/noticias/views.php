<script src="../../web/js/funcoes.js" type="text/javascript"></script>
<script src="../../web/jquery.min.js" type="text/javascript"></script>
<?php
include_once '../../config/conexao.php';

$db = new Conexao();
$con = $db->con;

$query = "SELECT * FROM Noticias";
$result = mysqli_query($con, $query);
$tabela = "";

while ($row = mysqli_fetch_row($result)) {
    $id = $row[0];
    $deleta = "'../views/noticias/delete.php?deleta=" . $id . "'";
    $tabela .= "<tr>";
	$tabela .= "<td>$id</td>";
	$tabela .= "<td>$row[1]</td>";
    $tabela .= "<td>$row[2]</td>";
    $tabela .= "<td>$row[5]</td>";
    $tabela .= '<td><input type="button" value="Deletar" class="btn btn-danger btn-sm" onclick="Conteudo(' . $deleta . ')"></td>'; //lincar em uma função de Delete.php row[0]
    $tabela .= "</tr>";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <link href="../../web/css/styles.css" rel="stylesheet" />
        <script src="../web/js/all.min.js"></script>
    </head>
    <body>
        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <h1 class="mt-3">Gerenciar Notícias</h1>
                <div class="w-100"><button type="button" class="btn btn-info btn-sm float-right" onclick="Conteudo('../views/noticias/form.php')">CADASTRAR NOVA NOTÍCIA</button><br><br></div>
<table class="table table-hover">
    <thead>
        <tr>
            <td>ID</td>
            <td>Tipo</td>
            <td>Título</td>
            <td>Data Publicação</td>
			<td>Ações</td>
        </tr>
    </thead>
    <tbody>
        <?php echo $tabela ?>
    </tbody>
</table>
            </div>
        </div>            
    </div>
