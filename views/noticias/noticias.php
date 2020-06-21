<?php
session_start();
include_once '../../config/conexao.php';
$db = new Conexao();
$con = $db->con;
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $buscar = "SELECT * FROM Noticias where id = '$id';";
    $result = mysqli_query($con, $buscar);

    while ($row = mysqli_fetch_row($result)) {
        if ($row[5] != '' or NULL) {
            $anexo = '<a href="../web/img/upload/' . $row[5] . '">Efetuar download do anexo</a>';
        } else {
            $anexo = 'Nenhum anexo foi adicionado a esta notícia.';
		}

        $id_noticia = $row[0];
        $tipo = $row[2];
        $titulo = $row[3];
        $texto = $row[4];
        $publicacao = $row[6];
		
		$nome = "SELECT nome FROM Noticias INNER JOIN CadastrCpf_Cnpj ON CadastrCpf_Cnpj.cpf_cnpj = '" . $row[7] . "';";
	$result = mysqli_query($con, $nome);
	
	while ($row = mysqli_fetch_row($result)) {
                $autor = $row[0];
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
                        <h3 class="mt-3"></h3>
                        <div class="card mb-2">
                            <div class="card-body">
                                Título completo: <?php echo '<b>[' . $tipo . '] - ' . $titulo . '</b>'; ?><br />
                                Publicado em: <?php echo $publicacao; ?> por <?php echo $autor; ?><br />
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
}
if (isset($_GET['sugestao'])) {
    $id = $_GET['sugestao'];
    $usuario = unserialize($_SESSION['usuario']);
    $condo = $usuario['cond'];
    $query = "SELECT id, DATA, img, descricao, condominio, CadastrCpf_Cnpj.nome FROM sugestao
        INNER JOIN CadastrCpf_Cnpj ON CadastrCpf_Cnpj.cpf_cnpj = sugestao.morador
        WHERE visualizada = 'não'
        AND 
        condominio = '$condo'
        AND
        id = $id;";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_row($result)) {
        if ($row[2] != '' or $row[2] != NULL) {
            $anexo = '<a href="../web/img/sugestao/' . $row[2] . '">Efetuar download do anexo.</a>';
        } else {
            $anexo = 'Nenhum anexo foi adicionado na sugestão.';
        }

        $id_sugestao = $row[0];
        $data = $row[1];
        $descricao = $row[3];
        $nome = $row[5];
        $update = "UPDATE sugestao SET visualizada = 'sim' WHERE id = $id_sugestao";
        $execute = mysqli_query($db->con, $update);
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
                                Autor: <?php echo '<b>' . $nome . '</b>'; ?><br />
                                Publicado em: <?php echo $data; ?><br />
                                Anexo: <?php echo $anexo; ?><br />
                            </div>
                        </div>
                        <div class="card-header">
                            <?php echo $descricao; ?>
                        </div>
                        <br />
                        <a href="../web/index.php"><input type="button" value="Voltar para a página inicial" class="btn btn-info btn-sm float-right"></a>
                    </div>
                </div>
            </div>            
        </div>
        <?php
    }
}
?>