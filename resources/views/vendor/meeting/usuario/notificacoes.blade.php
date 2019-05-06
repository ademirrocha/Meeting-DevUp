@extends('vendor/meeting/templates/template')

@section('content')


    <div class="container-fluid">
    	@section('bread-crumbs')
            <a href="{{url('home')}}">Página Inicial</a>/
    		<a href="{{url("$rota")}}">Notificações</a>
        @endsection
    	
    	<div class="row">
    		<h3>Notificação: {{$notificacao->title}}</h3>
    		<div class="col-sm-12">
    			<div class="col-sm-8">
	    			{{$notificacao->texto}}
	    		</div>
    		</div>
    		@if($rota != '')
	    		<div class="col-sm-12">
	    			<a href="{{url("$rota")}}" class="btn btn-success">{{$textAction}}</a>
	    		</div>
    		@endif

    		

    	</div>

    </div>
@endsection