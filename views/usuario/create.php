<?php
include_once '../../config/conexao.php';
include '../../controllers/usuariocontroller.php';
include '../../models/contato.php';
$usuario = new UsuarioController();
$contato = new Contato($telefone, $celular, $email, $email_altenativo, $cpf_cnpj)
$db = new Conexao();
$user = $usuario->Create($_POST['doc'], $_POST['nome'], $_POST['tipo'], md5($_POST['senha']), $_POST['tipoCond'], $_POST['ap'], $_POST['blc']);
?><pre><?php
//print_r($user);
    ?></pre><?php
//exit();

$contato = new Contato($_POST['telfixo'], $_POST['telcel'], $_POST['emailprinc'], $_POST['emailalter'], $cpf_cnpj);
$doc = $user->getCpf_cnpj();
$nome = $user->getNome();
$tipo = $user->getTipo();
$senha = $user->getSenha();
$condominio = $user->getCondominio();
$bloco = $user->getBloco();
$apartamento = $user->getApartamento();
$contato = new Contato($_POST['telfixo'], $_POST['telcel'], $_POST['emailprinc'], $_POST['emailalter'], $doc);
$telefoneFixo = $contato->getTelefone();
$telefoneCelular = $contato->getCelular();
$email = $contato->getEmail();
$emailAlternativo = $contato->getEmail_altenativo();

$query_cpfCpnpj = "INSERT INTO CadastrCpf_Cnpj(cpf_cnpj, nome) VALUES ('$doc', '$nome');";
$contato = "INSERT INTO Contato (cpf_cnpj, telefoneFixo, telefoneCelular, email, emailAlternativo) VALUES ('$doc', '$telefoneFixo', '$telefoneCelular', '$email', '$emailAlternativo');";
$query_Usuario = "INSERT INTO Usuario(cpfCnpj, tipoUser, senha, condominio) VALUES ('$doc', '$tipo', '$senha', '$condominio');";
$query_idAp = "SELECT id FROM Predio WHERE blc = '$bloco' AND ap = '$apartamento';";
$id = "";
$result = mysqli_query($db->con, $query_idAp);
while ($row = mysqli_fetch_row($result)) {
    $id = $row[0];
}
$query_ApBl = "INSERT INTO apUser(cpf_cnpj, ap) VALUES ('$doc', '$id');";

$execute_doc = mysqli_query($db->con, $query_cpfCpnpj);
$execute_user = mysqli_query($db->con, $query_Usuario);
$execute_BlAp = mysqli_query($db->con, $query_ApBl);



header('Location:../../web/');
?>
