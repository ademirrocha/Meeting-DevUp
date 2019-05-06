@extends('vendor/meeting/templates/template')

@section('css')

@endsection

@section('content')

<div class="container-fluid">
	@section('bread-crumbs')
        <a href="{{url('home')}}">Página Inicial</a>/
        <a href="{{url('reunioes')}}">Gerenciar Reuniões</a>/
        <a href="{{url("reuniao/$reuniao->id/ata")}}">Ver Ata da Reunião</a>
    @endsection
	
	<h3>Reunião: {{$reuniao->title}}</h3>
	<div>
    	Data de Inicio: {{$reuniao->data_inicio}}<br>
    	Data de Término: {{$reuniao->data_fim}}<br>
    	Facilitador: {{App\User::find($reuniao->user_id)->nome}}<br>
    </div>
    <hr>

	        	<h3>Ata da Reunião</h3>
	        	<div class="col-sm-6 form-group">
		        	<label class="control-label" id="situacao"></label>
		        </div>

		        <div class="row">
			    <div class="col-sm-6 form-group">
	        	

	    			
		        		<textarea id="div-ata" name="ata" style="resize: none; " readonly="readonly">{{$reuniao->ata->ata}}</textarea>
		        	
		        	
	        	</div>
	        	<div class="col-sm-3 form-group">
		        	Pautas:<br><br>
		        	<hr>
		        	@foreach($pautas as $pauta)



		        		{{$pauta->nome}}
		        		<hr>
		        	@endforeach
		        </div>

		        <div class="col-sm-3 form-group">
		        	Lista Pessoas Presentes:<br><br>
		        	<hr>
		        	@foreach($pessoas as $pessoa)

		        	<?php $user = App\User::find($pessoa->user_id); ?>

		        		

		        		 <label class="col-sm-12 form-group  point p_10">                    
                            {{$user->nome}}
                        </label>
		        		<hr>
		        	@endforeach
		        </div>

		       
	        	
	        </div>
	    
    
</div>

@endsection