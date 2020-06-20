// Validação de campos de interesse com alert para impedir a submissão dos dados.
// Desta forma, caso o preenchimento não atenda as regras de interesse, o mesmo é interrompido e mostrado ao consumidor final.
function validarInteresse(){
	
	if (interesse.repres.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo NOME DO REPRESENTANTE não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (interesse.cond.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo NOME DO CONDOMÍNIO não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (interesse.tel.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo TELEFONE PARA CONTATO não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (interesse.unid.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo QDTE DE UNIDADES não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (interesse.blc.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo QTDE DE BLOCOS não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (interesse.email.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo E-MAIL não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (interesse.email.value.indexOf('@') == -1 || cadastro.emailprinc.value.indexOf('.') == -1) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>Por favor, insira um E-MAIL válido.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (interesse.endereco.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo LOGRADOURO não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (interesse.cidade.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo CIDADE não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (interesse.estado.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo ESTADO não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (interesse.cep.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo CEP não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}
	if (interesse.mensagem.value == "" || null) {
		$("#alerta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>O campo MENSAGEM não pode ficar em branco.<button type='button' class='close' data-dismiss='alert' aria-label='fechar'><span aria-hidden='true'>&times;</span></button></div>");
		return false;
	}else{
		return true;
	}
}