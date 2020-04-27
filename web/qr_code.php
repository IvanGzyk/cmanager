<?php

require_once __DIR__ . '/vendor/autoload.php';

use chillerlan\QRCode\QRCode;

class qr_code {

    function gera_qr_code() {
        $codigo = base64_encode(sha1(md5('13.457.853/0001-07')));
        $cnpj = '13.457.853/0001-07';
        $data = "http://cmanager.com.br/web/login/cadastrar.php?codigo=$codigo&cnpj=$cnpj"; //inserindo a URL

        $url = '<img src="' . (new QRCode)->render($data) . '" />';
        echo $url;
    }
    
    function geraPdf(){
        $codigo = base64_encode(sha1(md5('13.457.853/0001-07')));
        $cnpj = '13.457.853/0001-07';
        $data = "http://cmanager.com.br/web/login/cadastrar.php?codigo=$codigo&cnpj=$cnpj"; //inserindo a URL

        $url = '<img src="' . (new QRCode)->render($data) . '" />';
        
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($url);
        $mpdf->Output();
    }

}
?>
