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
<legend>Agendas de salão</legend>
<div id="layoutSidenav_content">
    <div class="container">
        <form action="#" class="form-group" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12"  align="center">
                    <label>Escolha a data:</label>
                    <input type="month" value="<?= date('Y-m') ?>" name="data">
                    <input type="submit"> 
                </div>
            </div>
        </form>
        <button onclick="Conteudo('../views/salao/form_reserva.php')"  class="btn btn-primary">Reservar</button>
    </div>
    <?php
    echo $reserva->Calendario($data);
    ?>
</div>