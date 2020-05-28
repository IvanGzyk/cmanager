<?php
include '../../controllers/salaocontroller.php';
include_once '../../config/conexao.php';

$db = new Conexao();
$usuario = unserialize($_SESSION['usuario']);
$salao = new salaocontroller();
$ap = "";
$query = "SELECT ap FROM apUser WHERE
    
cpf_cnpj = '".$usuario['doc']."'";
$result = mysqli_query($db->con, $query);
while ($row = mysqli_fetch_row($result)){
    $ap = $row[0];
}

$reservar = $salao->ReservaSalao($_POST['salao'], $_POST['data'], $ap);
if ($reservar != false) {
    $aluguel = "";
    $salao = $reservar->getSalao();
    $data = $reservar->getData();
    $apartamento = $reservar->getApartamento();
    $query_regras = "SELECT * FROM `salaoRegra` WHERE `salao` = $salao";
    $result = mysqli_query($db->con, $query_regras);
    $plazo = 0;
    $inserir = "";
    while ($row = mysqli_fetch_row($result)) {
        if ($row[2] == 1) {
            $plazo = $row[3];
        }
    }
    if ($plazo > 0) {
        $query_reservas = "SELECT * FROM `Reservas` WHERE 
        `dataReserva` BETWEEN '$data' AND '$data' + INTERVAL $plazo DAY "
                . "OR `dataReserva` BETWEEN '$data' - INTERVAL $plazo DAY AND '$data'"
                . "AND salao = $salao;";
        $result = mysqli_query($db->con, $query_reservas);
        $cont = mysqli_num_rows($result);
        if ($cont == 0) {
            $inserir = "INSERT INTO Reservas (salao, dataReserva, apartamento)VALUES ('$salao', '$data', '$apartamento');";
            $query = "SELECT condominio, valor FROM Salao where id = $salao";
            $result = mysqli_query($db->con, $query);
            while ($row = mysqli_fetch_row($result)) {
                $aluguel = $row[1];
                $financeiro = "INSERT INTO Financeira (condominio, salao, data, valor, descricao, entrada_saida) VALUES ('$row[0]', '$salao', '$data', '$row[1]', 'Aluguel', 'entrada');";
                $execute = mysqli_query($db->con, $financeiro);
            }
        } else {
            ?>
            <script language="javascript" type="text/javascript">
                alert('Você ja possui uma reserva abaixo do plazo de <?= $plazo ?> dias, Procure seu Sindico.');
                location.href = '../../web/index.php';
            </script>
            <?php
        }
    } else {
        $inserir = "INSERT INTO Reservas (salao, dataReserva, apartamento)VALUES ('$salao', '$data', '$apartamento');";
        $query = "SELECT condominio, valor FROM Salao where id = $salao";
        $result = mysqli_query($db->con, $query);
        while ($row = mysqli_fetch_row($result)) {
            $aluguel = $row[1];
            $financeiro = "INSERT INTO Financeira (condominio, salao, data, valor, descricao, entrada_saida) VALUES ('$row[0]', '$salao', '$data', '$row[1]', 'Aluguel', 'entrada');";
            $execute = mysqli_query($db->con, $financeiro);
        }
    }
    $sql = mysqli_query($db->con, $inserir);
    $mes = date_create($data);
    $mes = date_format($mes, 'M');
    ?>
    <script language="javascript" type="text/javascript">
        alert('Reserva feita com sucesso! O valor de R$<?= $aluguel?> sera cobrado no mes de <?=$mes?>');
        location.href = '../../web/index.php';
    </script>
    <?php
} else {
    ?>
    <script language="javascript" type="text/javascript">
        alert('Esta data já possui reserva. Por favor, tente outro dia.');
        location.href = '../../web/index.php';
    </script>
    <?php
}