$(document).ready(function(){

        ultimaQtd = 0;
        ultimTexto = '';

        contar();
});


function ataDigit(){
        $('#situacao').html('Salvando Dados...');
}




function contar(){
        texto = $('#form-ata #ata').val();
        palavra = texto.split(' ').length;
        
        qtdAtual = palavra;
        textoAtual = texto;
        

        if(qtdAtual != ultimaQtd || textoAtual != ultimTexto){
                
                var form_url = $( $('#form-ata') ).attr("action");

                console.log(form_url);

                var dados = jQuery( $('#form-ata') ).serialize();
                $.ajax({
                        type: "POST",
                        url: form_url,
                        data: dados,
                        success: function( data )
                        {
                                if(data == 'true'){
                                        $('#situacao').html('Dados da Ata Foram Salvos!');
                                }
                                
                        }
                });

               
                

                ultimaQtd = $('#form-ata #ata').val().split(' ').length;
                textoAtual = $('#form-ata #ata').val();
        }

       
        setTimeout('contar();', 5000);

        return true;
}



