<?php
require '../../web/vendor/autoload.php';

use benhall14\phpCalendar\Calendar as Calendar;

if (isset($_GET['data'])) {
    $data = date($_GET['data'] . "-d");
} else {
    $data = date('Y-m-d');
}
$calendar = new Calendar();

$calendar->addEvent(
        '2020-04-30', # Data inicio
        '2020-04-30', # Data fim
        'Reservado', # Evento
        true, # should the date be masked - boolean default true
        ['myclass', 'abc']   # (optional) additional classes in either string or array format to be included on the event days
);
$dataatual = date('m/y');
?>
<legend>Agendas de salão</legend>
<div id="layoutSidenav_content">
    <div class="container">
        <form action="#" class="form-group" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12"  align="center">
                    <label>Escolha a data:</label>
                    <input type="month" value="<?=date('Y-m')?>" name="data"> 
                    <input type="submit"> 
                </div>
            </div>
        </form>
    </div>
    <?php
    echo $calendar->draw(date($data)); # mostra calendario do mês atual
    ?>
</div>