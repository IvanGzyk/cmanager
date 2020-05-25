<script src="../../web/js/funcoes.js" type="text/javascript"></script>
<script src="../../web/jquery.min.js" type="text/javascript"></script>
<?php
include_once '../../config/conexao.php';

$db = new Conexao();
$con = $db->con;

$query = "SELECT * FROM Noticias ORDER BY id DESC";
$result = mysqli_query($con, $query);
$tabela = "";

while ($row = mysqli_fetch_row($result)) {
    $id = $row[0];
	if($row[4] != '' or NULL){
		$anexo = 'Sim';
	}else{
		$anexo = 'Não';
	}
	
    $ver = "'../views/noticias/noticias.php?id=" . $id . "'";
    $tabela .= "<tr>";
	$tabela .= "<td>[$row[1]]</td>";
    $tabela .= "<td>$row[2]</td>";
    $tabela .= "<td>$anexo</td>";
	$tabela .= "<td>$row[5]</td>";
    $tabela .= '<td><input type="button" value="Visualizar notícia" class="btn btn-info btn-sm" onclick="Conteudo(' . $ver . ')"></td>'; //lincar em uma função de Delete.php row[0]
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
                <h1 class="mt-3">Notícias</h1>
                <br>
<table align="center" class="table table-hover w-75">
    <thead>
        <tr>
            <td>Tipo da notícia</td>
            <td>Título da Notícia</td>
            <td>Possui anexo?</td>
            <td>Data Publicação</td>
        </tr>
    </thead>
    <tbody>
        <?php echo $tabela ?>
    </tbody>
</table>
            </div>
        </div>            
    </div>
