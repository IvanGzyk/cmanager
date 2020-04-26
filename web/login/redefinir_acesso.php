<?php
if($_POST) {
    include_once '../../controllers/usuariocontroller.php';
   
    $objUsuario = new UsuarioController();
	$dados = array($_POST['cpfCnpj'], $_POST['token'], md5($_POST['senha']));
	$resetar = $objUsuario->ResetarAcesso($dados);
}
?>
<?php
	include_once '../../config/conexao.php';
	$db = new Conexao();

	$token = $_GET['token'];
	$cpfCnpj =  base64_decode($_GET['cpfCnpj']);

	$checar = "SELECT cpfCnpj, token FROM Usuario WHERE cpfCnpj = '$cpfCnpj'";
	$resultado = mysqli_query($db->con, $checar);
	
	$pega_nome = "SELECT * FROM CadastrCpf_Cnpj WHERE cpf_cnpj = '$cpfCnpj'";
	$result_peganome = mysqli_query($db->con, $pega_nome);
	$row = mysqli_fetch_array($result_peganome, MYSQLI_ASSOC);

	if(mysqli_num_rows($resultado) > 0){
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Resetar Acesso - Condominium Manager</title>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body class="login">

<section class="h-100">
<div class="container h-100">
<div class="row justify-content-md-center align-items-center h-100">
<div class="card-register-wrapper">
<div class="logo"><img src="../img/logo-cmanager.png"></div>
<div class="card fat">
<div class="card-body">
<h4 class="card-title" align="center">RESETAR ACESSO</h4>

<span id="alerta"></span>

 	<?php 
    if (isset($resetar)){
    ?>
    <?php echo ''.$resetar.'<button type="button" class="close" data-dismiss="alert" aria-label="fechar"><span aria-hidden="true">&times;</span></button></div>' 
    ?>
    <?php } ?>

<form id="redefinicao" enctype="multipart/form-data" action="#" method="POST" onsubmit="return validarRedefinicao()">

<div class="form-row">
<div class="form-group col-md-6">
<label>CPF/CNPJ (<font color="#FF0000">*</font>)</label>
<input id="cpfCnpj" type="text" maxlength="14" class="form-control" name="cpfCnpj" value="<?php echo $cpfCnpj ?>" readonly>
</div>
<div class="form-group col-md-6">
<label>Nome completo</label>
<input type="text" class="form-control" value="<?php echo $row['nome'] ?>" readonly>
</div>
</div>

<div class="form-row align-self">
<div class="form-group col-md-12">
<label>Token (<font color="#FF0000">*</font>)</label>
<input id="token" type="text" class="form-control" name="token" value="<?php echo $token ?>" readonly>
</div>
</div>

<div class="form-row">
<div class="form-group col-md-6">
<label>Nova senha (<font color="#FF0000">*</font>)</label>
<input id="senha" type="password" class="form-control" name="senha">
</div>
<div class="form-group col-md-6">
<label>Confirme a nova senha (<font color="#FF0000">*</font>)</label>
<input id="confirmarsenha" type="password" class="form-control" name="confirmarsenha">
</div>
</div>

<div class="form-group col-md-0">
<div class="alert alert-warning" role="alert">
<center><small><b>INTENSIDADE DA SENHA</b></small></center>
<p align="center"><small>A força da senha deve ficar em <font color="#00CC66"><b>Muito Bom!!!</b></font> para que você possa seguir com o cadastro. Como dica, a senha deve ter no mínimo 8 caracteres com: letras maiúsculas, minúsculas, números e caracter especial.</small></p>
<div id="barra" class="progress" style="display: none;">
<div id="forca-senha" class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
</div>
</div>
</div>
</div>

<div class="form-group m-0">
<button type="submit" class="btn btn-primary btn-block">RESETAR INFORMAÇÕES</button>
</div>

</form>
</div>
</div>
</div>
</div>
</div>
</section>
	<script src="../js/jquery-3.3.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/forcaSenha.js"></script>
    <script src="../js/bootstrap-validate.js"></script>
    <script src="../js/validacao.js"></script>
    <script>
	// Validação de campos do cadastro com bootstrap. (apenas caráter informativo ao consumidor final) - Regra de negócio.
	bootstrapValidate('#senha', 'required:Preenchimento obrigatório.');
	bootstrapValidate('#confirmarsenha', 'required:Preenchimento obrigatório.');
	bootstrapValidate('#confirmarsenha', 'matches:#senha:As senhas não conferem.');
	</script>
</body>
</html>
<?php
}else{
    echo '<script>
        alert("#RED014 - As credenciais para recuperação de acesso está divergente.\nPor favor, tente novamente ou contate o síndico do seu condomínio.");
	window.location="recuperar.php";
        </script>';
}
?>