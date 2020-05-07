<?php
include '../../config/conexao.php';
include_once '../../controllers/usuariocontroller.php';
$usuario = new usuariocontroller();
$opcao_cond = $usuario->SelectCondominio();
$opcao = $usuario->SelectTipo();
$opcao_bl = $usuario->SelectBloco();
$opcao_ap = $usuario->SelectApartamento();
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
                mask: [{
                        mask: '000.000.000-00',
                        maxLength: 11}, {
                        mask: '00.000.000/0000-00'
                    }]});

            var maskTelFixo = IMask(document.getElementById('telfixo'), {
                mask: [{
                        mask: '(00) 0000-0000',
                        maxLength: 14}]});

            var maskTelCel = IMask(document.getElementById('telcel'), {
                mask: [{
                        mask: '(00) 00000-0000',
                        maxLength: 15}]});
        </script>
    </head>
    <body>
        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <h1 class="mt-3">Cadastrar Novo Usuário</h1>
                <div class="card mb-2"> </div>
                <br><br>
                <div class="container">
                    <form action="../views/usuario/create.php" method="POST" class="form-group">  

                        <div class="form-group">
                            <label>CPF/CNPJ</label>
                            <input id="doc" type="text" maxlength="18" class="form-control" name="doc">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nome Completo</label>
                                <input type="text" class="form-control" name="nome">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tipo</label>
                                <select name="tipo" class="form-control">
                                    <?= $opcao ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Senha</label>
                                <input type="password" class="form-control" name="senha">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Condomínio</label>
                                <select name="tipoCond" class="form-control">
                                    <?= $opcao_cond ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Bloco</label>
                                <select name="blc" class="form-control">
                                    <?= $opcao_bl ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Apartamento</label>
                                <select name="ap" class="form-control">
                                    <?= $opcao_ap ?>
                                </select>
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
                                <label>E-mail principal</label>
                                <input id="emailprinc" type="text" class="form-control" name="emailprinc">
                            </div>
                            <div class="form-group col-md-6">
                                <label>E-mail alternativo</label>
                                <input id="emailalter" type="text" class="form-control" name="emailalter">
                            </div>
                        </div>
                        <input type="submit" value="Cadastrar Usuário" class="btn btn-primary float-right">

                    </form>
                </div>
            </div>            
        </div>
    </body>
</html>