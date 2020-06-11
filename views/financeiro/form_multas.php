<?php
require '../../config/conexao.php';
$db = new Conexao();

$query = "SELECT id, blc, ap FROM Predio WHERE condominio = '13.457.853/0001-07'";
$result = mysqli_query($db->con, $query);
$option = "<option value='0'></option>";
while ($row = mysqli_fetch_row($result)) {
    $value = $row[0];
    $campo = $row[1] . $row[2];
    $option .= "<option value='$value'>$campo</option>";
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
                <h1 class="mt-3">Cadastro de Multas</h1>
                <div class="card mb-2"> </div>
                <br><br>
                <div class="container">
                    <form action="../views/financeiro/gerar_multas.php" method="POST" class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Data:</label>
                                <input type="date" name="data" class='form-control' required="required">
                                <label>Valor:</label>
                                <input type="text" name="valor" class='form-control' required="required">
                                <label>Apartamento:</label>
                                <select name='ap' class='form-control' required="required">
                                    <?= $option ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Descrição:</label>
                                <textarea class="form-control" rows="7"  name="descricao"></textarea>
                            </div>
                        </div>
                        <input type="submit" value="Salvar" class="btn btn-primary float-right">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

