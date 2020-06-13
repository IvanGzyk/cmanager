<?php
include '../../config/conexao.php';
$db = new Conexao();
$con = $db->con;

$opcao_condo = "";

$condominio = "SELECT * FROM Usuario
INNER JOIN CadastrCpf_Cnpj ON CadastrCpf_Cnpj.cpf_cnpj = cpfCnpj
WHERE tipoUser = '4';";

$result = mysqli_query($con, $condominio);

while ($row = mysqli_fetch_row($result)) {
    $opcao_condo .= "<option value='$row[1]'>$row[8]</option> ";
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
                <h1 class="mt-3">Validar Condomínio - Cadastro Apartamento</h1>
                <div class="card mb-2"> </div>
                <br><br>
                <div class="container">
                    <form action="#" method="POST">          
                        <div class="form-group">
                            <label>Nome do Condomínio</label>
                            <select name="condominio" class="form-control" required="required">
                                <?= $opcao_condo ?>
                            </select>
                        </div>
                        <input type="submit" value="Próxima Etapa" class="btn btn-primary float-right">
                    </form>
                </div>
                </body>
                </html>