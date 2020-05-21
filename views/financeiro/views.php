<!DOCTYPE html>
<?php
include_once '../controllers/graficoscontroller.php';
include_once '../views/financeiro/constroe_dados_grafico.php';
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
                                <div class="card-header">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Balanço ultimo mês.
                                    <small>(referencia: <?php echo date('m/Y', strtotime('-1 months', strtotime(date('Y-m')))); ?>)</small>
                                </div>
                                <?php $grafico->grafico_pizza($valores, $valores, $dados, $id1, $cores); ?>  
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Balanço ultimos 6 mêses.
                                </div>
                                <?php $grafico->carrega_grafico_barras2($data, $tipo, $tipo1, $soma, $soma1, "'#8A2BE2'", "'#FF6347'", $id) ?>
                            </div>
                        </div>

                    </div>
                    <div class="row p-3">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Balanço ultimos 30 dias.
                                </div>
                                <?php $grafico->carrega_grafico_barras2($data2, $tipo2, $tipo21, $soma2, $soma21, "'#8A2BE2'", "'#FF6347'", $id2) ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Acompanhamento do saldo dos ultimos 6 meses.
                                </div>
                                <?= $grafico->grafic_linha($valores3, $titulo3, $data3, $id3, $color3); ?>
                            </div>
                        </div>
                    </div>
                </div>             
            </main>
        </div>        
    </body>
</html>

