<?php
include '../../config/conexao.php';
include_once '../../controllers/usuariocontroller.php';
$tipo = "";
if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
}
$id = $_GET['atualiza'];
$usuario = new UsuarioController();
$opcao_cond = $usuario->SelectCondominio();
$opcao = $usuario->SelectTipo();
$opcao_bl = $usuario->SelectBloco();
$opcao_ap = $usuario->SelectApartamento();
$user = $usuario->CarregaUpdateUser($_GET['atualiza']);
print_r($user);
?>
<legend>Atualização de Usuario: <?= $user['nome'] ?></legend>
<div class="container">
    <form action="../views/usuario/update.php?id=<?= $id ?>" method="POST" class="form-group">
        <div class="form-check">
        </div>
        <div class="form-group">
            Documento: <input type="text" class="form-control" name="doc" value="<?= $user['doc'] ?>">
        </div>
        <div class="form-group">
            Nome:<input type="text" class="form-control" name="nome" value="<?= $user['nome'] ?>">
        </div>
        <div class="form-group">
            Tipo:
            <select name="tipo" class="form-control">
                <?= $opcao ?>
            </select>
        </div>
        <div class="form-group">
            Senha:<input type="password" class="form-control" name="senha" value="<?= $user['senha'] ?>">
        </div>
        <div class="form-group">
            Ativo:
            <select name="ativo" class="form-control">
                <option value='0'>Não</option>
                <option value='1'>Sim</option>
            </select>
        </div>
        
        <div class="form-group">
            Condominio:
            <select name="tipoCond" class="form-control">
                <?= $opcao_cond ?>
            </select>
        </div>
        <input type="submit" value="Gravar" class="btn btn-primary">
    </form>
</div>