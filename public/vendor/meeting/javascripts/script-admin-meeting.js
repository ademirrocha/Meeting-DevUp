

function autorizarOrganizacao($obj = '', $user, $fantasia, rota){
  token = document.getElementById('token_page').value;

  Swal.fire({

    title: 'Autorizar Organizacao!',
    html: 
    "<div>Deseja Realmente Autorizar o registro da empresa "+ $fantasia +"? </div>"+
    "<form action='"+ rota + "' method='post'>"+
    "<input type='hidden' name='_token' value='"+ token +"'>"+
    "<input type='hidden' name='organizacao' value='"+$obj+"'>"+
    "<input type='hidden' name='user' value='"+$user+"'>"+
    "<span style='color:red;'>"+
    "</span><br> "+
    "<br><br><br> <input type='submit' value='Sim, Autorizar'>",
    
    
   confirmButtonText:
    'Cancelar',

    footer: ''
  })
}