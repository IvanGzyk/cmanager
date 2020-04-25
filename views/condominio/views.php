<script src="../../web/js/funcoes.js" type="text/javascript"></script>
<script src="../../web/jquery.min.js" type="text/javascript"></script>
<?php
//include_once '../../controllers/condominiocontroller.php';
include_once '../../config/conexao.php';
$db = new Conexao();
$con = $db->con;

$query = "SELECT * FROM Predio
INNER JOIN CadastrCpf_Cnpj ON condominio = CadastrCpf_Cnpj.cpf_cnpj;";

$result = mysqli_query($con, $query);
$tabela = "";

while ($row = mysqli_fetch_row($result)) {
    $id = $row[0];
    $atualiza = "'../views/condominio/form_update.php?atualiza=" . $id . "'";
    $deleta = "'../views/condominio/delete.php?deleta=" . $id . "'";
    $tabela .= "<tr>";
    $tabela .= "<td>$row[5]</td>";
    $tabela .= "<td>$row[1]</td>";
    $tabela .= "<td>$row[2]</td>";
    $tabela .= "<td>$row[3]</td>";
    $tabela .= '<td><input type="button" value="Atualiza" class="btn btn-primary" onclick="Conteudo(' . $atualiza . ')"></td>'; //lincar em uma função de Update.php row[0]
    $tabela .= '<td><input type="button" value="Apaga" class="btn btn-primary" onclick="Conteudo(' . $deleta . ')"></td>'; //lincar em uma função de Delete.php row[0]
    $tabela .= "</tr>";
}
?>
<input type="button" value="NOVO" class="btn btn-primary" onclick="Conteudo('../views/condominio/form.php')">
<table class="table table-hover">
    <thead>
        <tr>
            <td>Condominio</td>
            <td>Cnpj</td>
            <td>Bloco</td>
            <td>Apartamento</td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php echo $tabela ?>
    </tbody>
</table>