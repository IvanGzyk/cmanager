<?php
require '../../config/conexao.php';
session_start();
$usuario = unserialize($_SESSION['usuario']);
$db = new Conexao();
$con = $db->con;
$query = "SELECT * FROM Usuario INNER JOIN CadastrCpf_Cnpj on CadastrCpf_Cnpj.cpf_cnpj = condominio WHERE cpfCnpj ='" . $usuario['doc'] . "'";
$result = mysqli_query($con, $query);
$condominio = "";
while ($row = mysqli_fetch_row($result)) {
    $condominio = $row[8];
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
                <h1 class="mt-3">Cadastrar Salão de Festas</h1>
                <div class="card mb-2"> </div>
                <br><br>
                <div class="container">
                    <form action="../views/salao/create.php" method="POST" class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Condominio</label>
                                <input type="text" class="form-control" name="cnpj" value="<?= $condominio ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Salão</label>
                                <input type="text" class="form-control" name="nome" required="required">
                            </div>
                        </div>
                        <input type="submit" value="Cadastrar Salão" class="btn btn-primary float-right">
                    </form>
                </div>
                </body>
                </html>
