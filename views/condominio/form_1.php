
<?php
include '../../config/conexao.php';
$db = new Conexao();
$con = $db->con;

$opcao_cond = "";
$condo = $_GET['cond'];
$condominio = "SELECT * FROM CadastrCpf_Cnpj
WHERE cpf_cnpj = $condo;";

$result = mysqli_query($con, $condominio);
while ($row = mysqli_fetch_row($result)){
    $cnpj = $row[0];
    $nome = $row[1];
    $opcao_cond = "<input type='text' class='form-control form-control-lg' name='salva' value='$cnpj'>";
    $opcao_nome = "<input type='text' class='form-control form-control-lg' name='nome' value='$nome'>";
}
?>
<div class="usuario_form">
    <fieldset>
        <form action="../views/condominio/create.php" method="POST">
            <div class="form-group">
                Condominio:<?=$opcao_nome?>
            </div>
            
            <div class="form-group">
                Cnpj:<?=$opcao_cond?>
            </div>
            
            <div class="form-group">
                Bloco:<input type="text" class="form-control form-control-lg" name="blc">
            </div>
            
            <div class="form-group">
                Apartamento:<input type="number" class="form-control form-control-lg" name="apt" value="0">
            </div>
            
            <input type="submit" value="Gravar" class="btn btn-primary">
        </form>
    </fieldset>
</div>