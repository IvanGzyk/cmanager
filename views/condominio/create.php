<script src="../../web/js/funcoes.js" type="text/javascript"></script>
<script src="../../web/js/jquery.min.js" type="text/javascript"></script>

<?php
include_once '../../config/conexao.php';
include '../../controllers/condominiocontroller.php';

$db = new Conexao();
//print_r($_POST);
//exit();
$cond = new CondominioController();
$condominio = $cond->Create($_POST['nome'], $_POST['salva'], $_POST['apt'], $_POST['blc']);
?><pre><?php
//print_r($condominio);
    ?></pre><?php
//exit();
$nome = $condominio->getCondo();
$doc = $condominio->getCpfCnpj();
$apt = $condominio->getApartamento();
$blc = $condominio->getBloco();

$query = "INSERT INTO Predio (condominio, blc,ap) VALUES ('$doc', '$blc', '$apt');";

$execute = mysqli_query($db->con, $query);

header("Location:../../web/index.php?cond=$doc");

?>

