<?php
if ($_POST) {
    include_once '../../controllers/usuariocontroller.php';
    $objUsuario = new UsuarioController();

    $dados = array($_POST['cpfCnpj'], md5($_POST['senha']), $_POST['tipo']);

    $logar = $objUsuario->Logar($dados);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>CManager - Gestão de Condomínios</title>
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../css/login.css">
    </head>
    <body class="login">
        <section class="h-100">
            <div class="container h-100">
                <div class="row justify-content-md-center h-100">
                    <div class="card-wrapper">
                        <div class="logo"><img src="../img/logo-cmanager.png"></div>
                        <div class="card fat">
                            <div class="card-body">
                                <h4 class="card-title" align="center">ACESSE SUA CONTA</h4>
                                <span id="alerta"></span>

                                <?php
                                if (isset($logar)) {
                                    ?>
                                    <?php echo '' . $logar . '<button type="button" class="close" data-dismiss="alert" aria-label="fechar"><span aria-hidden="true">&times;</span></button></div>'
                                    ?>
                                <?php } ?>

                                <form id="login" enctype="multipart/form-data" action="#" method="POST" onsubmit="return validarLogin()">

                                    <div class="form-group">
                                        <select class="form-control" name="tipo">
                                            <option value="0">Condomino</option>
                                            <option value="1">Síndico</option>  
                                            <option value="3">Administrador</option></select>
                                    </div>

                                    <div class="form-group">
                                        <input id="cpfCnpj" type="text" class="form-control" maxlength="18" name="cpfCnpj" placeholder="CPF/CNPJ" data-mask-for-cpf-cnpj></div>
                                    <div class="form-group"><input id="senha" type="password" class="form-control" name="senha" placeholder="Senha">
                                        <div class="mt-0 text-right"><a href="recuperar.php">Esqueceu seu acesso?</a></div>
                                    </div>

                                    <div class="form-group m-0">
                                        <button type="submit" class="btn btn-primary btn-block">ENTRAR</button></div>

                                    <div class="mt-3 text-center">Já é condomino? <a href="validar_condominio.php">Crie uma conta.</a></div>
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
        <script src="../js/validacao.js"></script>
        <script src="../js/mascara.js"></script>
        <script>
                                    var maskCpfOuCnpj = IMask(document.getElementById('cpfCnpj'), {
                                        mask: [{
                                                mask: '000.000.000-00',
                                                maxLength: 11}, {
                                                mask: '00.000.000/0000-00'
                                            }]});
        </script>
    </body>
</html>