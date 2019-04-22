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