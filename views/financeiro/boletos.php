<?php
session_start();
include_once '../../controllers/financeirocontroller.php';
$usuario = unserialize($_SESSION['usuario']);
$financeiro = new financeirocontroller();
$doc = $usuario['doc'];
$boletos = $financeiro->CarregoBletos($doc);
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
                <h1 class="mt-3">Boletos</h1>
                <div class="card mb-2"></div>
                <div class="col-lg-6">
                    
                    <?php echo $boletos; ?>
                    
                </div>
            </div>
        </div>
    </body>
</html>