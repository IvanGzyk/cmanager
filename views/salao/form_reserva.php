<?php
require '../../config/conexao.php';
session_start();
$usuario = unserialize($_SESSION['usuario']);
$db = new Conexao();
$con = $db->con;
$query = "SELECT * FROM Usuario "
        . "INNER JOIN CadastrCpf_Cnpj on CadastrCpf_Cnpj.cpf_cnpj = condominio "
        . "INNER JOIN Salao on Salao.condominio = CadastrCpf_Cnpj.cpf_cnpj "
        . "WHERE cpfCnpj ='" . $usuario['doc'] . "'";

$result = mysqli_query($con, $query);
$opcao = "";
while ($row = mysqli_fetch_row($result)) {
    $opcao .= "<option value='$row[9]'>$row[11]</option> ";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
        <link href="../../web/css/styles.css" rel="stylesheet" />
        <script src="../web/js/all.min.js"></script>
    </head>
    <body>
            <div id="layoutSidenav_content">
                    <div class="container-fluid">
                        <h1 class="mt-3">Reservar Salão de Festas</h1>
                        <div class="card mb-2"> </div>
                        <br><br>
						<div class="container">
    <form action="../views/salao/create_reserva.php" method="POST" class="form-group">
        	<div class="form-row">
            <div class="form-group col-md-6">
            <label>Selecione o dia</label>
            <input class="form-control" type="date" value="<?= date('d-m-Y') ?>" name="data"> 
            </div>
            <div class="form-group col-md-6">
            <label>Salão</label>
            <select name="salao" class="form-control">
                <?= $opcao ?>
            </select>
            </div>
        </div>
        <input type="submit" value="Reservar Salão" class="btn btn-primary float-right">
    </form>
</div>
</body>
</html>