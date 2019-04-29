function redirectReuniao($reuniao = '', rota){
  window.location.href = (rota+'?reuniao='+$reuniao);
  
}




 				




function addPessoaReuniao( $pauta){
	var formpessoas = document.getElementById('form_pessoas').innerHTML;

	  Swal.fire({

	  	

	    title: 'Adicionar Pessoas Na Reunião!',
	    html: 
	    "<div> Reunião: "+$pauta+"</div>"+
	    "<div> "+formpessoas+"</div>",
	    
	    
	    
	   confirmButtonText:
	    'Cancelar',

	    footer: ''
	  })
}


function gera_id(){
		var size = 4;
		var randomized = Math.ceil(Math.random() * Math.pow(10,size));//Cria um número aleatório do tamanho definido em size.
		var digito = Math.ceil(Math.log(randomized));//Cria o dígito verificador inicial
		while(digito > 10){//Pega o digito inicial e vai refinando até ele ficar menor que dez
			digito = Math.ceil(Math.log(digito));
		}
		var id = randomized + '-' + digito;//Cria a ID
		return (id);
	}


function setNewPauta(){
	var id = gera_id();
	var id1 = 'id-pauta-'+id;
	var id2 = 'id-btn-'+id;

	var newPauta = '<div class="btn-group btn-menos" id="'+id2+'">'+
                        '<a class="btn  btn-default" onclick="removePauta(`'+id1+'`, `'+id2+'`);">'+
                        '<i class="fas fa-minus-circle"></i>'+
                        '</a>'+
                    '</div><input name="pauta[]" type="text" id="'+id1+'" class="form-control col-sm-10 input-pauta" value="" required autocomplete="pauta" placeholder="Digite a Pauta" autofocus/>';

	var ultimaPauta;
	$('input.input-pauta').each(function(index, element){
		ultimaPauta = element;

	});


	   

	if(ultimaPauta.value == '' || ultimaPauta.value == ' ' || ultimaPauta.value == '  '){
		ultimaPauta.classList.add('input-error');
		ultimaPauta.focus();
		$("#error-pauta").html('Preencher este Campo!');
	}else{
		if(ultimaPauta.classList.contains('input-error')){
			ultimaPauta.classList.remove('input-error');
		}

		
		
		$("#error-pauta").html('');
		$("#formulario").append( newPauta);

		$("#error-pauta").before( $('#'+id2), $('#'+id1) );

		document.getElementById(id1).focus();
		
	}



}



function removePauta(id1, id2){
	var cod1=id1;
	var cod2=id2;
	

	var pauta =document.getElementById(cod1);
	var btn =document.getElementById(cod2);
	var area = document.getElementById("area-box-pautas");
	
	area.removeChild(pauta);
	area.removeChild(btn);

}