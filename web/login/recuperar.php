<?php
if ($_POST) {
    include_once '../../controllers/usuariocontroller.php';
   
    $objUsuario = new UsuarioController();
    $dados = array($_POST['email']);
    $recuperar = $objUsuario->RecuperarAcesso($dados);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>CManager - Gestão de Condomínios</title>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="shortcut icon" href="../img/ico/condo.png">
<link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body class="login">

<section class="h-100">
<div class="container h-100">
<div class="row justify-content-md-center align-items-center h-100">
<div class="card-wrapper">
<div class="logo"><img src="../img/logo-cmanager.png"></div>
<div class="card fat">
<div class="card-body">
<h4 class="card-title" align="center">RECUPERAR ACESSO</h4>

<span id="alerta"></span>

 	<?php 
    if (isset($recuperar)){
    ?>
    <?php echo ''.$recuperar.'<button type="button" class="close" data-dismiss="alert" aria-label="fechar"><span aria-hidden="true">&times;</span></button></div>' 
    ?>
    <?php } ?>

<form id="recuperar" enctype="multipart/form-data" action="#" method="POST" onsubmit="return validarRecuperacao()">
                                
<div class="form-group">
<div class="text-justify text">Ao clicar em <b>"Resetar informações"</b>, um link será enviado para o e-mail contendo todas as informações necessárias para a recuperação da conta. O e-mail poderá ser direcionado para o LIXO/SPAM dependendo do provedor de e-mail.
</div>
</div>
                                
<div class="form-group">
<label for="email">E-mail principal ou alternativo</label>
<input id="email" type="text" class="form-control" name="email" value=""></div>

<div class="form-group m-0">
<button type="submit" class="btn btn-primary btn-block">RESETAR INFORMAÇÕES</button>
</div>
                                
<div class="mt-3 text-center">Já possui uma conta? <a href="index.php">Acesse agora!</a></div>
<div class="mt-1 text-center">Já é condômino? <a href="validar_condominio.php">Crie uma conta.</a></div>
                                
</form>
</div>
</div>
</div>
</div>
</div>
</section>
	<script src="../js/jquery-3.3.1.slim.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-validate.js"></script>
    <script src="../js/validacao.js"></script>
    <script>
	bootstrapValidate('#email', 'required:Preenchimento obrigatório.');
	bootstrapValidate('#email', 'email:Insira um e-mail válido.');
	</script>
</body>
</html>