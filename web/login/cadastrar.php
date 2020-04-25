<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Cadastro - Condominium Manager</title>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<?php

if($_POST) {
    include_once '../../controllers/usuariocontroller.php';
    $objUsuario = new UsuarioController();

    $dados = array($_POST['cpfCnpj'], $_POST['nome'], $_POST['telfixo'], $_POST['telcel'], $_POST['emailprinc'], $_POST['emailalter'], md5($_POST['senha']), $_POST['cnpj']);
	
    $cadastrar = $objUsuario->Cadastrar($dados);
}
?>
<?php
    include_once '../../config/conexao.php';

    $db = new Conexao();
	
    $getcnpj = $_GET['cnpj'];
  
    $valida = "SELECT cpfCnpj FROM Usuario WHERE cpfCnpj = '$getcnpj' and tipoUser='4'";
    $resultado = mysqli_query($db->con, $valida);
	
    $codigo = $_GET['codigo'];
    @$codigo_db = base64_encode(sha1(md5($getcnpj)));
	
	$pega_nome = "SELECT * FROM CadastrCpf_Cnpj WHERE cpf_cnpj = '$getcnpj'";
	$result_peganome = mysqli_query($db->con, $pega_nome);
	$row = mysqli_fetch_array($result_peganome, MYSQLI_ASSOC);
	
    if($codigo == $codigo_db){
?>
<body class="login">

<section class="h-100">
<div class="container h-100">
<div class="row justify-content-md-center h-100">
<div class="card-register-wrapper">
<div class="logo"><img src="../img/logo-cmanager.png"></div>
<div class="card fat">
<div class="card-body">
<h4 class="card-title" align="center">NOVO CADASTRO</h4>
<div class="alert alert-warning" role="alert"><small>Os campos com (<font color="#FF0000">*</font>) são de preenchimento obrigatório.</small></div>
  
    <span id="alerta"></span>
    <?php 
    if (isset($cadastrar)){
    ?>
    <?php echo ''.$cadastrar.'<button type="button" class="close" data-dismiss="alert" aria-label="fechar"><span aria-hidden="true">&times;</span></button></div>' 
    ?>
    <?php } ?>

<form id="cadastro" enctype="multipart/form-data" action="#" method="POST" onsubmit="return validarCadastro()">

<div class="form-row">
<div class="form-group col-md-6">
<label>CNPJ do Condomínio (<font color="#FF0000">*</font>)</label>
<input id="cnpj" type="text" maxlength="14" class="form-control" name="cnpj" value="<?php echo $_GET['cnpj'] ?>" readonly>
</div>
<div class="form-group col-md-6">
<label>Nome do condomínio</label>
<input type="text" class="form-control" value="<?php echo $row['nome'] ?>" readonly>
</div>
</div>
    
<div class="form-row">
<div class="form-group col-md-6">
<label>CPF/CNPJ (<font color="#FF0000">*</font>)</label>
<input id="cpfCnpj" type="text" maxlength="18" class="form-control" name="cpfCnpj">
</div>
<div class="form-group col-md-6">
<label>Nome completo/Razão Social (<font color="#FF0000">*</font>)</label>
<input id="nome" type="text" class="form-control" name="nome">
</div>
</div>

                                
<div class="form-row">
<div class="form-group col-md-6">
<label>Telefone fixo</label>
<input id="telfixo" type="text" maxlength="14" class="form-control" name="telfixo">
</div>
<div class="form-group col-md-6">
<label>Telefone celular</label>
<input id="telcel" type="text" maxlength="15" class="form-control" name="telcel">
</div>
</div>

<div class="form-row">
<div class="form-group col-md-6">
<label>E-mail principal (<font color="#FF0000">*</font>)</label>
<input id="emailprinc" type="text" class="form-control" name="emailprinc">
</div>
<div class="form-group col-md-6">
<label>E-mail alternativo</label>
<input id="emailalter" type="text" class="form-control" name="emailalter">
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label>Senha (<font color="#FF0000">*</font>)</label>
<input id="senha" type="password" class="form-control" name="senha">
</div>
<div class="form-group col-md-6">
<label>Confirme a senha (<font color="#FF0000">*</font>)</label>
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
<button type="submit" class="btn btn-primary btn-block">CONCLUIR CADASTRO</button>
</div>

<div class="mt-4 text-center">Você já possui uma conta? <a href="index.php">Acesse agora!</a></div>
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
    <script src="../js/mascara.js"></script>
    <script>
	var maskCpfOuCnpj = IMask(document.getElementById('cpfCnpj'), {
	mask:[{
		mask: '000.000.000-00',
		maxLength: 11},{
		mask: '00.000.000/0000-00'
		}]});
	
	var maskTelFixo = IMask(document.getElementById('telfixo'), {
	mask:[{
		mask: '(00) 0000-0000',
		maxLength: 14}]});
		
	var maskTelCel = IMask(document.getElementById('telcel'), {
	mask:[{
		mask: '(00) 00000-0000',
		maxLength: 15}]});
	</script>
    <script>
    // Validação de campos do cadastro com bootstrap.
    bootstrapValidate('#cpfCnpj', 'required:Preenchimento obrigatório.');
    bootstrapValidate('#nome', 'min:5:Insira no mínimo 5 caracteres.');
    bootstrapValidate('#emailprinc', 'required:Preenchimento obrigatório.');
    bootstrapValidate('#emailprinc', 'email:Insira um e-mail válido.');
    bootstrapValidate('#senha', 'required:Preenchimento obrigatório.');
    bootstrapValidate('#confirmarsenha', 'required:Preenchimento obrigatório.');
    bootstrapValidate('#confirmarsenha', 'matches:#senha:As senhas não conferem.');
    </script>
</body>
</html>
<?php
}else{
    echo '<script>
        alert("#CAD005 - O código de verificação do condomínio está divergente.\nPor favor, tente novamente ou contate o síndico do seu condomínio.");
	window.location="validar_condominio.php";
        </script>';
}
?>