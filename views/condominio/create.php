<script src="../../web/js/funcoes.js" type="text/javascript"></script>
<script src="../../web/js/jquery.min.js" type="text/javascript"></script>

<?php
include_once '../../config/conexao.php';
include '../../controllers/condominiocontroller.php';

$db = new Conexao();
$cond = new CondominioController();
if (isset($_GET['cond'])) {
    $condominio = $cond->CreateCondominio($_POST['nome_cond'], $_POST['cnpj']);
    $endereço = $condominio->setEnderesso($_POST['rua'], $_POST['num'], $_POST['bairro'], $_POST['cidade'], $_POST['estado'], $_POST['cep']);
    $nome = $condominio->getCondo();
    $cnpj = $condominio->getCpfCnpj();
    $rua = $endereço->getRua();
    $numero = $endereço->getNumero();
    $bairro = $endereço->getBairro();
    $cidade = $endereço->getCidade();
    $estado = $endereço->getEstado();
    $cep = $endereço->getCep();
    $query_condominio = "INSERT INTO CadastrCpf_Cnpj (cpf_cnpj, nome) VALUES ('$cnpj', '$nome');";
    $query_endereco = "INSERT INTO Endereco (cpf_cnpj, Rua, numero, bairro, cidade, estado, cep) VALUES ('$cnpj', '$rua', '$numero', '$bairro', '$cidade', '$estado', '$cep');";

    $execute_1 = mysqli_query($db->con, $query_condominio);
    $execute_2 = mysqli_query($db->con, $query_endereco);
    echo '<script>
        alert("Condomínio cadastrado com sucesso.");
		window.location.href = "../../web/index.php";
        </script>';
}
$condominio = $cond->Create($_POST['nome'], $_POST['salva'], $_POST['apt'], $_POST['blc']);
    $nome = $condominio->getCondo();
    $doc = $condominio->getCpfCnpj();
    $apt = $condominio->getApartamento();
    $blc = $condominio->getBloco();

    $query = "INSERT INTO Predio (condominio, blc,ap) VALUES ('$doc', '$blc', '$apt');";

    $execute = mysqli_query($db->con, $query);

echo '<script>
        alert("Apartamento cadastrado com sucesso.");
		window.location.href = "../../web/index.php";
        </script>';
?>

