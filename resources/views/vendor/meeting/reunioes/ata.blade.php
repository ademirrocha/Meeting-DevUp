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

    <input type="hidden" id="data_fim" value="{{$reuniao->data_fim}}">


    

    <div class="time form-group">
    	<label  class="control-label">
    		<span class="label-time">Tempo Restante:</span>
    		
    	</label>

    	<div class="time-end">
    		<span id="dias">00</span>
    		<span id="horas">00</span>:<span  id="minutos">00</span>:<span  id="segundos">00</span>
    	</div>
    	


    </div>
	
	<h3>Reunião: {{$reuniao->title}}</h3>
	<div>
    	Data de Inicio: {{$reuniao->data_inicio}}<br>
    	Data de Encerramento: <span id="hora_encerrar">{{$reuniao->data_fim}}</span><br>
    	Facilitador: {{App\User::find($reuniao->user_id)->nome}}<br>
    </div>
    <hr>

	        	<h3>Ata da Reunião</h3>
	        	<div class="col-sm-6 form-group">
		        	<label class="control-label" id="situacao"></label>
		        </div>

		        <div class="row">
			    <div class="col-sm-6 form-group">
	        	
			    	<form id="form-ata" action="{{url("reuniao/$reuniao->id/buscarAta")}}"> 

			    		<button type="submit">clique </button>
	    			
		        		<textarea rows="20", cols="80" id="div-ata" name="ata" style="resize: none; " readonly="readonly">{{$reuniao->ata->ata ?? 'A Ata Não Foi Redigida...'}}</textarea>

		        	</form>
		        	
		        	
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
		        	Pessoas Presentes:<br><br>
		        	<hr>
		        	@foreach($pessoas as $pessoa)
		        		@if($pessoa->presente)
			        		<label class="col-sm-12 form-group  point p_10">                    
	                            {{$pessoa->usuario->nome}}
	                        </label>
			        		<hr>
		        		@endif

		        	@endforeach
		        </div>

		       
	        	
	        </div>
	    
    
</div>

@endsection


@section('js')

<script  src="{{asset('vendor/meeting/javascripts/script-ata-convidado.js')}}"></script>

@endsection