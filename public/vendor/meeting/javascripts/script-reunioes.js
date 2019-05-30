$(document).ready(function(){   
        
        buscarNextReunioes();
           
});

var reunioes;


function buscarNextReunioes(){
	

                $.ajax({
                    type: "GET",
                    url:"/reunioes/buscarNextReunioes",
                    data: '',
                    success: function( data )
                    {

                    	if(data == 'sem reunioes futuras'){
                    		console.log(data);
                    		reunioes = data;

                    	}else{

                    		var strBuilder = [];

                    		console.log(data);

                    		reunioes = data;
                            
/*
                        	for(key in data){
                              	if (data.hasOwnProperty(key)) {
                                 	strBuilder.push(data[key]);
                                 	console.log(data[key]);
                                    
                            	}
                        	}
*/
                      /*
                        $('#div-ata').val(text_ata);
                        $('#hora_encerrar').html(data_final);
                        $('#data_fim').html(data_final);
						*/

                    	}
                        
                         
                        
                    }      
                        
                });
}


function atualizaListaFuncionarios(){

	//console.log(reunioes[0].data_inicio);

	for(i in reunioes){
		console.log(reuniao[i].data_inicio);
	}

	//console.log(data_ini.value);

	//console.log(reunioes);

}
