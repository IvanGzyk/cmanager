<?php

include '../../controllers/salaocontroller.php';
include_once '../../config/conexao.php';
    
$db = new Conexao();
$usuario = unserialize($_SESSION['usuario']);
$salao = new salaocontroller();
$reservar = $salao->ReservaSalao($_POST['salao'], $_POST['data'], $usuario['doc']);
if ($reservar != false) {
    $salao = $reservar->getSalao();
    $data = $reservar->getData();
    $user = $reservar->getCpf();
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
        `dataReserva` BETWEEN CURDATE() AND CURDATE() + INTERVAL $plazo DAY AND salao = $salao;";
        $result = mysqli_query($db->con, $query_reservas);
        $cont = mysqli_num_rows($result);
        if ($cont == 0) {
            $inserir = "INSERT INTO Reservas (salao, dataReserva, usuario)VALUES ('$salao', '$data', '$user');";
        } else {
            ?>
            <script language="javascript" type="text/javascript">
                alert('Você ja possui uma reserva abaixo do plazo de <?=$plazo?> dias, Procure seu Sindico.');
                location.href = '../../web/index.php';
            </script>
            <?php
        }
    } else {
        $inserir = "INSERT INTO Reservas (salao, dataReserva, usuario)VALUES ('$salao', '$data', '$user');";
    }
    $sql = mysqli_query($db->con, $inserir);
    ?>
    <script language="javascript" type="text/javascript">
        alert('Reserva feita com sucesso.');
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