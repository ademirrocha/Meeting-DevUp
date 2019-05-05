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
		        	Ações:
		        	<br><br>
		        	<button type="submit" class="btn btn-primary" > Suspender Reunião </button><br><br>

		        	<button type="submit" class="btn btn-primary" > Cancelar Reunião </button><br><br>

		        	<button type="submit" class="btn btn-primary" > Encerrar Reunião </button><br><br>
		        	
		        </div>
	        	
	        </div>
	    
    
</div>
@endsection

@section('js')

<script  src="{{asset('vendor/meeting/javascripts/script-ata.js')}}"></script>

@endsection