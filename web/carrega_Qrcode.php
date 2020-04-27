<?php
include_once 'qr_code.php';

$code = new qr_code();

if(isset($_GET['pdf'])){
    $code->geraPdf();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/funcoes.js" type="text/javascript"></script>
        <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <script src="js/all.min.js"></script>
    </head>
    <body>
        <div id="layoutSidenav">
            <center><a href="carrega_Qrcode.php?pdf=true"> <button>Gerar Pdf</button></a></center>
            <div id="layoutSidenav_content">
                <main>
                    <legend>Codigo de acesso ao cadastro de moradores</legend>
                    
                    <center><?php $code->gera_qr_code(); ?></center>
                </main>
            </div>
        </div>
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/bootstrap.bundle.js"></script>
        <script src="js/scripts.js"></script>
        <script src="js/Chart.min.js"></script>
        <script src="js/chart-area-demo.js"></script>
        <script src="js/chart-bar-demo.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap4.min.js"></script>
        <script src="js/datatables-demo.js"></script>
    </body>
</html>


