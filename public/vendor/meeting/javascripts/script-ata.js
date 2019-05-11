$(document).ready(function(){

        ultimaQtd = 0;
        ultimTexto = '';
        contar();
        
        $('.btnAdiarEncerramento').hide();

      

      
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



//var data = document.getElementById('data_fim').value;

var target_date = new Date(document.getElementById('data_fim').value).getTime();
var dias, horas, minutos, segundos;
var regressiva = document.getElementById("regressiva");



 var runTime = setInterval(contTime, 1000);

function contTime(){

    var current_date = new Date().getTime();
    var segundos_f = (target_date - current_date) / 1000;

dias = parseInt(segundos_f / 86400);
    segundos_f = segundos_f % 86400;
    
    horas = parseInt(segundos_f / 3600);
    segundos_f = segundos_f % 3600;
    
    minutos = parseInt(segundos_f / 60);
    segundos = parseInt(segundos_f % 60);



        document.getElementById('dias').innerHTML = new Padder(2).pad(dias) + ' Dias ';
        document.getElementById('horas').innerHTML = new Padder(2).pad(horas);
        document.getElementById('minutos').innerHTML = new Padder(2).pad(minutos);
        document.getElementById('segundos').innerHTML = new Padder(2).pad(segundos);

        if(segundos < 0 ){
                $('.btnAdiarEncerramento').show();
                $('.time-end').hide();
                $('.label-time').html('Acabou o tempo da reunião!');

                

                
                document.getElementById('ata').setAttribute("readonly", "readonly");
                $("#ata").blur();
                $('#situacao').hide();

                contar();

                stopTime();

               

        }

        if(dias <= 0 ){
                $('#dias').hide();
        }
  

}


function stopTime() {
  clearInterval(runTime);
}


function adiarEncerramento(rota){

        
        token = document.getElementById('token_page').value;
        
        hora = document.getElementById('hora-now').value;
        data = document.getElementById('data-now').value;
       



  Swal.fire({

    title: 'Adiar o Encerramento',
    html: 
    "<form action='"+ rota + "' method='post'>"+
    "<input type='hidden' name='_token' value='"+ token +"'>"+
    " <div class='col-sm-6 form-group'>"+
    "<label for='data_fim'  class='control-label'>Data de Encerramento</label>"+
    "<input id='data_fim' value='"+data+"' name='data_fim' type='date' class='form-control' required/>"+
    "<label for='hora_fim'  class='control-label'>Hora de Encerramento</label>"+
    "<input id='hora_fim' name='hora_fim' type='time' class='form-control' value='"+hora+"' required/>"+
    "</div>"+
    "<br><br><br> <input type='submit' value='Salvar'>"+
    "</form>",
    
    
   confirmButtonText:
    'Cancelar',

    footer: ''
  })
}

















function Padder(len, pad) {
  if (len === undefined) {
    len = 1;
  } else if (pad === undefined) {
    pad = '0';
  }

  var pads = '';
  while (pads.length < len) {
    pads += pad;
  }

  this.pad = function (what) {
    var s = what.toString();
    return pads.substring(0, pads.length - s.length) + s;
  };
}


