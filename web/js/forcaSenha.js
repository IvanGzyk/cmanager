$(function (){
  $('#senha').keyup(function (e){
      var senha = $(this).val();        
      if(senha == ''){
        $('#barra').hide();
      }else{
        var fSenha = forcaSenha(senha);
        var texto = "";
        $('#forca-senha').css('width', fSenha+'%');
        $('#forca-senha').removeClass();
        $('#forca-senha').addClass('progress-bar');
        if(fSenha <= 40){
            texto = 'Fraca';
            $('#forca-senha').addClass('progress-bar bg-danger');
        }
        
        if(fSenha > 40 && fSenha <= 70){
            texto = 'Média';
			$('#forca-senha').addClass('progress-bar bg-warning');
        }
        
        if(fSenha > 70 && fSenha <= 90){
            texto = 'Bom';
            $('#forca-senha').addClass('progress-bar bg-info');
        }
        
        if(fSenha > 90){
            texto = 'Muito bom!!!';
            $('#forca-senha').addClass('progress-bar bg-success');
        }
        
        $('#forca-senha').text(texto);
        
        $('#barra').show();
      }
    });
});
    
	function forcaSenha(senha){
    var forca = 0;
    
    var regLetrasMa     = /[A-Z]/;
    var regLetrasMi     = /[a-z]/;
    var regNumero       = /[0-9]/;
    var regEspecial     = /[!@#$%*()_+^&}{:;?.]/;
    
    var tam         = false;
    var tamM        = false;
    var letrasMa    = false;
    var letrasMi    = false;
    var numero      = false;
    var especial    = false;

    if(senha.length >= 8) tam = true;
    if(regLetrasMa.exec(senha)) letrasMa = true;
    if(regLetrasMi.exec(senha)) letrasMi = true;
    if(regNumero.exec(senha)) numero = true;
    if(regEspecial.exec(senha)) especial = true;
    
    if(tam) forca += 20;
    if(letrasMa) forca += 10;
    if(letrasMi) forca += 10;
    if(letrasMa && letrasMi) forca += 20;
    if(numero) forca += 20;
    if(especial) forca += 20;
    
    return forca;
}