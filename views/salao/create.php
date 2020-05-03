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
while ($row = mysqli_fetch_row($result)) {
    $cadastro = $salao->CadastraSalao($row[0], $_POST['nome']);
    $nome_salao = $cadastro->getSalao();
    $cnpj = $cadastro->getCpf_cnpj();
}
$insere = "INSERT INTO Salao (condominio, Salao) VALUES ('$cnpj','$nome_salao')";
$execute = mysqli_query($db->con, $insere);

echo '<script>
        alert("Salão reservado com sucesso.");
		window.location.href = "../../web/index.php";
        </script>';

?>
