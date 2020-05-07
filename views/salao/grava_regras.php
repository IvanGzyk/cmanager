<?php
include_once '../../config/conexao.php';
$db = new Conexao();
$query = "SELECT * FROM Regras;";
$result = mysqli_query($db->con, $query);
$cont = mysqli_num_rows($result);
for ($n = 1; $n <= $cont; $n++) {
    $valor = "";
    if (isset($_POST[$n])) {
        $salao = $_GET['id_salao'];
        $regra = $_POST[$n];
        if ($_POST[$n] == $_POST[1]) {
            $valor = $_POST['plazo'];
        }
        $inserir = "INSERT INTO salaoRegra (salao, regra, valor)VALUES ('$salao', '$regra', '$valor');";
        $sql = mysqli_query($db->con, $inserir);
    }
}
?>
<script language="javascript" type="text/javascript">
    alert('Regras gravadas com sucesso!');
    location.href = '../../web/index.php';
</script>