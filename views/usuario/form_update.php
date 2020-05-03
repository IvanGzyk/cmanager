<?php
include '../../config/conexao.php';
include_once '../../controllers/usuariocontroller.php';
$tipo = "";
if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
}
$id = $_GET['atualiza'];
$usuario = new UsuarioController();
$opcao_cond = $usuario->SelectCondominio();
$opcao = $usuario->SelectTipo();
$opcao_bl = $usuario->SelectBloco();
$opcao_ap = $usuario->SelectApartamento();
$user = $usuario->CarregaUpdateUser($_GET['atualiza']);
if ($tipo == 3 || $tipo == 1) {
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
        <link href="../../web/css/styles.css" rel="stylesheet" />
        <script src="../web/js/all.min.js"></script>
        <script src="../web/js/jquery-3.3.1.slim.min.js"></script>
    	<script src="../web/js/mascara.js"></script>
    	<script>
			var maskDoc = IMask(document.getElementById('doc'), {
				mask:[{
					mask: '000.000.000-00',
					maxLength: 11},{
					mask: '00.000.000/0000-00'
					}]});
		</script>
    </head>
    <body>
            <div id="layoutSidenav_content">
                    <div class="container-fluid">
                        <h1 class="mt-3">Atualizar Informações do Usuário</h1>
                        <div class="card mb-2"> </div>
                        <br><br>
                         <div class="container">
                        <form action="../views/usuario/update.php?id=<?= $id ?>" method="POST" class="form-group">
                        
           	<div class="form-row">
    		<div class="form-group col-md-6">
            <label>CPF/CNPJ</label>
            <input id="doc" type="text" maxlength="18" class="form-control" name="doc" value="<?= $user['doc'] ?>">
            </div>
            <div class="form-group col-md-6">
            <label>Nome Completo</label>
            <input type="text" class="form-control" name="nome" value="<?= $user['nome'] ?>">
            </div>
  			</div>
            
            <?php if($tipo == 3){?>
            <div class="form-row">
    		<div class="form-group col-md-6">
            <label>Tipo</label>
            <select name="tipo" class="form-control">
            	<?= $opcao ?>
            </select>
            <?php } ?>
            </div>
            <div class="form-group col-md-6">
            <label>Senha</label>
            <input type="password" class="form-control" name="senha" value="<?= $user['senha'] ?>">
            </div>
            </div>
            
            <div class="form-row">
    		<div class="form-group col-md-6">
            <label>Status</label>
            <select name="ativo" class="form-control">
            	<option value='0'>Pendente</option>
            	<option value='1'>Ativo</option>
            </select>
            </div>
			<div class="form-group col-md-6">
            <label>Condomínio</label>
            <select name="tipoCond" class="form-control">
                    <?= $opcao_cond ?>
            </select>
            </div>
            </div>
            
            <input type="submit" value="Atualizar Informações" class="btn btn-primary float-right">
        </form>
    </div>
    </body>
    </html>
    <?php
} else {
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
                        <h1 class="mt-3">Atualizar Minhas Informações</h1>
                        <div class="card mb-2"> </div>
                        <br><br>
                         <div class="container">
        <form action="../views/usuario/update.php?id=<?= $id ?>" method="POST" class="form-group">
        
    	<div class="form-row">
    	<div class="form-group col-md-6">
        <label>Nome Completo</label>
        <input type="text" class="form-control" name="nome" value="<?= $user['nome'] ?>">
        </div>
        <div class="form-group col-md-6">
       	<label>Senha</label>
        <input type="password" class="form-control" name="senha" value="<?= $user['senha'] ?>">
        </div>
        </div>
        <input type="submit" value="Atualizar Informações" class="btn btn-primary float-right">
        </form>
    </div>
                             
                             
                        </div>
                    </div>            
            </div>
    <?php
}
?>
</body>
</html>