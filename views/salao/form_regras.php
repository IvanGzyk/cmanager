<?php
include '../../config/conexao.php';
$db = new Conexao();
$condominio = $_GET['condominio'];
$salao = $_GET['Salao'];
$id = "";
$query = "SELECT id FROM Salao WHERE `condominio` = '$condominio'AND `Salao` ='$salao'";
$result = mysqli_query($db->con, $query);
?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-3">Regras para uso do salão</h1>
        <div class="card mb-2">
        </div>
        <br><br>
        <?php
        While ($row = mysqli_fetch_row($result)) {
            $id = $row[0];
        }

        $query = "SELECT * FROM Regras";
        $result = mysqli_query($db->con, $query);
        $form = "";
        while ($row = mysqli_fetch_row($result)) {

            if ($row[0] == 1) {
                $form .= "<legend>Regra: $row[1]</legend><br><br>
                <div class='form-row'>
                <div class='form-group col-md-6'>
                    <label>Aplica:</label>
                    <input type='checkbox' name='$row[0]' value='$row[0]'>
                </div>";
                $form .= "<div class='form-group col-md-6'>
                    <label>Plazo entre reservas</label>
                    <select name='plazo' class='form-control'>
                        <option value='0'></option> 
                        <option value='7'>Sete dias</option> 
                        <option value='15'>Quinze dias</option> 
                        <option value='30'>Um mês</option> 
                        <option value='90'>Três Meses</option>
                    </select>
                </div>";
            } else {
                $form .= "<legend>Regra: $row[1]</legend><br><br>
                <div class='form-row'>
                <div class='form-group col-md-6'>
                    <label>Aplica:</label>
                    <input type='checkbox' name='$row[0]' value='$row[0]'>
                </div>";
            }
            $form .= "</div>";
        }
        ?>

        <div class="container col-md-4">
            <form action="../views/salao/grava_regras.php?id_salao=<?=$id?>" method="POST" class="form-group">
                <?= $form ?>
                <input type="submit" value="Cadastrar Regras" class="btn btn-primary float-right">
            </form>
        </div>
    </div>
</div>
