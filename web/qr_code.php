<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
include_once '../config/conexao.php';

use chillerlan\QRCode\QRCode;

class qr_code {

    function gera_qr_code() {
        $db = new Conexao();
        $usuario = unserialize($_SESSION['usuario']);
        $cpf = $usuario['doc'];
        $doc = "";
        
        $query = "SELECT condominio FROM Usuario WHERE cpfCnpj = '$cpf';";
        $execute = mysqli_query($db->con, $query);
        while ($row = mysqli_fetch_row($execute)){
            $doc = $row[0];
        }
        
        $codigo = base64_encode(sha1(md5('$doc')));
        $cnpj = $doc;
        $data = "http://cmanager.com.br/web/login/cadastrar.php?codigo=$codigo&cnpj=$cnpj"; //inserindo a URL

        $url = '<img src="' . (new QRCode)->render($data) . '" />';
        echo $url;
    }

    function geraPdf() {
        $codigo = base64_encode(sha1(md5('13.457.853/0001-07')));
        $cnpj = '13.457.853/0001-07';
        $data = "http://cmanager.com.br/web/login/cadastrar.php?codigo=$codigo&cnpj=$cnpj"; //inserindo a URL        
        $url = '<div  align="center"><img src="' . (new QRCode)->render($data) . '" /></div>';
        $stylesheet = file_get_contents('css/dataTables.bootstrap4.min.css');
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetHeader('<div style="text-align: center; font-weight: bold; font-size: 2em;">
    QrCode para cadastro de Condomino.
</div>','O');
        $mpdf->SetFooter('<footer class="py-3 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-end justify-content-end small">
                            <div class="text-muted">Copyright &copy; 2020 Condominium Manager. Todos os direitos reservados.</div>
                        </div>
                    </div>
                </footer>');
        $mpdf->SetTitle("CMANAGER");
        //$mpdf->SetDirectionality('rtl');
        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($url);
        $mpdf->Output();
    }

}
?>