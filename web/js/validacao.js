// Validação de campos do cadastro com alert para impedir a submissão dos dados.
// Desta forma, caso o preenchimento não atenda as regras de cadastro, o mesmo é interrompido e mostrado ao consumidor final.
function validarLogin(){

	if (login.cpfCnpj.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo CPF/CNPJ não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (login.senha.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo SENHA não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}else{
		return true;
	}
}

function validarAcessoCadastro(){

	if (condominio.cnpj.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo CNPJ não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (condominio.senha.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo SENHA não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}else{
		return true;
	}
}

function validarCadastro(){

	var forcaSenha = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W+)(?=^.{8,}$).*$/;
	
	if (cadastro.cpfCnpj.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo CPF/CNPJ não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (cadastro.nome.value.length < 5) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo NOME deve ter no mínimo 5 caracteres.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (cadastro.emailprinc.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo E-MAIL PRINCIPAL não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (cadastro.emailprinc.value.indexOf('@') == -1 || cadastro.emailprinc.value.indexOf('.') == -1) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>Por favor, insira um E-MAIL PRINCIPAL válido.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (cadastro.senha.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo SENHA não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (!forcaSenha.exec(cadastro.senha.value)) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo SENHA deve atender as regras descritas em INTENSIDADE DA SENHA.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (cadastro.confirmarsenha.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo CONFIRMAR SENHA não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (cadastro.senha.value != cadastro.confirmarsenha.value) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>As senhas digitadas não conferem.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}else{
		return true;
	}
}

function validarRecuperacao(){
	
	if (recuperar.email.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo E-MAIL não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (recuperar.email.value.indexOf('@') == -1 || recuperar.email.value.indexOf('.') == -1) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>Por favor, insira um E-MAIL válido.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}else{
		return true;
	}
}

function validarRedefinicao(){

	var forcaSenha = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W+)(?=^.{8,}$).*$/;
	
	if (redefinicao.token.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo TOKEN não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (redefinicao.senha.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo SENHA não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (!forcaSenha.exec(redefinicao.senha.value)) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo SENHA deve atender as regras descritas em INTENSIDADE DA SENHA.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (redefinicao.confirmarsenha.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo CONFIRMAR SENHA não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (redefinicao.senha.value != redefinicao.confirmarsenha.value) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>As senhas digitadas não conferem.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}else{
		return true;
	}
}