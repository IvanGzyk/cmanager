<html lang="pt-BR">
    <?php
    //Carrega os menus seguindo o tipo de usuario...
    $menu = "<ul class='navbar-nav mr-auto'>
            <li class='nav-item active'>
                <a class='nav-link' href='../../cmanager/Web/index.php'>Inicial</a>
            </li>";
    session_start();
    $Usuario = unserialize($_SESSION['usuario']); //Recebe o Array com os dados do usuario que logou...
    include_once '../Config/Conexao.php';
    $db = new Conexao();
    $con = $db->con;
    $tipo = $Usuario['tipo']; //Pega o id do Tipo...
    //Seleciona o Tipo pelo id...
    $query = "SELECT tipo FROM Tipo WHERE id = $tipo;";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_row($result)) {
        $tipo = $row[0];
    }
    //Seleciona todos os menus que são liberados para o Tipo de Usuario...
    $query = "SELECT * FROM Menu WHERE acesso = '$tipo';";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_row($result)) {//Monata o menu...
        if($row[5] == 'nav-link dropdown-toggle'){
            $query_pai = "SELECT * FROM Menu
            WHERE pai = $row[0] AND acesso = '$tipo';";
            
            $result_pai = mysqli_query($con, $query_pai);
            
            $menu .= "<li class='nav-item dropdown'>
                        <a class='$row[5]' href='#' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>"
                        . "$row[1]
                        </a>
                    <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>";
            while ($row_pai = mysqli_fetch_row($result_pai)){
                $menu .= "<a class='$row_pai[5]' href='#' onclick=" . "Conteudo($row_pai[4])" . ">$row_pai[1]</a>";
            }
            $menu .= "</div></li>";
        }else if ($row[2] == null){
        $menu .= "<li class='nav-item'>
                        <a class='$row[5]' href='#' onclick=" . "Conteudo($row[4])" . ">$row[1]</a>
                    </li>";
        }
    }
    $menu .= "</ul>";
    ?>
    <!-- Inicializa a parte de visão do Index...(html) -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="format-detection" content="telephone=no">
        <meta name="robots" content="noindex">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/funcoes.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
        <title>CMANAGER</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <?= $menu ?><!-- Mostra o menu... -->
            </div>
        </nav>
        <div id="principal" class="container-fluid">
        </div>
    </body>
</html>
<?php
if (isset($_POST['condominio'])) {
    $cond = $_POST['condominio'];
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../Views/Condominio/Form_1.php?cond=<?= $cond ?>');
    </script>
    <?php
}
if (isset($_GET['cond'])) {
    $cond = $_GET['cond'];
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../Views/Condominio/Form_1.php?cond=<?= $cond ?>');
    </script>
    <?php
}

if (isset($_POST['nome'])) {
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../Views/Usuario/views.php?nome=<?=$_POST['nome']?>');
    </script>
    <?php
}
if (isset($_POST['tipo'])) {
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../Views/Usuario/views.php?tipo=<?=$_POST['tipo']?>');
    </script>
    <?php
}
if (isset($_POST['doc'])) {
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../Views/Usuario/views.php?doc=<?=$_POST['doc']?>');
    </script>
    <?php
}

