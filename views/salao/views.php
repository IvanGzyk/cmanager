<?php
//require '../../web/vendor/autoload.php';
require_once '../../controllers/salaocontroller.php';

//use benhall14\phpCalendar\Calendar as Calendar;

if (isset($_GET['data'])) {
    $data = date($_GET['data'] . "-d");
} else {
    $data = date('Y-m-d');
}
$reserva = new salaocontroller;

$dataatual = date('m/y');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
        <link href="../../web/css/styles.css" rel="stylesheet" />
        <script src="../web/js/all.min.js"></script>
    </head>
    <body>
            <div id="layoutSidenav_content">
                    <div class="container-fluid">
                        <h1 class="mt-3">Agenda do Salão de Festas</h1>
                        <div class="card mb-2">
                        <div class="card-body">Antes de reservar o salão, escolha o mês desejado e clique em "REALIZAR RESERVA DO SALÃO".<br />Na próxima tela, será possível definir qual salão e a data desejada.</div>
                        </div>
                        <br><br>
						<div class="container">
        <form action="#" class="form-group" method="POST">   
 		<div class="card-body">
 		<label>Escolha o mês desejado</label>
 			<div class="row">
 				<div class="input-group col-md-4">
 					<input class="form-control" type="month" value="<?= date('Y-m') ?>" name="data">
 				<div class="input-group-btn ">
 					<input class="btn btn-primary" type="submit">
 				</div>
 			</div>
            
            <div class="input-group col-md-4">
            <button onclick="Conteudo('../views/salao/form_reserva.php')"  class="btn btn-primary">Realizar Reserva do Salão</button>
            </div>
 		</div>
 </div>
        </form>
    </div>
    <?php
    echo $reserva->Calendario($data);
    ?>
</div>
</body>
</html>