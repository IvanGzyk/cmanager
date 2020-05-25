<script src="../../web/js/funcoes.js" type="text/javascript"></script>
<script src="../../web/js/jquery.min.js" type="text/javascript"></script>

<?php
include '../../config/conexao.php';
$db = new Conexao();
$con = $db->con;

$tipo = $_POST['tipo'];
$titulo = $_POST['titulo'];
$mensagem = $_POST['mensagem'];

date_default_timezone_set('America/Sao_Paulo');
$data_atual = date('d/m/Y H:i:s');

if(isset($_FILES['imagem'])){
    $extensao = strtolower(substr($_FILES['imagem']['name'], -4));
    $novo_nome = md5(time()).".".$extensao;
    $diretorio = "../../web/img/upload/";
    
	if(move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novo_nome)){
	$query_noticia = "INSERT INTO Noticias (tipo, titulo, texto, anexo, data_postagem) VALUES ('$tipo', '$titulo', '$mensagem', '$novo_nome', '$data_atual');";
	$execute = mysqli_query($db->con, $query_noticia);
	
    echo '<script>
        alert("Notícia postada com sucesso.");
		window.location.href = "../../web/index.php";
        </script>';
}else{
	$query_noticia = "INSERT INTO Noticias (tipo, titulo, texto, anexo, data_postagem) VALUES ('$tipo', '$titulo', '$mensagem', '', '$data_atual');";
	$execute = mysqli_query($db->con, $query_noticia);
	
    echo '<script>
        alert("Notícia postada com sucesso.");
		window.location.href = "../../web/index.php";
        </script>';
	}
}
?>