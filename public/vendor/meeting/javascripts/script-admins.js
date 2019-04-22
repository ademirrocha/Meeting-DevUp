function autorizarUsuario($user = '', $userNome,  rota){
  token = document.getElementById('token_page').value;

  Swal.fire({

    title: 'Autorizar Usuário!',
    html: 
    "<div>Deseja Realmente autorizar o usuário "+ $userNome +" a fazer parte dessa organização? </div>"+
    "<form action='"+ rota + "' method='post'>"+
    "<input type='hidden' name='_token' value='"+ token +"'>"+
    "<input type='hidden' name='user' value='"+$user+"'>"+
    "<span style='color:red;'>"+
    "</span><br> "+
    "<br><br><br> <input type='submit' value='Sim, Autorizar'>",
    
    
   confirmButtonText:
    'Cancelar',

    footer: ''
  })
}