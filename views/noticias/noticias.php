<?php

include_once '../../config/conexao.php';
$db = new Conexao();
$con = $db->con;

$id = $_GET['id'];

$buscar = "SELECT * FROM Noticias where id = '$id';";
$result = mysqli_query($con, $buscar);

while ($row = mysqli_fetch_row($result)) {
	if($row[4] != '' or NULL){
		$anexo = '<a href="../web/img/upload/'.$row[4].'">Efetuar download do anexo</a>';
	}else{
		$anexo = 'Nenhum anexo foi adicionado nesta notícia.';
	}
	
	$id_noticia = $row[0];
	$tipo = $row[1];
	$titulo = $row[2];
	$texto = $row[3];
	$publicacao = $row[5];
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
            <h3 class="mt-3"></h3>
                <div class="card mb-2">
                  <div class="card-body">
                    Título completo: <?php echo '<b>['.$tipo.'] - '.$titulo.'</b>'; ?><br />
                    Publicado em: <?php echo $publicacao; ?><br />
                    Anexo: <?php echo $anexo; ?><br />
                        </div>
                    </div>
                    <div class="card-header">
                    	<?php echo $texto; ?>
                    </div>
                    <br />
                    <input type="button" value="Voltar para a página de notícia" class="btn btn-info btn-sm float-right" onclick="Conteudo('../views/noticias/views_noticia.php')">
                    </div>
            </div>
        </div>            
    </div>
<?php
}
?>