<?php

include_once '../../config/conexao.php';
include_once '../../models/usuario.php';
include_once '../../models/condominio.php';
include_once '../../config/class.phpmailer.php';
include_once '../../config/class.smtp.php';

Class UsuarioController {

    function Logar($dados) {
        $db = new Conexao();
        $con = $db->con;

        $verificar = "SELECT * FROM Usuario WHERE cpfCnpj = '$dados[0]' AND senha = '$dados[1]' AND tipoUser = '$dados[2]' AND ativo='1'";
        $executar = mysqli_query($con, $verificar);

        $dado = "SELECT * FROM Usuario WHERE cpfCnpj = '$dados[0]'";
        $resultado = mysqli_query($con, $dado);
        $row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

        if (mysqli_num_rows($resultado) == 0) {
            $erro = '<div class="alert alert-danger alert-dismissible fade show" role="alert">#LOG001 - O CPF/CNPJ informado não existe. Faça um novo cadastro <a href="validar_condominio.php" class="alert-link">clicando aqui</a>.';
            return $erro;
        }
        if ($row['ativo'] == '0') {
            $erro = '<div class="alert alert-danger alert-dismissible fade show" role="alert">#LOG002 - O acesso está em processo de liberação. Em caso de dúvidas, contate o seu síndico.';
            return $erro;
        } else {

            if (mysqli_num_rows($executar) > 0) {
                session_start();
                $doc = $dados[0];
                $tipo = $dados[2];
                $Usuario = Array();
                $Usuario['doc'] = $doc;
                $Usuario['tipo'] = $tipo;
                $_SESSION['usuario'] = serialize($Usuario);
                header('location: ../../web/index.php');
            } else {
                $erro = '<div class="alert alert-danger alert-dismissible fade show" role="alert">#LOG003 - Os dados informados estão incorretos. Por favor, tente novamente. Caso necessite redefinir o acesso, <a href="recuperar.php" class="alert-link">clique aqui</a>.';
                return $erro;
            }
        }
    }

    function ValidarCondominio($dados) {

        $db = new Conexao();
        $con = $db->con;

        $verificar = "SELECT * FROM Usuario WHERE cpfCnpj = '$dados[0]' AND senha = '$dados[1]' AND tipoUser = '4' AND ativo='1'";
        $executar = mysqli_query($con, $verificar);

        if (mysqli_num_rows($executar) > 0) {
            $codigo = base64_encode(sha1(md5($dados[0])));
            $cnpj = $dados[0];
            header('location: ../../web/login/cadastrar.php?codigo=' . $codigo . '&cnpj=' . $cnpj . '');
        } else {
            $erro = '<div class="alert alert-danger alert-dismissible fade show" role="alert">#CAD004 - Os dados do condomínio estão incorretos. Por favor, tente novamente ou contate o seu síndico.';
            return $erro;
        }
    }

    function Cadastrar($dados) {

        $db = new Conexao();
        $con = $db->con;

        $existe_cpfCnpj = "SELECT * FROM Usuario WHERE cpfCnpj = '$dados[0]'";
        $resultado_cpfCnpj = mysqli_query($con, $existe_cpfCnpj);

        $existe_email = "SELECT email FROM Contato WHERE email = '$dados[4]'";
        $resultado_email = mysqli_query($con, $existe_email);

        $existe_emailAlternativo = "SELECT emailAlternativo FROM Contato WHERE email = '$dados[5]'";
        $resultado_emailAlternativo = mysqli_query($con, $existe_emailAlternativo);

        if (mysqli_num_rows($resultado_cpfCnpj) > 0) {
            $erro = '<div class="alert alert-danger alert-dismissible fade show" role="alert">#CAD006 - O CPF/CNPJ digitado já existe. Para acessar a sua conta, basta <a href="index.php" class="alert-link">clicar aqui</a>.';
            return $erro;
        }
        if (mysqli_num_rows($resultado_email) > 0) {
            $erro = '<div class="alert alert-danger alert-dismissible fade show" role="alert">#CAD007 - O E-MAIL PRINCIPAL já está atrelado em outra conta. Por favor, digite outro e-mail.';
            return $erro;
        }
        if (mysqli_num_rows($resultado_email) > 0) {
            $erro = '<div class="alert alert-danger alert-dismissible fade show" role="alert">#CAD008 - O E-MAIL ALTERNATIVO já está atrelado em outra conta. Por favor, digite outro e-mail.';
            return $erro;
        } else {

            $cpf_cnpj = "INSERT INTO CadastrCpf_Cnpj (cpf_cnpj, nome) VALUES ('$dados[0]', '$dados[1]');";
            $contato = "INSERT INTO Contato (cpf_cnpj, telefoneFixo, telefoneCelular, email, emailAlternativo) VALUES ('$dados[0]', '$dados[2]', '$dados[3]', '$dados[4]', '$dados[5]');";
            $usuario = "INSERT INTO Usuario (cpfCnpj, tipoUser, condominio, senha, ativo) VALUES ('$dados[0]', '0', '$dados[7]', '$dados[6]', '0');";

            $result1 = mysqli_query($con, $cpf_cnpj);
            $result2 = mysqli_query($con, $contato);
            $result3 = mysqli_query($con, $usuario);

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
            $mail->AddAddress('' . $dados[4] . '');
            $mail->IsHTML(true);
            $mail->Subject = "Cadastro Concluído";
            $mail->Body = '
<link href="http://cmanager.com.br/web/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<body><img src="http://cmanager.com.br/web/img/email/cabecalho.jpg"  />
<p class="small">Olá, ' . $dados[1] . '.</p>
<p class="small">O seu cadastro no <b>Portal CManager</b> foi concluído com sucesso.</p>
<p  class="small">Lembre-se, o seu acesso será feito mediante CPF e senha cadastrados.<br />Caso necessite de uma recuperação de acesso, basta <a href="http://cmanager.com.br/web/login/recuperar.php">clicar aqui</a>.</p>
<p class="small">Aproveite mais essa facilidade que só a CManager oferece para você!</p><br />
<p class="small"><font color="#333333"><b>Atenção: Esta é uma mensagem automática. Não é necessário respondê-la.</b></font></p>
<img src="http://cmanager.com.br/web/img/email/rodape.jpg"/>';

            if ($result1 && $result2 && $result3) {
                $mail->Send();
                $sucesso = '<div class="alert alert-success alert-dismissible fade show" role="alert">#CAD010 - Usuário cadastrado com sucesso. Para acessar a sua conta, basta <a href="index.php" class="alert-link">clicar aqui</a>.';
                return $sucesso;
            } else {
                $erro = '<div class="alert alert-danger alert-dismissible fade show" role="alert">#CAD009 - Não foi possível seguir com o processo de cadastro. Por favor, tente novamente mais tarde. Caso o erro persista, contate o seu síndico.';
                return $erro;
            }
        }
    }

    function RecuperarAcesso($dados) {

        $db = new Conexao();
        $con = $db->con;

        $verifica = "SELECT * FROM Contato WHERE email = '$dados[0]' OR emailAlternativo = '$dados[0]'";
        $resultado = mysqli_query($con, $verifica);

        if (mysqli_num_rows($resultado) == 0) {
            $erro = '<div class="alert alert-danger alert-dismissible fade show" role="alert">#REC011 - O E-MAIL digitado não foi encontrado.';
            return $erro;
        }

        $localiza = "SELECT cpf_cnpj FROM Contato WHERE email = '$dados[0]' OR emailAlternativo = '$dados[0]'";
        $resultado_localiza = mysqli_query($con, $localiza);
        $row = mysqli_fetch_array($resultado_localiza, MYSQLI_ASSOC);

        $cpfCnpj = $row['cpf_cnpj'];

        $localiza_nome = "SELECT nome FROM CadastrCpf_Cnpj WHERE cpf_cnpj = '$cpfCnpj'";
        $resultado_nome = mysqli_query($con, $localiza_nome);
        $row1 = mysqli_fetch_array($resultado_nome, MYSQLI_ASSOC);

        $nome = $row1['nome'];

        $token = sha1(uniqid(mt_rand(), true));
        $dado_cript = base64_encode($cpfCnpj);

        $update_token = "UPDATE Usuario SET token= '$token' WHERE cpfCnpj = '$cpfCnpj'";
        $update_resultado = mysqli_query($con, $update_token);

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
        $mail->AddAddress('' . $dados[0] . '');
        $mail->IsHTML(true);
        $mail->Subject = "Recuperação de Acesso";
        $mail->Body = '
<link href="http://cmanager.com.br/web/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<body><img src="http://cmanager.com.br/web/img/email/cabecalho.jpg"  />
<p class="small">Olá, ' . $nome . '.</p>
<p class="small">Você solicitou através do <b>Portal CManager</b> a recuperação de acesso à plataforma.<br />
Por favor, pedimos que siga os procedimentos abaixo para a recuperação da sua conta.</p>
<p  class="small">1 - <a href="http://cmanager.com.br/web/login/redefinir_acesso.php?token=' . $token . '&cpfCnpj=' . $dado_cript . '">Clique aqui</a> para ser redirecionado a página de recuperação.<br />2 - Valide os seus dados e crie uma nova senha.<br />3 - Pronto! Seu acesso foi recuperado.</p>
<p class="small">O link é válido para um único uso.<br />
Caso necessite de uma nova recuperação, <a href="http://cmanager.com.br/web/login/recuperar.php">clique aqui</a>.</p><br />
<p class="small"><font color="#333333"><b>Atenção: Esta é uma mensagem automática. Não é necessário respondê-la.</b></font></p>
<img src="http://cmanager.com.br/web/img/email/rodape.jpg"/>';

        if ($update_resultado) {
            $mail->Send();
            $sucesso = '<div class="alert alert-success alert-dismissible fade show" role="alert">#REC012 - Solicitação processada com sucesso. Um e-mail com o link de recuperação foi enviado para ' . $dados[0] . '';
            return $sucesso;
        } else {
            $erro = '<div class="alert alert-danger alert-dismissible fade show" role="alert">#REC013 - Não foi possível seguir com o processo de recuperação de acesso. Por favor, tente novamente mais tarde. Caso o erro persista, contate o seu síndico.';
            return $erro;
        }
    }

    function ResetarAcesso($dados) {

        $db = new Conexao();
        $con = $db->con;

        $verifica = "SELECT * FROM Usuario WHERE cpfCnpj = '$dados[0]' AND token = '$dados[1]'";
        $result = mysqli_query($con, $verifica);

        if (mysqli_num_rows($result) == 0) {
            $erro = '<div class="alert alert-danger alert-dismissible fade show" role="alert">#REC015 - Os dados preenchidos estão com divergencia. Por favor, solicite uma nova recuperação de acesso <a href="recuperar.php" class="alert-link">clicando aqui</a>.';
            return $erro;
        }

        $update = "UPDATE Usuario SET token = NULL, senha = '$dados[2]' WHERE cpfCnpj = '$dados[0]'";
        $resultado = mysqli_query($db->con, $update);

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "SMTP DO DOMINIO";
        $mail->SMTPAuth = true;
        $mail->Username = 'USUARIO DO EMAIL';
        $mail->Password = 'SENHA';

        // Remetente
        $mail->From = "cadastro@cmanager.com.br";
        $mail->FromName = "Acesso Resetado - CManager";

        // Destinatário
        $mail->AddAddress('$dados[0]');
        $mail->IsHTML(true);
        $mail->Subject = "Acesso Resetado - CMANAGER";
        $mail->Body = '';

        if ($resultado) {
            $mail->Send();
            $sucesso = '<div class="alert alert-success alert-dismissible fade show" role="alert">#RED016 - Redefinição de acesso feita com sucesso. Favor, realizar a autenticação com as novas credenciais <a href="index.php" class="alert-link">clicando aqui</a>.';
            return $sucesso;
        } else {
            $erro = '<div class="alert alert-danger alert-dismissible fade show" role="alert">#RED017 - Não foi possível seguir com o processo de recuperação de acesso. Por favor, tente novamente mais tarde. Caso o erro persista, contate o seu síndico.';
            return $erro;
        }
    }

    function Create($doc, $nome, $tipo, $senha, $condominio, $ap, $blc) {
        $user = new Usuario($doc, $nome, $senha, $tipo, $condominio);
        $user->setCondo($condominio);
        $user->setCpfCnpj($doc);
        $user->setApartamento($ap);
        $user->setBloco($blc);
        return $user;
    }

    function AtualizaPeloAdmin($doc, $nome, $tipo, $senha, $condominio) {
        $user = new Usuario($doc, $nome, $senha, $tipo, $condominio);
        return $user;
    }

    function AtualizaPeloSindico($doc, $nome, $senha, $condominio) {
        $user = new Usuario($doc, $nome, $senha, '', $condominio);
        return $user;
    }

    function Atualiza($nome, $senha) {
        $user = new Usuario('', $nome, $senha, '', '');
        return $user;
    }

    function Apaga($id) {
        header('Location:../views/usuario/views.php');
    }

    function Usuariologado($doc, $tipo) {
        $user = new Usuario($doc, "", "", $tipo, "");
        return $user;
    }

    function SelectCon() {
        return $condo;
    }
	
	function Relatorio($nome, $tipo, $doc, $id_tipo, $dados) {
        $Usuario = unserialize($_SESSION['usuario']);
        //Recebe o Array com os dados do usuario que logou...
        $Usuario = unserialize($_SESSION['usuario']);
        $db = new Conexao();
        $con = $db->con;
        $condominio = "SELECT * FROM Usuario
                    INNER JOIN CadastrCpf_Cnpj ON CadastrCpf_Cnpj.cpf_cnpj = cpfCnpj
                    WHERE tipoUser = '4';";

        $result = mysqli_query($con, $condominio);
        while ($row = mysqli_fetch_row($result)) {
            
        }
        if ($id_tipo == 0 || $dados == "true") {
            $query = "SELECT * FROM Usuario
            INNER JOIN CadastrCpf_Cnpj ON CadastrCpf_Cnpj.cpf_cnpj = cpfCnpj
            INNER JOIN Tipo ON Tipo.id = tipoUser
            WHERE cpfCnpj = '" . $Usuario['doc'] . "';"; //cpf do usuario
        } else if ($id_tipo == 1) {
            $query = "SELECT * FROM Usuario
            INNER JOIN CadastrCpf_Cnpj ON CadastrCpf_Cnpj.cpf_cnpj = cpfCnpj
            INNER JOIN Tipo ON Tipo.id = tipoUser
            WHERE CadastrCpf_Cnpj.nome LIKE '%$nome%'
            AND
            Tipo.tipo LIKE '%$tipo%'
            AND
            cpfCnpj LIKE '%$doc%'
            AND    
            condominio = 13457853000107;"; //cnpj do condominio
        } else if ($id_tipo == 2) {
            $query = "SELECT * FROM Usuario
            INNER JOIN CadastrCpf_Cnpj ON CadastrCpf_Cnpj.cpf_cnpj = cpfCnpj
            INNER JOIN Tipo ON Tipo.id = tipoUser
            WHERE cpfCnpj = 03433386960;"; //cpf do usuario
        } else if ($id_tipo == 3) {
            $query = "SELECT * FROM Usuario
            INNER JOIN CadastrCpf_Cnpj ON CadastrCpf_Cnpj.cpf_cnpj = cpfCnpj
            INNER JOIN Tipo ON Tipo.id = tipoUser
            WHERE CadastrCpf_Cnpj.nome LIKE '%$nome%'
            AND
            Tipo.tipo LIKE '%$tipo%'
            AND
            cpfCnpj LIKE '%$doc%';";
        } else {
            
        }

        $result = mysqli_query($con, $query);
        $tipo = "";
        ?>
        <?php

        $relatorio = '';
        if (($id_tipo == 3 || $id_tipo == 1) && $dados != "true") {
            $novo = "'../views/usuario/form.php'";
            $relatorio .= '<div class="w-100"><button type="button" class="btn btn-info btn-sm float-right" onclick="Conteudo(' . $novo . ')">CADASTRAR NOVO USUÁRIO</button><br><br></div>';
        }
        $relatorio .= '
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td>Nome</td>
                        <td>Tipo</td>
                        <td>Condominio</td>
                        <td>Apartamento</td>
                        <td>Status</td>
                    </tr>
                </thead>';
        if ($id_tipo == 1 || $id_tipo == 3) {
            $relatorio .= '
            <thead>
                <tr>
                    <td class="serch"><form action="#" method="Post"><input type="search" name="nome"></form></td>
                    <td class="serch"><form action="#" method="Post"><input type="search" name="tipo"></form></td>
                    <td class="serch"><form action="#" method="Post"><input type="search" name="condominio"></form></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead> ';
        }

        $relatorio .= ' 
            <tbody>';

        $nome_condo = "";
        while ($row = mysqli_fetch_row($result)) {

            $condominio = "SELECT nome FROM Usuario
                    INNER JOIN CadastrCpf_Cnpj ON CadastrCpf_Cnpj.cpf_cnpj = '" . $row[3] . "'
                    WHERE tipoUser = '4';";

            $result_cond = mysqli_query($con, $condominio);
            while ($row_cond = mysqli_fetch_row($result_cond)) {
                $nome_condo = $row_cond[0];
            }
            ///print_r($row);
            $apartamento = "";
            $query_ap = "SELECT blc, Predio.ap FROM apUser INNER JOIN Predio ON apUser.ap = Predio.id WHERE cpf_cnpj = '$row[3]';";
            $result_ap = mysqli_query($con, $query_ap);
            while ($row_ap = mysqli_fetch_row($result_ap)) {
                $apartamento = $row_ap[0] . $row_ap[1];
            }
            $tipo = $row[2];
            $id = $row[0];
           // if ($id_tipo == 0) {
                $atualiza = "'../views/usuario/form_update.php?atualiza=" . $id . "&tipo=" . $id_tipo . "'";
           // } else {
            //    $atualiza = "'../views/usuario/form_update.php?atualiza=" . $id . "'";
            //}
                if($row[5] == 1){
                    $row[5] = "ativo";
                }else{
                    $row[5] = "Pendente";
                }
            $deleta = "'../views/usuario/delete.php?deleta=" . $id . "'";
            $relatorio .= "<tr>";
            $relatorio .= "<td>$row[8]</td>"; //nome
            $relatorio .= "<td>$row[2]</td>"; //tipo
            $relatorio .= "<td>$nome_condo</td>"; //doc
            $relatorio .= "<td>$apartamento</td>"; //Apartamento
            $relatorio .= "<td>$row[5]</td>"; //ativo
            $relatorio .= '<td><input type="button" value="Atualizar" class="btn btn-info btn-sm" onclick="Conteudo(' . $atualiza . ')">'; //lincar em uma função de Update.php row[0]
            if ($id_tipo == 3 && $dados != "true") {
                $relatorio .= '&nbsp;<input type="button" value="Deletar" class="btn btn-danger btn-sm" onclick="Conteudo(' . $deleta . ')"></td>'; //lincar em uma função de Delete.php row[0]
            }
            $relatorio .= "</tr>";
        }
        $relatorio .= '  
            </tbody>
        </table>';
        return $relatorio;
    }

    function SelectCondominio() {
        $db = new Conexao();
        $con = $db->con;
        $opcao_cond = "<option value=''></option>";
        $condo = array();
        $condominio = "SELECT * FROM Usuario
                    INNER JOIN CadastrCpf_Cnpj ON CadastrCpf_Cnpj.cpf_cnpj = cpfCnpj
                    WHERE tipoUser = '4';";

        $result = mysqli_query($con, $condominio);
        while ($row = mysqli_fetch_row($result)) {
            $opcao_cond .= "<option value='$row[7]'>$row[8]</option> ";
        }
        return $opcao_cond;
    }

    function SelectTipo() {

        $db = new Conexao();
        $con = $db->con;
        $opcao = "<option value=''></option>";
        $tipo = "SELECT * FROM Tipo;";
        $result = mysqli_query($con, $tipo);
        while ($row = mysqli_fetch_row($result)) {
            $opcao .= "<option value='$row[0]'>$row[1]</option> ";
        }
        return $opcao;
    }

    function SelectBloco() {
        $db = new Conexao();
        $con = $db->con;
        $opcaoBL = "<option value=''></option>";
        $tipo = "SELECT * FROM Predio WHERE condominio = '13.457.853/0001-07' GROUP BY blc;";
        $result = mysqli_query($con, $tipo);
        while ($row = mysqli_fetch_row($result)) {
            $opcaoBL .= "<option value='$row[2]'>$row[2]</option> ";
        }
        return $opcaoBL;
    }

    function SelectApartamento() {
        $db = new Conexao();
        $con = $db->con;
        $opcaoAp = "<option value=''></option>";
        $tipo = "SELECT * FROM Predio WHERE condominio = '13.457.853/0001-07' GROUP BY ap;";
        $result = mysqli_query($con, $tipo);
        while ($row = mysqli_fetch_row($result)) {
            $opcaoAp .= "<option value='$row[3]'>$row[3]</option> ";
        }
        return $opcaoAp;
    }

    function CarregaUpdateUser($id) {
        $db = new Conexao();
        $con = $db->con;

        $query = "SELECT  Usuario.id, CadastrCpf_Cnpj.nome, Tipo.tipo, cpfCnpj, senha, ativo, condominio FROM Usuario
                INNER JOIN CadastrCpf_Cnpj ON CadastrCpf_Cnpj.cpf_cnpj = cpfCnpj
                INNER JOIN Tipo ON Tipo.id = tipoUser
                WHERE Usuario.id = $id;";

        $resultado = mysqli_query($con, $query);
        $user = Array();
        while ($row = mysqli_fetch_row($resultado)) {
            $user['doc'] = $row[3];
            $user['nome'] = $row[1];
            $user['senha'] = $row[4];
            $user['tipo'] = $row[5];
        }
        return $user;
    }

    function Desconecta() {
        session_start();
        session_destroy();
        header("Refresh: 5;url=../../web/login/index.php");
    }

}
?>