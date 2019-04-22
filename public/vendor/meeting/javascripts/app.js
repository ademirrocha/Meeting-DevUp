$(function() {
	$('.js-toggle').bind('click', function(event) {
		$('.js-sidebar, .js-content').toggleClass('is-toggled');
		event.preventDefault();
	});	
});





window.addEventListener('resize', function(){
    

    if( $(document).height() > $(window).height() ){
    	$('.aw-layout-footer').css('position', 'relative');
    }else{
    	$('.aw-layout-footer').css('position', 'absolute');
    }
});

window.addEventListener('load', function(){
	

    if( $(document).height() > $(window).height() ){
    	$('.aw-layout-footer').css('position', 'relative');
    }else{
    	$('.aw-layout-footer').css('position', 'absolute');
    }
});


function enviar_imagem(input) {
  if (input.files && input.files[0]) {
     var reader = new FileReader();

        reader.onload = function (e) {
          $('#imgUser').attr('src', e.target.result);
        }

    reader.readAsDataURL(input.files[0]);
  }
}


$("#imagem").change(function() {
  filename = this.files[0].name;

  //$("#forImg").html(this.files[0].url);

  enviar_imagem(this);


  console.log(filename);
});



function newCargo($msg = '', rota){
  token = document.getElementById('token_page').value;
  Swal.fire({

    title: 'Cadastrar Novo Cargo!',
    html: 
    "<form action='"+ rota + "' method='post'>"+
    "<input type='hidden' name='_token' value='"+ token +"'>"+
    "<span style='color:red;'>"+
    $msg+ "</span><br> "+
    "<input type='text' id='cargo' name='cargo' placeholder='Digite o Caro aqui'><br><br><br> <input type='submit' value='Salvar'>",
    
    
   confirmButtonText:
    'Cancelar',

    footer: ''
  })
}



