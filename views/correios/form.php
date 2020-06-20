<?php
include '../../config/conexao.php';
$db = new Conexao();
$con = $db->con;

$opcao_query = "";

$query = "SELECT * FROM Usuario
INNER JOIN CadastrCpf_Cnpj ON CadastrCpf_Cnpj.cpf_cnpj = cpfCnpj WHERE length(cpf_cnpj) = 14;";

$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_row($result)){
    $opcao_query .= "<option value='$row[1]'>$row[8]</option> ";
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
                        <h1 class="mt-3">Cadastrar Nova Correspondência</h1>
                        <div class="card mb-2"> </div>
                        <br><br>
						<div class="container">
        <form action="../views/correios/create.php" method="POST" class="form-group">           
            
             <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nome do Destinatário <small>(nome que consta na carta)</small></label>
                <select name="cpfCnpj" class="form-control">
                    <?= $opcao_query ?>
                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mensagem</label>
    <textarea name="mensagem" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>
            <input type="submit" value="Cadastrar Notificação" class="btn btn-primary float-right">
        </form>
</div>
</body>
</html>