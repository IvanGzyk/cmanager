<?php
session_start();
include '../../controllers/salaocontroller.php';
include_once '../../config/conexao.php';
$db = new Conexao();
$usuario = unserialize($_SESSION['usuario']);
$salao = new salaocontroller();
$reservar = $salao->ReservaSalao($_POST['salao'], $_POST['data'], $usuario['doc']);
print_r($reservar);
if ($reservar != false) {
    $salao = $reservar->getSalao();
    $data = $reservar->getData();
    $user = $reservar->getCpf();

    $inserir = "INSERT INTO Reservas (salao, dataReserva, usuario)VALUES ('$salao', '$data', '$user');";
    $sql = mysqli_query($db->con, $inserir);
} else {
    ?>
    <script language="javascript" type="text/javascript">
        alert('Esta data ja esta reservada, tente outro dia.');
        location.href='../../web/index.php';
    </script>
    <?php
}