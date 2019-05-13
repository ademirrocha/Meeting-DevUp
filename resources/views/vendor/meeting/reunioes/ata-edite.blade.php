@extends('vendor/meeting/templates/template')

@section('css')

@endsection

@section('content')
<div class="container-fluid">
	@section('bread-crumbs')
        <a href="{{url('home')}}">Página Inicial</a>/
        <a href="{{url('reunioes')}}">Gerenciar Reuniões</a>/
        <a href="{{url("reuniao/$reuniao->id/ata")}}">Editar Ata da Reunião</a>
    @endsection

    <input type="hidden" id="data_fim" value="{{$reuniao->data_fim}}">
    <input type="hidden" id="data-now" value="{{date('Y-m-d')}}">
    <input type="hidden" id="hora-now" value="{{date('H:i', strtotime('+10 minute', strtotime(date('H:i'))))}}">

    <div class="time form-group">
    	<label  class="control-label">
    		<span class="label-time">Tempo Restante:</span>
    		
    	</label>

    	<div class="time-end">
    		<span id="dias">00</span>
    		<span id="horas">00</span>:<span  id="minutos">00</span>:<span  id="segundos">00</span>
    	</div>
    	<div>
    		<button style="display: none;" type="submit" class="btn btn-primary btnAdiarEncerramento" onclick="adiarEncerramento(`{{url("reuniao/$reuniao->id/adiar-encerramento")}}`);" >Adiar Encerramento</button>
    	</div>


    </div>

    
	
	<h3>Reunião: {{$reuniao->title}}</h3>
	<div>
    	Data de Inicio: {{$reuniao->data_inicio}}<br>
    	Data de Encerramento: {{$reuniao->data_fim}}<br>
    	Facilitador: {{App\User::find($reuniao->user_id)->nome}}<br>
    </div>
    <hr>

    



    		 <div class="col-sm-12 btn-group ">
		        	
		        	
		        	<button type="submit" class="btn btn-warning " > Suspender Reunião </button> 

		        	<button type="submit" class="btn btn-danger " > Cancelar Reunião </button> 
		        	@if(! $reuniao->encerrada )
		        		<button  type="submit" class="btn btn-success " > Encerrar Reunião </button>
		        	@endif
		        	
		        </div>
	        
	        	<h3>Redigir Ata</h3>
	        	<div class="col-sm-6 form-group">
		        	<label class="control-label" id="situacao"></label>
		        </div>

		        <form id="form-ata" action="{{url("reuniao/$reuniao->id/ata/salvar")}}"  method="post">

		        <div class="row">
			    <div class="col-sm-6 form-group">
	        	
        		

	    			<input id="token_page" type="hidden" name="_token" value="{{csrf_token()}}">


		        	

		        		
	    			@if($reuniao->data_fim > date('Y-m-d H:i:s') )
		        		<textarea rows="20", cols="80" id="ata" name="ata" style="resize: none; " placeholder="Digite a Ata da Reunião Aqui..." onkeyUp="ataDigit();" onkeyDown="ataDigit();">{{$reuniao->ata->ata ?? ''}}</textarea>
		        	@else
		        		<textarea rows="20", cols="80"  id="ata" name="ata" style="resize: none; " readonly="readonly">{{$reuniao->ata->ata ?? 'A Ata Não Foi Redigida...'}}</textarea>
		        	@endif
		        	
		        	
		        		
		        		
	                    
	               

	                
                
                	
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
		        	Lista de Presença:<br><br>
		        	<hr>
		        	@foreach($pessoas as $pessoa)

		        	<?php $user = App\User::find($pessoa->user_id); ?>


		        		
					@if($pessoa->presente)
						<label id="pessoa_{{$pessoa->id}}" class="col-sm-12 form-group  point p_10" onclick="atualiza();" >     
                        	<input id="fun_{{$user->id}}" name="participantes[]" type="checkbox"  value="{{$user->id}}" checked/> {{$pessoa->usuario->nome}}
                        </label>
                    @else
                    	<label id="pessoa_{{$pessoa->id}}" class="col-sm-12 form-group  point p_10" onclick="atualiza();"  >
                        	<input id="fun_{{$user->id}}" name="participantes[]" type="checkbox" onclick="atualiza();"   value="{{$user->id}}"  />{{$pessoa->usuario->nome}}
                        </label>
                    @endif
                     	

                    
		        		<hr>
		        	@endforeach
		        </div>

		       
	        	
	        </div>

	    </form>
	    
    
</div>
@endsection

@section('js')

<script  src="{{asset('vendor/meeting/javascripts/script-ata.js')}}"></script>

@endsection