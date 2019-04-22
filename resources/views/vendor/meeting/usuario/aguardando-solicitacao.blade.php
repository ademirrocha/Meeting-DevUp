@extends('vendor/meeting/templates/template')

@section('content')
	<div class="container-fluid">

		<?php 
            $organizacaoUser =  App\Models\Organizacao::find(auth()->user()->organizacao_id);
            $cargoUser = App\Models\Cargo::find(auth()->user()->cargo_id);
        ?>
        <h3>Aguardando Solicitação </h3>
        @if( $organizacaoUser->meeting_confirmed)
			<h4>A Empresa {{$organizacaoUser->fantasia}} ainda não respondeu sua solicitação...</h4>
		@else
			<h4>A Empresa Meeting Enterprise ainda não respondeu a solicitação para cadastro de sua empresa...</h4>
		@endif

	</div>

@endsection