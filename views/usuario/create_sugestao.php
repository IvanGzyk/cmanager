<?php
include_once '../../config/conexao.php';
$db = new Conexao();
session_start();
$usuario = unserialize($_SESSION['usuario']);

date_default_timezone_set('America/Sao_Paulo');
$data_atual = date('d/m/Y H:i:s');

$descricao = $_POST['descricao'];
$condominio = $usuario['cond'];
$doc = $usuario['doc'];

if(isset($_FILES['pic'])){
    $extensao = strtolower(substr($_FILES['pic']['name'], -4));
    $novo_nome = md5(time())."".$extensao;
    $diretorio = "../../web/img/sugestao/";
    
	if(move_uploaded_file($_FILES['pic']['tmp_name'], $diretorio.$novo_nome)){
	$insert = "INSERT INTO sugestao(data, img, descricao, condominio, morador) VALUES ('$data_atual', '$novo_nome', '$descricao', '$condominio', '$doc');";
	$execut = mysqli_query($db->con, $insert);
	
    echo '<script>
        alert("Sugestão postada com sucesso.");
		window.location.href = "../../web/index.php";
        </script>';
}else{
	$insert = "INSERT INTO sugestao(data, img, descricao, condominio, morador) VALUES ('$data_atual', '', '$descricao', '$condominio', '$doc');";
	$execut = mysqli_query($db->con, $insert);
	
    echo '<script>
        alert("Sugestão postada com sucesso.");
		window.location.href = "../../web/index.php";
        </script>';
	}
}