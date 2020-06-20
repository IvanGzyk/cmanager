<?php

if($_POST) {
    include_once 'config/class.phpmailer.php';
	include_once 'config/class.smtp.php';
	
	$representante = $_POST['repres']; 
	$condominio = $_POST['cond']; 
	$telefone = $_POST['tel'];
	$unidade = $_POST['unid'];
	$bloco = $_POST['blc'];
	$email = $_POST['email'];
	$endereco = $_POST['endereco'];
	$cidade = $_POST['cidade'];
	$estado = $_POST['estado'];
	$cep = $_POST['cep'];
	$mensagem = $_POST['mensagem'];
	
			$mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = "mail.cmanager.com.br";
            $mail->Port = 465;
            $mail->Username = 'no-reply@cmanager.com.br';
            $mail->Password = '8JHK&3mu';
            $mail->CharSet = "UTF-8";

            // Remetente
            $mail->From = "no-reply@cmanager.com.br";
            $mail->FromName = "CManager";

            // Destinatário
            $mail->AddAddress('' . $email . '');
            $mail->IsHTML(true);
            $mail->Subject = "Solicitação de Cotação";
            $mail->Body = '
                    <link href="http://cmanager.com.br/web/css/bootstrap.css" rel="stylesheet" type="text/css"/>
                    <body><img src="http://cmanager.com.br/web/img/email/cabecalho.jpg"  />
                    <p class="small">Olá, ' . $representante . '.</p>
                    <p class="small">Você solicitou uma cotação em nosso site! Ficamos felizes com o seu interesse.</p>
                    <p  class="small">Pedimos encarecidamente que aguarde a resposta da nossa equipe técnica, que entrará em contato via e-mail e telefone. Esperamos que em breve, você possa desfrutar de todas as vantagens que o CManager pode oferecer para o seu condomínio.</p>
                    <p class="small">Abraços da equipe CManager!</p>
                    <img src="http://cmanager.com.br/web/img/email/rodape.jpg"/>';
					
                $mail->Send();
				
				echo '<script>
        alert("Solicitação de cotação enviada com sucesso. Por favor, aguarde a resposta da nossa equipe.");
		window.location.href = "index.php";
        </script>';
}
?>
<!doctype html>
<html lang="pt-BR">

    <head>

		<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
<title>CManager - Gestão de Condomínios</title>

