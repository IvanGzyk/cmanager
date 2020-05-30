<?php
include_once '../../config/conexao.php';

$db = new Conexao();

session_start();
$Usuario = unserialize($_SESSION['usuario']);
$doc = $Usuario['doc'];

date_default_timezone_set('America/Sao_Paulo');

$consumo = "SELECT * FROM ConsumoDeAgua ORDER BY id DESC";
$resultado = mysqli_query($db->con, $consumo);
$row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

$cubico = $row['valorMedido'] / 1000;
$cubico_int = number_format($cubico, 0, ",", "");
$unidades = 112;

if ($cubico_int >= '0' && $cubico_int <= '560') {
    $valor = 4342.24;
} else if ($cubico_int >= '560' && $cubico_int <= '1120') {
    $valor = 4342.24;
    for ($i = 561; $i <= $cubico_int; $i++) {
        $valor += 1.20;
    }
} else if ($cubico_int >= '1121' && $cubico_int <= '1680') {
    $valor = 5014.24;
    for ($i = 1121; $i <= $cubico_int; $i++) {
        $valor += 6.68;
    }
} else if ($cubico_int >= '1681' && $cubico_int <= '2240') {
    $valor = 8755.04;
    for ($i = 1681; $i <= $cubico_int; $i++) {
        $valor += 6.72;
    }
} else if ($cubico_int >= '2241' && $cubico_int <= '3360') {
    $valor = 12518.24;
    for ($i = 2241; $i <= $cubico_int; $i++) {
        $valor += 6.77;
    }
} else if ($cubico_int > '3360') {
    $valor = 20100.64;
    for ($i = 3361; $i <= $cubico_int; $i++) {
        $valor += 11.46;
    }
}

$porcentagem = 85 / 100;
$esgoto = $porcentagem * $valor;
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <link href="../../web/css/styles.css" rel="stylesheet" />
        <script src="../../web/js/all.min.js"></script>
        <script src="charts-consumo.js"></script>
    </head>
    <body>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-3">Consumo de Água</h1>
                    <div class="card mb-2">
                        <div class="card-body">Acompanhe o consumo total de água do condomínio.<br />Caso encontre irregularidades, acione o botão <font color="#FF0000"><b>REPORTAR VAZAMENTO</b></font> para que um aviso rápido seja enviado ao seu síndico.</div>
                    </div>
                    <div class="w-100 p-2"><br /></div>
                    <div class="row p-3">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header align-items-center">Consumo de água <small>(referencia: <?php echo date('m/Y'); ?>)</small> <button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#vazamento">REPORTAR VAZAMENTO</button></div>
                                <div class="card-body">
                                    <h3 class="text-center"><?php echo $cubico_int; ?> m³ <small>(<?php echo $row['valorMedido']; ?> Litros)</small></h3>
                                </div>
                                <div class="card-footer small text-right">Última atualização em: 
                                    <?php echo date("d/m/Y H:i", strtotime($row['atualizacao'])); ?>
                                </div>
                            </div>

                            <div class="col-lg-14">
                                <div class="card mb-4">
                                    <div class="card-header">Valor estimado da fatura (R$)</div>
                                    <div class="card-body">
                                        <h3 class="text-center">
                                            TOTAL: R$ <?php echo number_format($valor + $esgoto, 2, ",", "."); ?>
                                        </h3>
                                    </div>
                                    <div class="card-footer small text-center">ÁGUA: R$ <?php echo number_format($valor, 2, ",", "."); ?> - ESGOTO: R$ <?php echo number_format($esgoto, 2, ",", "."); ?> - POR UNIDADE: R$ <?php echo number_format(($valor + $esgoto) / $unidades, 2, ",", "."); ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header"><i class="fas fa-chart-bar mr-1"></i> Dashboard de consumo em litros e valores (últimos 6 meses)</div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="49"></canvas></div>

                            </div>
                        </div>

                    </div>
                </div>             
            </main>
        </div>

        <div class="modal fade" id="vazamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="myModalLabel"><font color="#FF0000">Reporte de possível vazamento de água</font></h6>
                    </div>
                    <div class="modal-body">
                        <small>A sua solicitação será encaminhada para averiguação do síndico.</small><br />
                        <small><b>Você deseja realmente criar o alerta de vazamento?</b></small></div>
                    <div class="modal-footer">
                        <?php
                        echo "<a class='btn btn-danger btn-sm' href='alerta-notificacao.php?cpfCnpj=" . $doc . "'>Enviar alerta</a><br>";
                        ?>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>


        <script src="../../web/js/jquery-3.4.1.min.js"></script>
        <script src="../../web/js/bootstrap.bundle.min.js"></script>
        <script src="../../web/js/scripts.js"></script>
        <script src="../../web/js/Chart.min.js"></script>
        <script>
            $('document').ready(function () {

                $.ajax({
                    type: "POST",
                    url: "../views/consumo/dashboard.php",
                    dataType: "json",
                    success: function (data) {

                        var data_array = [];
                        var valor_array = [];
                        var reais_array = [];

                        for (var i = 0; i < data.length; i++) {

                            data_array.push(data[i].nome_mes);
                            valor_array.push(data[i].valorMedido);
                            reais_array.push(data[i].valor);

                        }
                        grafico(data_array, valor_array, reais_array);
                    }
                });

            })

            function grafico(nome_mes, valorMedido, valor) {

                Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                Chart.defaults.global.defaultFontColor = '#292b2c';

                var ctx = document.getElementById("myBarChart");
                var myLineChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: nome_mes,

                        datasets: [{
                                label: "Valor em (L)",
                                backgroundColor: "rgba(2,117,216,1)",
                                borderColor: "rgba(2,117,216,1)",
                                data: valorMedido
                            }, {
                                label: "Valor em R$",
                                backgroundColor: "rgba(2,35,102,35)",
                                borderColor: "rgba(2,35,102,35)",
                                data: valor
                            }]

                    },

                    options: {
                        scales: {
                            xAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    },
                                    gridLines: {
                                        display: false
                                    }
                                }]
                        },
                        legend: {
                            display: true
                        }
                    }
                });
            }
        </script>
    </body>
</html>