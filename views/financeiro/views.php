<!DOCTYPE html>
<?php
include_once '../controllers/graficoscontroller.php';
include_once '../config/conexao.php';
$grafico = new graficoscontroller();
$db = new Conexao();
$query = "SELECT data, SUM(valor) soma, entrada_saida FROM `Financeira` GROUP BY data, `entrada_saida`";
$executa = mysqli_query($db->con, $query);
$data = array();
$soma = array();
$tipo = '';
$soma1 = array();
$id = 'Chart';
$tipo1 = '';
while ($row = mysqli_fetch_row($executa)) {
    if (in_array($row[0], $data)) {
        
    } else {
        $data[] = $row[0];
    }
    if ($row[2] == 'entrada') {
        $soma[] = $row[1];
        $tipo = 'entrada';
    } else {
        $soma1[] = $row[1];
        $tipo1 = 'saida';
    }
}
$data = json_encode($data);
$soma = json_encode($soma);
$soma1 = json_encode($soma1);
?>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <link href="../../web/css/styles.css" rel="stylesheet" />
        <script src="../../web/js/all.min.js"></script>
        <script src="charts-consumo.js"></script>
        <script src="../../web/js/jquery-3.4.1.min.js"></script>
        <script src="../../web/js/bootstrap.bundle.min.js"></script>
        <script src="../../web/js/scripts.js"></script>
    </head>
    <body>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-3">Acompanhamento Financeiro</h1>
                    <div class="card mb-2">
                        <div class="card-body">Acompanhe a receita do condomínio.<br />Caso encontre alguma duvida, entre em contato com seu sindico.</div>
                    </div>
                    <div class="w-100 p-2"><br /></div>
                    <div class="row p-3">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header align-items-center">
                                    Financeiro 1
                                    <small>(referencia: <?php echo date('m/Y'); ?>)</small>
                                </div>                                

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Financeiro 2
                                </div>
                                <?php $grafico->carrega_grafico_barras2($data, $tipo, $tipo1, $soma, $soma1, "'#8A2BE2'", "'#FF6347'", $id) ?>
                                <!--<div class="card-body"><canvas id="myBarChart" width="100%" height="49"></canvas></div>-->

                            </div>
                        </div>

                    </div>
                </div>             
            </main>
        </div>        
    </body>
</html>

