<?php
include '../../config/conexao.php';
include_once '../../controllers/usuariocontroller.php';
$usuario = new UsuarioController();
$opcao_cond = $usuario->SelectCondominio();
$opcao = $usuario->SelectTipo();
$opcao_bl = $usuario->SelectBloco();
$opcao_ap = $usuario->SelectApartamento();
?>
<legend>Cadastro de Usuario</legend>
<div class="container">
    <form action="../views/usuario/create.php" method="POST" class="form-group">            
            <div class="form-group">
                Documento: <input type="text" class="form-control" name="doc">
            </div>
            <div class="form-group">
                Nome:<input type="text" class="form-control" name="nome">
            </div>
            <div class="form-group">
                Tipo:
                <select name="tipo" class="form-control">
                    <?= $opcao ?>
                </select>
            </div>
            <div class="form-group">
                Senha:<input type="password" class="form-control" name="senha">
            </div>
            <div class="form-group">
                Condominio:
                <select name="tipoCond" class="form-control">
                    <?= $opcao_cond ?>
                </select>
            </div>
            <div class="form-group">
                Bloco:
                <select name="blc" class="form-control">
                    <?= $opcao_bl ?>
                </select>
            </div>
            <div class="form-group">
                Apartamento:
                <select name="ap" class="form-control">
                    <?= $opcao_ap ?>
                </select>
            </div>
            <input type="submit" value="Gravar" class="btn btn-primary">

        </form>
</div>