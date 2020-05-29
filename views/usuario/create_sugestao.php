<?php
include_once '../../config/conexao.php';
$db = new Conexao();
session_start();
$usuario = unserialize($_SESSION['usuario']);
if (isset($_FILES['pic']))
    $img = ""; {
    $ext = strtolower(substr($_FILES['pic']['name'], -4)); //Pegando extensão do arquivo
    $new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
    $dir = '../../web/img/sugestao/'; //Diretório para uploads
    $img = $dir.$new_name;
    move_uploaded_file($_FILES['pic']['tmp_name'], $dir . $new_name); //Fazer upload do arquivo
}

$data = $_POST['data'] . " " . $_POST['hora'];
$descricao = $_POST['descricao'];
$condominio = $usuario['cond'];

$insert = "INSERT INTO sugestao(data, img, descricao, condominio) VALUES ('$data', '$img', '$descricao', '$condominio');";
$execut = mysqli_query($db->con, $insert);
echo '<script>
        alert("O cadastro realizado com sucesso.");
		window.location.href = "../../web/index.php";
        </script>';
 