<!-- CSS -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/media-queries.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/condo.png">
    </head>

    <body>

		<!-- Top menu -->
		<nav class="navbar navbar-dark fixed-top navbar-expand-md navbar-no-bg">
			<div class="container">
				<a class="navbar-brand" href="index.php">CManager - Gestão de Condomínios</a>
			    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			        <span class="navbar-toggler-icon"></span>
			    </button>
			    <div class="collapse navbar-collapse" id="navbarNav">
			        <ul class="navbar-nav ml-auto">
			            <li class="nav-item">
			                <a class="nav-link scroll-link" href="#top-content">Início</a>
			            </li>
			            <li class="nav-item">
			                <a class="nav-link scroll-link" href="#section-1">Vantagens e Benefícios</a>
			            </li>
			            <li class="nav-item">
			                <a class="nav-link scroll-link" href="#section-2">Contato</a>
			            </li>
			            <li class="nav-item">
			                <a class="nav-link" href="web/login/">Entrar no sistema</a>
			            </li>
			        </ul>
			    </div>
		    </div>
		</nav>

        <!-- Top content -->
        <div class="top-content">
       		<div class="row no-gutters">
       			<div class="col">
       				<div id="carousel-example" class="carousel slide" data-ride="carousel">
       					<ol class="carousel-indicators">
       						<li data-target="#carousel-example" data-slide-to="0" class="active"></li>
       						<li data-target="#carousel-example" data-slide-to="1"></li>
       					</ol>
       					<div class="carousel-inner">
       						<div class="carousel-item active">
       							<img src="assets/img/backgrounds/slide_1.jpg" class="d-block w-100" alt="img1">
								<div class="carousel-caption">
									<h1 class="wow fadeInLeftBig">Transparência, confiabilidade e segurança</h1>
									<div class="description wow fadeInUp">
										<p>
											Com o CManager - Gestão de Condomínios, você desfruta do melhor da administração de condomínios, sem stress, de maneira simples e sem burocracia, e mais, tudo em um único sistema!
										</p>
									</div>
								</div>
       						</div>
       						<div class="carousel-item">
       							<img src="assets/img/backgrounds/slide_2.jpg" class="d-block w-100" alt="img2">
       							<div class="carousel-caption">
									<h1 class="wow fadeInLeftBig">Agilize o trabalho manual do síndico</h1>
									<div class="description wow fadeInUp">
										<p>
											Grande parte do trabalho manual realizado pelo síndico pode ser feita no CManager - Gestão de Condomínios. Desde o controle do consumo de água, até o acompanhamento e lançamento do financeiro. Tudo disponibilizado facilmente!
										</p>
									</div>
								</div>
       						</div>
       						
       							
       							<div class="carousel-caption">
								
									</div>
       						</div>
       					</div>
						<a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Anterior</span>
						</a>
						<a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Próximo</span>
						</a>
       				</div>
       			</div>
       		</div>
        </div>

        <!-- Section 1 -->
        <div class="section-1-container section-container">
	        <div class="container">
	            <div class="row">
	                <div class="col section-1 section-description wow fadeIn">
	                    <h2>VANTAGENS E BENEFÍCIOS</h2>
	                    <div class="divider-1 wow fadeInUp"><span></span></div>
	                </div>
	            </div>
	            <div class="row">
                	<div class="col-md-4 section-1-box wow fadeInUp">
                		<div class="row">
                			<div class="col-md-4">
			                	<div class="section-1-box-icon">
			                		<i class="fas fa-building"></i>
			                	</div>
		                	</div>
	                		<div class="col-md-8">
	                    		<h3>FINANCEIRO</h3>
	                    		<p>O controle do financeiro em ordem e de fácil acesso para o síndico e condômino, fortalecendo a relação de transparência de contas.</p>
	                    	</div>
	                    </div>
                    </div>
                    <div class="col-md-4 section-1-box wow fadeInDown">
	                	<div class="row">
                			<div class="col-md-4">
			                	<div class="section-1-box-icon">
			                		<i class="fas fa-calendar-minus"></i>
			                	</div>
		                	</div>
	                		<div class="col-md-8">
	                    		<h3>SALÃO DE FESTA</h3>
	                    		<p>Faça reservas no salão de festas de forma simples e rápida através do CManager, e aproveite aquele churrascão com família e amigos.</p>
	                    	</div>
	                    </div>
                    </div>
                    <div class="col-md-4 section-1-box wow fadeInUp">
	                	<div class="row">
                			<div class="col-md-4">
			                	<div class="section-1-box-icon">
			                		<i class="fas fa-bath"></i>
			                	</div>
		                	</div>
	                		<div class="col-md-8">
	                    		<h3>CONSUMO DE ÁGUA</h3>
	                    		<p>Acompanhar o consumo de água do condomínio agora é realidade! Manipule as informações do consumo em litros, valores a serem pagos, rateio e acompanhamento dos meses anteriores.</p>
	                    	</div>
	                    </div>
                    </div>
	            </div>
	        </div>
        </div>

        <!-- Section 2 -->
        <div class="section-2-container section-container section-container-gray-bg">
	        <div class="container">
	            <div class="row">
	                <div class="col section-2 section-description wow fadeIn">
                    <h2>PEÇA JÁ A SUA COTAÇÃO</h2>
	                </div>
	            </div>
	            <div class="row">
	            	<div class="col section-2-box wow fadeInLeft">
                    	<p class="medium-paragraph">
                    Preencha todos os itens do formulário e aguarde o nosso contato<br>Será um prazer tê-lo como nosso cliente.
                    	</p><br />
                        <span id="alerta"></span>
                        <br/>
