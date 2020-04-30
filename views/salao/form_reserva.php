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
<legend>Reservar Salão</legend>
<div class="container">
    <form action="../views/salao/create_reserva.php" method="POST" class="form-group">
        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="date" value="<?= date('d-m-Y') ?>" name="data"> 
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                Salão:
                <select name="salao" class="form-control">
                    <?= $opcao ?>
                </select>
            </div>
        </div>
        <input type="submit" value="Gravar" class="btn btn-primary">
    </form>
</div>