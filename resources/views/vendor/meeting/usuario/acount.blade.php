@extends('vendor/meeting/templates/template')

@section('content')

	<div class="container-fluid">
		<h3>Dados da conta</h3>



		<br>
		@if(Auth::user()->imagem == null)
			
				<img src="{{ asset('storage/users/perfil.png') }}" class="imagem-usuario-acount ">
			
		@else
				<img src="{{ asset('storage/users/'.auth()->user()->imagem) }}" class="imagem-usuario-acount ">
			
		@endif
		<br>Imagem do Perfil<br>

		<br>Nome: {{Auth::user()->nome}}
		<br>Email: {{Auth::user()->email}}
		<br>CPF: {{Auth::user()->cpf}}
		<br>Telefone: {{Auth::user()->telefone}}
		<br>Sexo: {{Auth::user()->sexo}}

		<br><br>
		<form action="{{route('acount/edit')}}">  
			<button  type="submit" >Editar Dados</button>
		</form>
		

	</div>


@endsection