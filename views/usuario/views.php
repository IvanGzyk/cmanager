<script src="../../web/js/funcoes.js" type="text/javascript"></script>
<script src="../../web/jquery.min.js" type="text/javascript"></script>
<?php
session_start();
//Recebe o Array com os dados do usuario que logou...
$Usuario = unserialize($_SESSION['usuario']);
//Pega o id do Tipo...
$id_tipo = $Usuario['tipo'];
include_once '../../controllers/usuariocontroller.php';
include_once '../../config/conexao.php';
$db = new Conexao();
$nome = "";
$tipo = "";
$doc = "";
$dados = "";
if (isset($_GET['nome'])) {
    $nome = $_GET['nome'];
}
if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
}
if (isset($_GET['doc'])) {
    $doc = $_GET['doc'];
}
if (isset($_GET['dados'])) {
    @$dados = $_GET['dados'];
}
$usuario = new UsuarioController();
$tabela = $usuario->Relatorio($nome, $tipo, $doc, $id_tipo, $dados);
?>
<legend>Relatório de Usuarios</legend>
<?php
if ($id_tipo == 3 || $id_tipo == 1) {
    ?>
    <input type="button" value="NOVO" class="btn btn-primary" onclick="Conteudo('../views/usuario/form.php')">
    <?php
}
?>
<table class="table table-hover">
    <thead>
        <tr>
            <td>Nome</td>
            <td>Tipo</td>
            <td>Doc</td>
            <td>Apartamento</td>
            <td>Ativo</td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <?php
    if ($id_tipo == 1 || $id_tipo == 3) {
        ?>
        <thead>
            <tr>
                <td class="serch"><form action="#" method="Post"><input type="search" name="nome"></form></td>
                <td class="serch"><form action="#" method="Post"><input type="search" name="tipo"></form></td>
                <td class="serch"><form action="#" method="Post"><input type="search" name="doc"></form></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </thead>    
        <?php
    }
    ?>
    <tbody>
        <?php echo $tabela ?>
    </tbody>
</table>
