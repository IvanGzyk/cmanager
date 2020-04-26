<!DOCTYPE html>
<html lang="pt-BR">
<head>
        <link href="../../web/css/styles.css" rel="stylesheet" />
        <script src="../../web/js/all.min.js"></script>
    </head>
    <body>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Consumo de Água</h1>
                        <div class="card mb-4">
                            <div class="card-body">Acompanhe o consumo total de água do condomínio.<br /> Caso identifique alguma irregularidade com os valores, você poderá acionar o botão <font color="#FF0000"><b>EMERGÊNCIA</b></font> para que um aviso rápido seja enviado ao seu síndico.</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Consumo de água</div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
                                    <div class="card-footer small text-muted">Última atualização em: XXXXXXXX</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-pie mr-1"></i>Comparativo com meses anteriores</div>
                                    <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        <script src="../../web/js/jquery-3.4.1.min.js"></script>
        <script src="../../web/js/bootstrap.bundle.min.js"></script>
        <script src="../../web/js/scripts.js"></script>
        <script src="../../web/js/Chart.min.js"></script>
        <script src="../../web/js/chart-area-demo.js"></script>
        <script src="../../web/js/chart-bar-demo.js"></script>
        <script src="../../web/js/chart-pie-demo.js"></script>
    </body>
</html>
