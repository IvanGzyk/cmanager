<?php
    include_once '../../config/conexao.php';

    $db = new Conexao();
	
	date_default_timezone_set('America/Sao_Paulo');
	$referencia = date('m-Y');
  
    $consumo = "SELECT * FROM ConsumoDeAgua ORDER BY id DESC";
    $resultado = mysqli_query($db->con, $consumo);
	$row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
	
	$cubico = $row['valorMedido'] / 1000;
	$cubico_int = number_format($cubico,0,",",".");
	$valor = 0;
	$multiplicacao = 0;
	
	if($cubico_int >= '0' && $cubico_int <= '5'){
		$valor += '38.77';
	}else if($cubico_int == '6'){
		$valor += '38.77';
		$valor += '1.20';
	}else if($cubico_int ==	'7'){
		$valor += '38.77';
		$valor += '1.20' * 2;
	}else if($cubico_int == '8'){
		$valor += '38.77';
		$valor += '1.20' * 3;
	}else if($cubico_int == '9'){
		$valor += '38.77';
		$valor += '1.20' * 4;
	}else if($cubico_int == '10'){
		$valor += '38.77';
		$valor += '1.20' * 5;
	}else if($cubico_int == '11'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 1;
	}else if($cubico_int == '12'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 2;
	}else if($cubico_int == '13'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 3;
	}else if($cubico_int == '14'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 4;
	}else if($cubico_int == '15'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
	}else if($cubico_int == '16'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 1;
	}else if($cubico_int == '17'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 2;
	}else if($cubico_int == '18'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 3;
	}else if($cubico_int == '19'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 4;
	}else if($cubico_int == '20'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 5;
	}else if($cubico_int == '21'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 5;
		$valor += '6.77' * 1;
	}else if($cubico_int == '22'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 5;
		$valor += '6.77' * 2;
	}else if($cubico_int == '23'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 5;
		$valor += '6.77' * 3;
	}else if($cubico_int == '24'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 5;
		$valor += '6.77' * 4;
	}else if($cubico_int == '25'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 5;
		$valor += '6.77' * 5;
	}else if($cubico_int == '26'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 5;
		$valor += '6.77' * 6;
	}else if($cubico_int == '27'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 5;
		$valor += '6.77' * 7;
	}else if($cubico_int == '28'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 5;
		$valor += '6.77' * 8;
	}else if($cubico_int == '29'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 5;
		$valor += '6.77' * 9;
	}else if($cubico_int == '30'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 5;
		$valor += '6.77' * 10;
	}else if($cubico_int > '30'){
		$valor += '38.77';
		$valor += '1.20' * 5;
		$valor += '6.68' * 5;
		$valor += '6.72' * 5;
		$valor += '6.77' * 10;
			for($i=31; $i <= $cubico_int; $i++){
				$valor = $valor + '11.46';
			}
		}
	
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
        <link href="../../web/css/styles.css" rel="stylesheet" />
        <script src="../../web/js/all.min.js"></script>
    </head>
    <body>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-3">Consumo de Água</h1>
                        <div class="card mb-2">
                            <div class="card-body">Acompanhe o consumo total de água do condomínio.<br />Caso encontre irregularidades, acione o botão <font color="#FF0000"><b>REPORTAR VAZAMENTO</b></font> para que um aviso rápido seja enviado ao seu síndico.</div>
                        </div>
                        <div class="w-100 p-2"><button type="button" class="btn btn-danger btn-sm float-right">REPORTAR VAZAMENTO</button><br /></div>
                        <div class="row p-3">
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header align-items-center">Consumo de água <small>(referencia: <?php echo date('m/Y'); ?>)</small></div>
                                    <div class="card-body">
									<h1 class="text-center"><?php echo $cubico_int; ?> m³ <small>(<?php echo $row['valorMedido']; ?> L)</small></h1>
									</div>
                                    <div class="card-footer small text-muted text-right">Última atualização em: 
                                    <?php echo date("d/m/Y H:i", strtotime($row['atualizacao'])); ?>
                                    </div>
                                </div>
                             
                             <div class="col-lg-14">
                                <div class="card mb-4">
                                    <div class="card-header">Valor aproximado da água (R$)</div>
                                    <div class="card-body">
									<h1 class="text-center">R$ <?php echo number_format($valor,2,",","."); ?></h1>
									</div>
                                    <div class="card-footer small text-muted text-right">Baseado nos dados da SANEPAR - Resolução Nº 006 de 16/04/2019</div>
                                </div>
                            </div>
                           </div>
                            
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i> Dashboard de consumo mensal</div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="54"></canvas></div>
                                    
                                </div>
                            </div>
                           
                        </div>
                    </div>             
                </main>
            </div>
        <script src="../../web/js/jquery-3.4.1.min.js"></script>
        <script src="../../web/js/bootstrap.bundle.min.js"></script>
        <script src="../../web/js/scripts.js"></script>
        <script src="../../web/js/Chart.min.js"></script>
         <script>
        $(document).ready(function(){
  	$.ajax({
    url: "../views/consumo/dashboard.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var data = [];
      var valor = [];

      for(var i in data) {
        data.push(data[i].referencia);
        valor.push(data[i].valorMedido);
      }
	  
	  	var ctx = document.getElementById("myBarChart");
	  	var myLineChart = new Chart(ctx, {
  		type: 'bar',
  		data: {
    	labels: [data],
    	datasets: [{
      		label: data,
      		backgroundColor: "rgba(2,117,216,1)",
      		borderColor: "rgba(2,117,216,1)",
      		data: valor
    	}],
 		},
  		options: {
    	scales: {
      	xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 15000,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
	}
  });
});
        </script>
    </body>
</html>