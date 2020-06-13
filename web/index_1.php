<?php
include_once '../controllers/menucontroller.php';
include_once '../config/conexao.php';

$db = new Conexao();
$con = $db->con;

session_start();
//Recebe o Array com os dados do usuario que logou...
$Usuario = unserialize($_SESSION['usuario']);
//Pega o id do Tipo...
$tipo = $Usuario['tipo'];
$doc = $Usuario['doc'];
$cnpj = $Usuario['cond'];
$menucontrole = new MenuController();
$menu = $menucontrole->Menu($tipo, $doc);
$sugestao = "";

//Verifica se a sessão do usuário foi iniciada. Caso contrário, informa que deve fazer login.
if (!isset($_SESSION['usuario'])) {
    header('location: ../web/script/naologado.php');
}
if ($tipo == 1) {
    $query = "SELECT DATA, id, img, descricao, condominio, CadastrCpf_Cnpj.nome FROM sugestao
            INNER JOIN CadastrCpf_Cnpj ON CadastrCpf_Cnpj.cpf_cnpj = sugestao.morador
            WHERE visualizada = 'não'
            AND 
            condominio = '$cnpj';";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    @$id = $row['id'];
    @$img = $row['img'];
    @$descricao = $row['descricao'];
    @$data = $row['DATA'];
    @$nome = $row['nome'];
    @$ver = "'../views/noticias/noticias.php?sugestao=" . $id . "'";
    if (mysqli_num_rows($result) > 0) {
        $sugestao = '<center>'
                . '<div class="alert alert-warning" style="width: 94%;" role="alert">'
                . '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar">'
                . '<span aria-hidden="true">&times;</span>'
                . '</button>'
                . '<h5 class="alert-heading text-left">Uma nova sugestão está disponível!</h5>'
                . '<hr><p class="mb-0 text-left">'
                . 'Data postagem: ' . $data . '<br>Autor: ' . $nome . ' '
                . '<a class="btn btn-info btn-sm float-right" href="#" onclick="Conteudo(' . $ver . ')">Visualizar sugestão</a></p>'
                . '</div>'
                . '</center>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <title>CManager - Gestão de Condomínios</title>
<link href="vendor/benhall14/php-calendar/html/css/calendar.css" rel="stylesheet" type="text/css"/>
<link href="css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="css/styles.css" rel="stylesheet" />
<script src="js/jquery-2.2.4.js"></script>
<script src="js/funcoes.js"></script>
		<script src="js/all.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.js"></script>
    <body style="overflow-x:hidden;">
        <!-- Carregar menu aqui-->
        <?= $menu ?>

        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <div id="principal">
                        <br>
                      
                    </div>
                </main>
            </div>
        </div>
        <footer class="py-3 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-end justify-content-end small">
                    <div class="text-muted">Copyright &copy; 2020 Condominium Manager - CManager. Todos os direitos reservados.</div>
                </div>
            </div>
        </footer>
</head>
</html>