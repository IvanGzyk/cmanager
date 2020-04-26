<?php
	
include_once '../controllers/menucontroller.php';

session_start();

//Recebe o Array com os dados do usuario que logou...
$Usuario = unserialize($_SESSION['usuario']);
//Pega o id do Tipo...
$tipo = $Usuario['tipo'];
$doc = $Usuario['doc'];
$menucontrole = new MenuController();
$menu = $menucontrole->Menu($tipo, $doc);

//Verifica se a sessão do usuário foi iniciada. Caso contrário, informa que deve fazer login.
if (!isset($_SESSION['usuario'])){ 
	header('location: ../web/script/naologado.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <title>Cmanager</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/funcoes.js" type="text/javascript"></script>
        <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <script src="js/all.min.js"></script>
    </head>
    <body>
        <!-- Carregar menu aqui-->
        <?= $menu ?>

        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <div id="principal">
                        conteúdo aqui
                    </div>
                </main>


                <footer class="py-3 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-end justify-content-end small">
                            <div class="text-muted">Copyright &copy; 2020 - Condominium Manager. Todos os direitos reservados.</div>
                        </div>
                    </div>
                </footer>

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

<?php
if (isset($_POST['condominio'])) {
    $cond = $_POST['condominio'];
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../views/condominio/form_1.php?cond=<?= $cond ?>');
    </script>
    <?php
}
if (isset($_GET['cond'])) {
    $cond = $_GET['cond'];
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../views/condominio/form_1.php?cond=<?= $cond ?>');
    </script>
    <?php
}

if (isset($_POST['nome'])) {
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../views/usuario/views.php?nome=<?= $_POST['nome'] ?>');
    </script>
    <?php
}
if (isset($_POST['tipo'])) {
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../views/usuario/views.php?tipo=<?= $_POST['tipo'] ?>');
    </script>
    <?php
}
if (isset($_POST['doc'])) {
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../views/usuario/views.php?doc=<?= $_POST['doc'] ?>');
    </script>
    <?php
}
?>