<?php
	include_once '../../controllers/usuariocontroller.php';

	$objUsuario = new UsuarioController();
	$objUsuario->Desconecta();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>CManager - Gestão de Condomínios</title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="img/ico/condo.png">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>
<center><img src="../img/loading.gif" width="292px" height="247px"/></center>
<p align="center" class="small">Seu acesso foi encerrado com segurança.<br />Em instantes você será redirecionado para a página inicial.</p>
</body>
</html>