<form id="interesse" action="#" method="POST" onsubmit="return validarInteresse()">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Nome do Representante</label>
      <input type="text" class="form-control" id="repres" name="repres">
    </div>
    <div class="form-group col-md-6">
      <label>Nome do Condomínio</label>
      <input type="text" class="form-control" id="cond" name="cond">
    </div>
  </div>
   <div class="form-row">
    <div class="form-group col-md-6">
      <label>Telefone para contato</label>
      <input type="text" class="form-control" id="tel" name="tel">
    </div>
    <div class="form-group col-md-4">
      <label>Qtde. de unidades</label>
      <input type="text" class="form-control" id="unid" name="unid">
      </select>
    </div>
    <div class="form-group col-md-2">
      <label>Qtde. de Blocos</label>
      <input type="text" class="form-control" id="blc" name="blc">
    </div>
  </div>
  <div class="form-group">
    <label>Endereço de e-mail</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label>Logradouro completo</label>
    <input type="text" class="form-control" id="endereco" name="endereco">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Cidade</label>
      <input type="text" class="form-control" id="cidade" name="cidade">
    </div>
    <div class="form-group col-md-4">
      <label>Estado</label>
      <input type="text" class="form-control" id="estado" name="estado">
      </select>
    </div>
    <div class="form-group col-md-2">
      <label>CEP</label>
      <input type="text" class="form-control" id="cep" name="cep">
    </div>
  </div>
  <div class="form-group">
    <label>Mensagem</label>
    <textarea class="form-control" id="mensagem" name="mensagem" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary float-right">SOLICITAR COTAÇÃO</button>
</form>
	                </div>
	            </div>
	        </div>
        </div>  

        <!-- Footer -->
        <footer class="footer-container">
        
	        <div class="container">
	        	<div class="row">
	        		
                    <div class="col small align-content-end">
                    	&copy;2020 CManager - Gestão de Condomínios. Todos os direitos reservados.
                    </div>
                    
                </div>
	        </div>
                	
        </footer>

        <!-- Javascript -->
		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/jquery-migrate-3.0.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/waypoints.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="assets/js/mascara.js"></script>
        <script src="assets/js/bootstrap-validate.js"></script>
        <script src="assets/js/validacao.js"></script>
        <script>
    // Validação de campos do cadastro com bootstrap.
    bootstrapValidate('#repres', 'min:1:O campo não pode ficar vazio.');
    bootstrapValidate('#cond', 'min:1:O campo não pode ficar vazio.');
    bootstrapValidate('#tel', 'min:1:O campo não pode ficar vazio.');
    bootstrapValidate('#unid', 'min:1:O campo não pode ficar vazio.');
    bootstrapValidate('#blc', 'min:1:O campo não pode ficar vazio.');
	bootstrapValidate('#email', 'required:Ocampo não pode ficar vazio.');
    bootstrapValidate('#email', 'email:Insira um e-mail válido.');
    bootstrapValidate('#endereco', 'min:1:O campo não pode ficar vazio.');
    bootstrapValidate('#cidade', 'min:1:O campo não pode ficar vazio.');
	bootstrapValidate('#estado', 'min:1:O campo não pode ficar vazio.');
	bootstrapValidate('#cep', 'min:1:O campo não pode ficar vazio.');
	bootstrapValidate('#mensagem', 'min:1:O campo não pode ficar vazio.');
    </script>
        <script>
        var maskTel = IMask(document.getElementById('tel'), {
		mask:[{
			mask: '(00) 0000-0000',
			maxLength: 14},{
			mask: '(00) 00000-0000'
		}]});
	
		var maskCEP = IMask(document.getElementById('cep'), {
		mask:[{
			mask: '00000-000',
			maxLength: 9}]});
		</script>
    </body>

</html>