<!DOCTYPE html>
<?php
include_once '../controllers/financeirocontroller.php';
include_once '../views/financeiro/constroe_dados_grafico.php';
$financeiro = new financeirocontroller();
$cnpj = $Usuario['cond'];
?>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <link href="../../web/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <div id="layoutSidenav_content">
            <main> 
                <div class="container-fluid">
                    <div class="row p-3">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie mr-1"></i>Gráfico financeiro <small>(referência: <?php echo date('m/Y', strtotime('-1 months', strtotime(date('Y-m')))); ?>)</small><button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#extrato">EXTRATO DETALHADO</button>                                
                                </div>
                                <?php $financeiro->grafico_pizza($valores, $valores, $dados, $id1, $cores); ?>  
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar mr-1"></i>Balanço financeiro <small>(últimos 6 meses)</small>
                                </div>
                                <?php $financeiro->carrega_grafico_barras2($data, $tipo, $tipo1, $soma, $soma1, "'#8A2BE2'", "'#FF6347'", $id) ?>
                            </div>
                        </div>

                    </div>
                    <div class="row p-3">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar mr-1"></i>Balanço financeiro <small>(últimos 30 dias)</small></div>
                                <?php $financeiro->carrega_grafico_barras2($data2, $tipo2, $tipo21, $soma2, $soma21, "'#8A2BE2'", "'#FF6347'", $id2) ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area mr-1"></i>Acompanhamento de saldo <small>(últimos 6 meses)</small></div>
                                <?= $financeiro->grafic_linha($valores3, $titulo3, $data3, $id3, $color3); ?>
                            </div>
                        </div>

<div class="modal fade" id="extrato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="myModalLabel">Relatório detalhado de entrada/saída de despesas <small>(referência: <?php echo date('m/Y', strtotime('-1 months', strtotime(date('Y-m')))); ?>)</small></h6>
                    </div>
                    <div class="modal-body">
                    <small><?= $financeiro->Relatorio($cnpj); ?></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Fechar Relatório</button>
                    </div>
                </div>
            </div>
        </div> 
                    </div>
                </div>             
            </main>
        </div>        
    </body>
</html>

