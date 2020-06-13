<?php
include '../../config/conexao.php';
$db = new Conexao();
$con = $db->con;

$opcao_condo = "";

session_start();
$Usuario = unserialize($_SESSION['usuario']);
$doc = $Usuario['doc'];

$condominio = "SELECT * FROM CadastrCpf_Cnpj WHERE length(cpf_cnpj) = 18";
$result = mysqli_query($con, $condominio);

while ($row = mysqli_fetch_row($result)){
    $opcao_condo .= "<option value='$row[0]'>$row[1]</option> ";
}

$documento = "SELECT * FROM CadastrCpf_Cnpj WHERE cpf_cnpj = '$doc';";
$result_1 = mysqli_query($con, $documento);

while ($row = mysqli_fetch_row($result_1)){
	$opcao_autor = "<option value='$row[0]'>$row[1]</option>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
        <!--<link href="../../web/css/styles.css" rel="stylesheet" />
        <script src="../web/js/all.min.js"></script>
        <script src="../web/js/tinymce.min.js"></script>-->
        <script>
    	tinymce.init({
      	selector: '#mensagem'
    	});
  </script>
</head>
<body>
            <div id="layoutSidenav_content">
                    <div class="container-fluid">
                        <h1 class="mt-3">Cadastrar Nova Notícia</h1>
                        <div class="card mb-2"> </div>
                        <br><br>
						<div class="container">
        <form action="../views/noticias/create.php" method="POST" class="form-group" enctype="multipart/form-data">
         <div class="form-group">
    		<label>Condomínio que receberá a notícia</label>
                <select name="condominio" class="form-control">
                    <?= $opcao_condo ?>
                </select>
            </div>  
            
            <div class="form-group">
    		<label>Autor da publicação</label>
                <select name="autor" class="form-control" readonly>
                    <?= $opcao_autor ?>
                </select>
            </div>           
            
             <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Tipo da Notícia</label>
                            <select class="form-control" name="tipo">
<option value="Notícia">Notícia</option>
<option value="Manutenção">Manutenção</option> 
<option value="Assembléia">Assembléia</option> 
<option value="Administração">Administração</option>
<option value="Outros">Outros</option>
</select>
                            </div>
                            <div class="form-group col-md-6">
                            <label>Título</label>
                                <input type="text" class="form-control" name="titulo">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                        <label>Selecione um anexo</label>
    <input type="file" name="imagem" class="form-control-file">
    </div>
                            <div class="form-group col-md-6">
                            <label>Mensagem</label>
    <textarea id="mensagem" name="mensagem" class="form-control" rows="3"></textarea>
                             </div>
                        </div>
            <input type="submit" value="Cadastrar notícia" class="btn btn-primary float-right">
        </form>
</div>
</body>
</html>