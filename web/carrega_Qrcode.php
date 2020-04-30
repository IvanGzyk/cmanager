<?php
include_once 'qr_code.php';

$code = new qr_code();

if (isset($_GET['pdf'])) {
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
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-3">Gerar QRCode</h1>
                    <div class="card mb-2">
                        <div class="card-body">Você poderá gerar o QRCode em PDF para que os condominos possam realizar o cadastro através do aparelho celular.<br />Para isto, clique em "GERAR QRCODE EM PDF". Em seguida, divulgue-o nos arredores do condomínio.</div>
                    </div>
                    <div class="w-100 p-2"><a href="carrega_Qrcode.php?pdf=true" target="_blank"><button type="button" class="btn btn-info btn-sm float-right">GERAR QRCODE EM PDF</button></a><br /></div>

                    <div class="row p-2 d-flex justify-content-center">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header text-center">QRCode para cadastro de moradores</div>
                                <div class="card-body" align="center"><?php $code->gera_qr_code(); ?></div>
                            </div>
                        </div>
                        </main>
                    </div>
                </div>
                <script src="js/jquery-3.4.1.min.js"></script>
                <script src="js/bootstrap.bundle.js"></script>
                </body>
                </html>


