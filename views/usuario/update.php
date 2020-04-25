
<?php

include_once '../../config/conexao.php';
include '../../controllers/usuariocontroller.php';
$usuario = new UsuarioController();
$user = $usuario->Atualiza($_POST['doc'], $_POST['nome'], $_POST['tipo'], $_POST['senha'], $_POST['tipoCond']);
$id = $_GET['id'];
$ativo = $_POST['ativo'];
$doc = $user->getCpf_cnpj();
$nome = $user->getNome();
$tipo = $user->getTipo();
$senha = $user->getSenha();
$condominio = $user->getCondominio();

$db = new Conexao();
$user = "SELECT * FROM Usuario WHERE id = $id";
$result = mysqli_query($db->con, $user);
$docu = "";
while ($row = mysqli_fetch_row($result)) {
    $docu = $row[1];
    if ($senha != $row[3]) {
        $senha = md5($senha);
    }
}
$atualizaCpfCnpj = "update CadastrCpf_Cnpj set cpf_cnpj= '$doc' , nome= '$nome' where cpf_cnpj = '$docu'";
$atualizaUsuario = "update Usuario set cpfCnpj = '$doc', tipoUser = '$tipo', senha = '$senha', ativo = '$ativo', condominio = '$condominio' where id = '$id';";

$execute_doc = mysqli_query($db->con, $atualizaCpfCnpj);
$execute_user = mysqli_query($db->con, $atualizaUsuario);

header('Location:../../web/');

?>
