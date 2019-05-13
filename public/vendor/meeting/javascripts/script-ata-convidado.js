$(document).ready(function(){

        
        reload();
        

      
});


function reload(id){

        var dados = jQuery( $('#form-ata') ).serialize();

        var form_url = $( $('#form-ata') ).attr("action");

                $.ajax({
                        type: "GET",
                        url: form_url,
                        data: dados,
                        success: function( data )
                        {

                            
                                var strBuilder = [];
                                ata = '';
                                data_final = '';
                        for(key in data){
                              if (data.hasOwnProperty(key)) {
                                 strBuilder.push(data[key]);
                                 console.log(key);
                                 if(key == 'ata'){
                                        ata = data[key];  
                                 }
                                 if(key == 'data_fim'){
                                        data_final = data[key];  
                                 }
                                 
                            }
                        }

                        text_ata = '';
                        for(key in ata){
                              if (ata.hasOwnProperty(key)) {
                                 strBuilder.push(ata[key]);
                                 console.log(key);
                                 if(key == 'ata'){
                                        text_ata = ata[key];  
                                 }   
                            }
                        }

                       

                        $('#div-ata').val(text_ata);
                        $('#hora_encerrar').html(data_final);
                        $('#data_fim').html(data_final);

                        count_time();
                                
                        }
                });


        setTimeout('reload('+id+');', 30000);

}













//var data = document.getElementById('data_fim').value;

var target_date = new Date(document.getElementById('data_fim').value).getTime();
var dias, horas, minutos, segundos;

setInterval(function () {

        target_date = new Date(document.getElementById('data_fim').value).getTime();

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
                $('.time-end').hide();
                $('.label-time').html('Acabou o tempo da reunião!');
        }

        if(dias <= 0 ){
                $('#dias').hide();
        }
  

}, 1000);








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


