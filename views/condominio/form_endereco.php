<?php
include '../../config/conexao.php';
include_once '../../controllers/condominiocontroller.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <!--<link href="../../web/css/styles.css" rel="stylesheet" />
        <script src="../web/js/all.min.js"></script>
        <script src="../web/js/jquery-3.3.1.slim.min.js"></script>
        <script src="../web/js/mascara.js"></script>-->
        <script>
            var maskCNPJ = IMask(document.getElementById('cnpj'), {
                mask: [{
                        mask: '00.000.000/0000-00',
                        maxLength: 18}]});

            var maskCEP = IMask(document.getElementById('cep'), {
                mask: [{
                        mask: '00000-000',
                        maxLength: 9}]});
        </script>
    </head>
    <body>
        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <h1 class="mt-3">Cadastrar Novo Condomínio</h1>
                <div class="card mb-2"> </div>
                <br><br>
                <div class="container">
                    <form action="../views/condominio/create.php?cond=true" method="POST" class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nome do Condomínio</label>
                                <input type="text" class="form-control" name="nome_cond" required="required">
                            </div>
                            <div class="form-group col-md-6">
                                <label>CNPJ</label>
                                <input id="cnpj" type="numeric" class="form-control" name="cnpj" required="required">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Rua</label>
                                <input type="text" class="form-control" name="rua" required="required">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Número</label>
                                <input type="numeric" class="form-control" name="num" required="required">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Bairro</label>
                                <input type="text" class="form-control" name="bairro" required="required">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Estado</label>
                                <input type="text" class="form-control" name="estado" required="required">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Cidade</label>
                                <input type="text" maxlength="14" class="form-control" name="cidade" required="required">
                            </div> 
                            <div class="form-group col-md-6">
                                <label>CEP</label>
                                <input id="cep" type="text" maxlength="14" class="form-control" name="cep" required="required">		</div> 
                        </div>

                        <input type="submit" value="Cadastrar Condomínio" class="btn btn-primary float-right">
                    </form>

                </div>
                </body>
                </html>