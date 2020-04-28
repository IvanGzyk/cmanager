<?php
include '../../config/conexao.php';
include_once '../../controllers/usuariocontroller.php';
$usuario = new usuariocontroller();
$opcao_cond = $usuario->SelectCondominio();
$opcao = $usuario->SelectTipo();
$opcao_bl = $usuario->SelectBloco();
$opcao_ap = $usuario->SelectApartamento();
?>
<legend>Cadastro de Usuario</legend>
<div class="container">
    <form action="../views/usuario/create.php" method="POST" class="form-group">  
        <div class="form-row">          
            <div class="form-group col-md-6">
                Documento: <input type="text" class="form-control" name="doc">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                Nome:<input type="text" class="form-control" name="nome">
            </div>
            <div class="form-group col-md-6">
                Tipo:
                <select name="tipo" class="form-control">
                    <?= $opcao ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                Senha:<input type="password" class="form-control" name="senha">
            </div>
            <div class="form-group col-md-6">
                Condominio:
                <select name="tipoCond" class="form-control">
                    <?= $opcao_cond ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                Bloco:
                <select name="blc" class="form-control">
                    <?= $opcao_bl ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                Apartamento:
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
                <label>E-mail principal (<font color="#FF0000">*</font>)</label>
                <input id="emailprinc" type="text" class="form-control" name="emailprinc">
            </div>
            <div class="form-group col-md-6">
                <label>E-mail alternativo</label>
                <input id="emailalter" type="text" class="form-control" name="emailalter">
            </div>
            <input type="submit" value="Gravar" class="btn btn-primary">

            </form>
        </div>
</div>