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
<legend>Cadastro de Salão</legend>
<div class="container">
    <form action="../views/salao/create.php" method="POST" class="form-group">
        <div class="form-row">
            <div class="form-group col-md-6">
                Condominio:<input type="text" class="form-control" name="cnpj" value="<?= $condominio ?>" readonly>
            </div>
            <div class="form-group col-md-6">
                Salao:<input type="text" class="form-control" name="nome">
            </div>
        </div>
        <input type="submit" value="Gravar" class="btn btn-primary">
        </div>
    </form>
</div>
