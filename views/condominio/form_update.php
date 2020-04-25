<?php

include '../../config/conexao.php';
$db = new Conexao();
$con = $db->con;

$opcao_cond = "";
$id = $_GET['atualiza'];
$cnpj = "";
$condominio = "SELECT * FROM Predio WHERE id = $id;";

$result = mysqli_query($con, $condominio);
while ($row = mysqli_fetch_row($result)){
    $cnpj = $row[1];
}

$nomeCond = "SELECT nome, condominio AS cnpj, blc, ap FROM CadastrCpf_Cnpj 
INNER JOIN Predio ON Predio.id = $id
WHERE cpf_cnpj = '$cnpj';";

$result = mysqli_query($con, $nomeCond);
while ($row = mysqli_fetch_row($result)){
    $cond = $row[0];
    $blc = $row[2];
    $apt = $row[3];
    $opcao_nome = "<input type='text' class='form-control form-control-lg' name='salva' value='$cond'>";
    $opcao_cnpj = "<input type='text' class='form-control form-control-lg' name='salva' value='$cnpj'>";
    $opcao_blc = "<input type='text' class='form-control form-control-lg' name='blc' value='$blc'>";
    $opcao_apt = "<input type='text' class='form-control form-control-lg' name='apt' value='$apt'>";
}
?>
<div class="usuario_form">
    <fieldset>
        <form action="../views/condominio/update.php?id=<?=$id?>" method="POST">
            <!--<div class="form-group">
                Condominio:<?//=$opcao_nome?>
            </div>
            
            <div class="form-group">
                Cnpj:<?//=$opcao_cnpj?>
            </div>-->
            
            <div class="form-group">
                Bloco:<?=$opcao_blc?>
            </div>
            
            <div class="form-group">
                Apartamento:<?=$opcao_apt?>
            </div>
            
            <input type="submit" value="Gravar" class="btn btn-primary">
        </form>
    </fieldset>
</div>