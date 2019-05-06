@extends('vendor/meeting/templates/template')

@section('css')

@endsection

@section('content')
<div class="container-fluid">
	
	<h3>Reunião: {{$reuniao->title}}</h3>
	<div>
    	Data de Inicio: {{$reuniao->data_inicio}}<br>
    	Data de Término: {{$reuniao->data_fim}}<br>
    	Facilitador: {{App\User::find($reuniao->user_id)->nome}}<br>
    </div>
    <hr>

    



    		 <div class="col-sm-12 btn-group ">
		        	
		        	
		        	<button type="submit" class="btn btn-warning " > Suspender Reunião </button> 

		        	<button type="submit" class="btn btn-danger " > Cancelar Reunião </button> 

		        	<button type="submit" class="btn btn-success " > Encerrar Reunião </button>
		        	
		        </div>
	        
	        	<h3>Redigir Ata</h3>
	        	<div class="col-sm-6 form-group">
		        	<label class="control-label" id="situacao"></label>
		        </div>

		        <div class="row">
			    <div class="col-sm-6 form-group">
	        	<form id="form-ata" action="{{url("reuniao/$reuniao->id/ata/salvar")}}"  method="post">

	    			@csrf

		        	
		        	

		        		
	    			
		        		<textarea rows="20", cols="80" id="ata" name="ata" style="resize: none; " placeholder="Digite a Ata da Reunião Aqui..." onkeyUp="ataDigit();" onkeyDown="ataDigit();">{{$reuniao->ata->ata}}</textarea>
		        	
		        	
		        		
		        		
	                    
	               

	                
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
		        	Lista de Presença:<br><br>
		        	<hr>
		        	@foreach($pessoas as $pessoa)

		        	<?php $user = App\User::find($pessoa->user_id); ?>

		        		

		        		 <label class="col-sm-12 form-group  point p_10">
                                                
                                                {{$user->nome}}
                                                <input id="fun_{{$user->id}}" name="participantes[]" type="checkbox" class="" value="{{$user->id}}"/>

                                            </label>
		        		<hr>
		        	@endforeach
		        </div>

		       
	        	
	        </div>
	    
    
</div>
@endsection

@section('js')

<script  src="{{asset('vendor/meeting/javascripts/script-ata.js')}}"></script>

@endsection