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
if (!isset($_SESSION['usuario'])) {
    header('location: ../web/script/naologado.php');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <title>CManager - Gestão de Condomínios</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/funcoes.js" type="text/javascript"></script>
        <link href="vendor/benhall14/php-calendar/html/css/calendar.css" rel="stylesheet" type="text/css"/>
        <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <script src="js/all.min.js"></script>
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
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
                            <div class="text-muted">Copyright &copy; 2020 Condominium Manager. Todos os direitos reservados.</div>
                        </div>
                    </div>
                </footer>

            </div>
        </div>
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
include_once 'script/funcoes.php';
?>

<?php
//inicia verificaçãode notificações de correio.
include_once '../config/conexao.php';

$db = new Conexao();
$con = $db->con;

$notifica_correio = "SELECT * FROM Correio WHERE cpfCnpj = '$doc' and status = '0'";
$notifica_result = mysqli_query($con, $notifica_correio);
$row_msg = mysqli_fetch_array($notifica_result, MYSQLI_ASSOC);

$puxa_nome = "SELECT nome FROM CadastrCpf_Cnpj WHERE cpf_cnpj = '$doc'";
$result = mysqli_query($con, $puxa_nome);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if ($row_msg['status'] == '0') {
?>

<div class="modal fade" id="notificacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h6 class="modal-title" id="myModalLabel">Notificação de Recebimento de Correspondência</h6>
						</div>
						<div class="modal-body">
<small><b>Olá, <?php echo $row['nome']; ?>!</b></small><br /><br />
<small>Consta(m) correspondência(s) dos correios na portaria do condomínio.<br />
Por favor, confira as informações abaixo:</small><br /><br />
<small><b>Data do recebimento: </b></small>
<small><?php echo $row_msg['data_registro']; ?></small><br />
<small><b>Mensagem: </b></small>
<small><?php echo $row_msg['mensagem']; ?></small><br /><br />
<small>Favor, retirar o quanto antes na portaria do condomínio.</small><br />
<small>Para confirmar o recebimento, clique em <font color="#FF0000"><b>"Confirmar Recebimento"</b></font>.</small>
						</div>
						<div class="modal-footer">
                        <?php
						echo "<a class='btn btn-success btn-sm' href='update-notificacao.php?id=" . $row_msg['id'] . "'>CONFIRMAR RECEBIMENTO</a><br>";
						?>
						</div>
					</div>
				</div>
			</div>
             <script>
				$(document).ready(function () {
					$('#notificacao').modal('show');
				});
			</script>

<?php
}
?>