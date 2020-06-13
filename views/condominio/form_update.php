<?php
include '../../config/conexao.php';
$db = new Conexao();
$con = $db->con;

$opcao_cond = "";
$id = $_GET['atualiza'];
$cnpj = "";
$condominio = "SELECT * FROM Predio WHERE id = $id;";

$result = mysqli_query($con, $condominio);
while ($row = mysqli_fetch_row($result)) {
    $cnpj = $row[1];
}

$nomeCond = "SELECT nome, condominio AS cnpj, blc, ap FROM CadastrCpf_Cnpj 
INNER JOIN Predio ON Predio.id = $id
WHERE cpf_cnpj = '$cnpj';";

$result = mysqli_query($con, $nomeCond);
while ($row = mysqli_fetch_row($result)) {
    $cond = $row[0];
    $blc = $row[2];
    $apt = $row[3];
    $opcao_nome = "<input type='text' class='form-control form-control-lg' name='salva' value='$cond'>";
    $opcao_cnpj = "<input type='text' class='form-control form-control-lg' name='salva' value='$cnpj'>";
    $opcao_blc = "<input type='text' class='form-control form-control-lg' name='blc' value='$blc'>";
    $opcao_apt = "<input type='text' class='form-control form-control-lg' name='apt' value='$apt'>";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <!--<link href="../../web/css/styles.css" rel="stylesheet" />
        <script src="../web/js/all.min.js"></script>-->
    </head>
    <body>
        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <h1 class="mt-3">Atualizar Apartamento</h1>
                <div class="card mb-2"></div>
                <div class="usuario_form">
                    <fieldset>
                        <form action="../views/condominio/update.php?id=<?= $id ?>" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Bloco</label>
                                    <?= $opcao_blc ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Apartamento</label>
                                    <?= $opcao_apt ?>
                                </div>
                            </div>
                            <input type="submit" value="Atualizar Apartamento" class="btn btn-primary float-right">
                        </form>
                    </fieldset>
                </div>
                </body>
                </html>