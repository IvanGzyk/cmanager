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
    $condo = $_GET['doc'];
}
if (isset($_GET['dados'])) {
    @$dados = $_GET['dados'];
}
$usuario = new UsuarioController();
$tabela = $usuario->Relatorio($nome, $tipo, $doc, $id_tipo, $dados);
echo $tabela;
