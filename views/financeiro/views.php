<!DOCTYPE html>
<?php
include_once '../controllers/financeirocontroller.php';
include_once '../views/financeiro/constroe_dados_grafico.php';
$financeiro = new financeirocontroller();
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
                                    <svg class="bi bi-pie-chart-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.985 8.5H8.207l-5.5 5.5a8 8 0 0013.277-5.5zM2 13.292A8 8 0 017.5.015v7.778l-5.5 5.5zM8.5.015V7.5h7.485A8.001 8.001 0 008.5.015z"/>
                                    </svg>
                                    Balanço ultimo mês.
                                    <small>(referencia: <?php echo date('m/Y', strtotime('-1 months', strtotime(date('Y-m')))); ?>)</small>
                                </div>
                                <?php $financeiro->grafico_pizza($valores, $valores, $dados, $id1, $cores); ?>  
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Balanço ultimos 6 mêses.
                                </div>
                                <?php $financeiro->carrega_grafico_barras2($data, $tipo, $tipo1, $soma, $soma1, "'#8A2BE2'", "'#FF6347'", $id) ?>
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
                                <?php $financeiro->carrega_grafico_barras2($data2, $tipo2, $tipo21, $soma2, $soma21, "'#8A2BE2'", "'#FF6347'", $id2) ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <svg class="bi bi-graph-up" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h1v16H0V0zm1 15h15v1H1v-1z"/>
                                    <path fill-rule="evenodd" d="M14.39 4.312L10.041 9.75 7 6.707l-3.646 3.647-.708-.708L7 5.293 9.959 8.25l3.65-4.563.781.624z" clip-rule="evenodd"/>
                                    <path fill-rule="evenodd" d="M10 3.5a.5.5 0 01.5-.5h4a.5.5 0 01.5.5v4a.5.5 0 01-1 0V4h-3.5a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                                    </svg>
                                    Acompanhamento do saldo dos ultimos 6 meses.
                                </div>
                                <?= $financeiro->grafic_linha($valores3, $titulo3, $data3, $id3, $color3); ?>
                            </div>
                        </div>
                        <div  class="col-lg-12">
                            <div class="container-fluid">
                                <h1 class="mt-3">Relatório de dispesas</h1>
                                <div class="card-header">
                                    <svg class="bi bi-table" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M14 1H2a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V2a1 1 0 00-1-1zM2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2z" clip-rule="evenodd"/>
                                    <path fill-rule="evenodd" d="M15 4H1V3h14v1z" clip-rule="evenodd"/>
                                    <path fill-rule="evenodd" d="M5 15.5v-14h1v14H5zm5 0v-14h1v14h-1z" clip-rule="evenodd"/>
                                    <path fill-rule="evenodd" d="M15 8H1V7h14v1zm0 4H1v-1h14v1z" clip-rule="evenodd"/>
                                    <path d="M0 2a2 2 0 012-2h12a2 2 0 012 2v2H0V2z"/>
                                    </svg>
                                    Relatório ultimo mês.
                                    <small>(referencia: <?php echo date('m/Y', strtotime('-1 months', strtotime(date('Y-m')))); ?>)</small>
                                </div>

                                <?= $financeiro->Relatorio($cnpj); ?>

                            </div>
                        </div> 
                    </div>
                </div>             
            </main>
        </div>        
    </body>
</html>

