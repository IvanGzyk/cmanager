<?php
if ($_POST) {
    include_once '../../controllers/usuariocontroller.php';
   
    $objUsuario = new UsuarioController();
    $dados = array($_POST['cnpj'], md5($_POST['senha']));
    $validar = $objUsuario->ValidarCondominio($dados);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>CManager - Gestão de Condomínios</title>
    <link href="../../web/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="../../web/css/login.css">
</head>
<body class="login">
<section class="h-100">
<div class="container h-100">
<div class="row justify-content-md-center h-100">
<div class="card-wrapper">
<div class="logo"><img src="../img/logo-cmanager.png"></div>
<div class="card fat">
<div class="card-body">
<h4 class="card-title" align="center">VOCÊ É MORADOR?</h4>
<div class="form-group">
<div class="text-justify text">Para que seja possível seguir com o cadastro, você deve inserir os <b>dados do condomínio</b>. A informação poderá ser obtida nos corredores de cada bloco ou direto com o síndico.
</div>
</div>
<span id="alerta"></span>

    <?php 
    if (isset($validar)){
    ?>
    <?php echo ''.$validar.'<button type="button" class="close" data-dismiss="alert" aria-label="fechar"><span aria-hidden="true">&times;</span></button></div>' 
    ?>
    <?php } ?>
    
<form id="condominio" enctype="multipart/form-data" action="#" method="POST" onsubmit="return validarAcessoCadastro()">

<div class="form-group">
<input id="cnpj" type="text" class="form-control" maxlength="18" name="cnpj" placeholder="CNPJ"></div>
<div class="form-group"><input id="senha" type="password" class="form-control" name="senha" placeholder="Senha">
</div>

<div class="form-group m-0">
<button type="submit" class="btn btn-primary btn-block">VALIDAR CONDOMÍNIO</button></div>
<div class="mt-3 text-center">Já possui uma conta? <a href="index.php">Acesse agora!</a></div>
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
    <script src="../js/bootstrap-validate.js"></script>
    <script src="../js/validacao.js"></script>
    <script src="../js/mascara.js"></script>
    <script>
	var maskCpfOuCnpj = IMask(document.getElementById('cnpj'), {
	mask:[{
		mask: '00.000.000/0000-00',
		maxLength: 11}]});
	</script>
</body>
</html>