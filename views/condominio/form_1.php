<?php
include '../../config/conexao.php';
$db = new Conexao();
$con = $db->con;

$opcao_cond = "";
$condo = $_GET['cond'];
$condominio = "SELECT * FROM CadastrCpf_Cnpj
WHERE cpf_cnpj = '$condo';";
$result = mysqli_query($con, $condominio);
while ($row = mysqli_fetch_row($result)) {
    $cnpj = $row[0];
    $nome = $row[1];
    $opcao_cond = "<input type='text' class='form-control' name='salva' value='$cnpj'>";
    $opcao_nome = "<input type='text' class='form-control' name='nome' value='$nome'>";
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
                <h1 class="mt-3">Cadastrar Apartamento</h1>
                <div class="card mb-2"> </div>
                <br><br>
                <div class="container">
                    <fieldset>
                        <form action="../views/condominio/create.php" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Nome do Condomínio</label>
                                    <?= $opcao_nome ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>CNPJ</label>
                                    <?= $opcao_cond ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Bloco</label>
                                    <input type="text" class="form-control form-control-lg" name="blc" required="required">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Apartamento</label>
                                    <input type="number" class="form-control form-control-lg" name="apt" value="0" required="required">
                                </div>
                            </div>
                            <input type="submit" value="Cadastrar Apartamento" class="btn btn-primary float-right">
                        </form>
                    </fieldset>
                </div>