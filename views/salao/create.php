<?php

include '../../controllers/salaocontroller.php';
include_once '../../config/conexao.php';
$salao = new salaocontroller();
$db = new Conexao();
$nome = $_POST['cnpj'];
$query = "Select cpf_cnpj FROM CadastrCpf_Cnpj WHERE nome = '$nome'";
$result = mysqli_query($db->con, $query);
$nome_salao = '';
$cnpj = '';
$valor = '';
while ($row = mysqli_fetch_row($result)) {
    $cadastro = $salao->CadastraSalao($row[0], $_POST['nome'], $_POST['valor']);
    $nome_salao = $cadastro->getSalao();
    $cnpj = $cadastro->getCpf_cnpj();
    $valor = $cadastro->getValor();
}
$insere = "INSERT INTO `Salao` (`condominio`, `Salao`, `valor`) VALUES ('$cnpj','$nome_salao', '$valor')";
$execute = mysqli_query($db->con, $insere);

echo '<script>
        alert("Salão Cadastrado com sucesso.");
		window.location.href = "../../web/index.php?condominio='.$cnpj.'&Salao='.$nome_salao.'&regras=true";
        </script>';

?>
