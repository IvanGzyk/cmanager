<?php

class qr_code {

    function gera_qr_code() {
		
	$codigo = base64_encode(sha1(md5('13.457.853/0001-07')));
    $cnpj = '13.457.853/0001-07';
        //echo "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.google.com%2F&choe=UTF-8";
    header('Location:https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http://cmanager.com.br/web/login/cadastrar.php?codigo=' . $codigo . '&cnpj=' . $cnpj . '');
    }

}

?>
