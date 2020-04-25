<?php
include '../../config/conexao.php';
$db = new Conexao();
$con = $db->con;

$opcao_condo = "";

$condominio = "SELECT * FROM Usuario
INNER JOIN CadastrCpf_Cnpj ON CadastrCpf_Cnpj.cpf_cnpj = cpfCnpj
WHERE tipoUser = '4';";

$result = mysqli_query($con, $condominio);

while ($row = mysqli_fetch_row($result)){
    $opcao_condo .= "<option value='$row[1]'>$row[8]</option> ";
}
?>
<div class="usuario_form">
    <fieldset>
        <form action="#" method="POST">          
            <div class="form-group">
                Condominio:
                <select name="condominio" class="form-control">
                    <?= $opcao_condo ?>
                </select>
            </div>
            <input type="submit" value="Proximo" class="btn btn-primary">
        </form>
    </fieldset>
</div>