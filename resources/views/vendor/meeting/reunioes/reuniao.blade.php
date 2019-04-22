@extends('vendor/meeting/templates/template')

@section('content')

<div class="container-fluid">


    <h3>Reunião: {{$reuniao->pauta}}</h3>
    <div>
    	Data de Inicio: {{$reuniao->data_inicio}}<br>
    	Data de Término: {{$reuniao->data_fim}}<br>
    	Facilitador: {{App\User::find($reuniao->user_id)->nome}}<br>
    </div>
    <br><br>
    <div class="row">

    	
    	
    
		@if($reuniao->user_id == auth()->user()->id)

			<a class="btn  btn-primary" href="#" onclick="addPessoaReuniao( '{{$reuniao->pauta}}')">Adicionar Pessoas</a>

			<?php
				$funcionarios = App\User::where('organizacao_id', $reuniao->organizacao_id)->get();


			?>



			<div style="display:none;" id="form_pessoas">
				<div>Selecione as pessoas abaixo que deseja adicionar a reunião</div>
				</br>
				<hr>

				<form action="{{route('reuniao/adicionar-pessoas')}}" method='post'>
				    <input id="token_page" type="hidden" name="_token" value="{{csrf_token()}}">

				    

					    <input type='hidden' name='reuniao' value='{{$reuniao->id}}'>
					    @foreach($funcionarios as $funcionario)

					    <?php
					    	
					    	$userIn = DB::select('select * from users_reuniao where user_id = ? && reuniao_id = ? ', [$funcionario->id, $reuniao->id]);
					    ?>

						
						@if(!$userIn)

					    <div class="col-sm-12 form-group">
					    	{{$funcionario->nome}} <input type='checkbox' name='pessoa[]' value='{{$funcionario->id}}'>

					    </div>
					    <div class="col-sm-12 form-group">
					    	Tipo de Convocação:<br>
				    	
					    	<label>Convidado: 
					    		<input type='radio' name='tipo{{$funcionario->id}}' value='Convidado'>
					    	</label>

					    	<label>Convocado: 
					    		<input type='radio' name='tipo{{$funcionario->id}}' value='Convocado'>
					    	</label>
					    </div>
					    <hr>

					   @endif

				    @endforeach
				     
				    <button id="btnAddPessoa" type='submit' class="btn btn-primary" >Adicionar Pessoas</button>
				</form>

			</div>

			

			
		@endif


		 <div class="container-fluid col-sm-12 form-group">
            <div class="table-responsive">
                <table id="tabela-produtos" class="table  table-striped  table-bordered  table-hover  table-condensed  js-sticky-table">
                	
                    <thead class="aw-table-header-solid">
                    	<tr>
	                        <td colspan="6">Pessoas Convidadas/Convocadas</td>
	                    </tr>
                        <tr>
                            <th>Nome</th>
                            <th>Tipo de Convite</th>
                       
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    	
                       @foreach($pessoas as $pessoa)

                       <?php
                       	$user = App\User::find($pessoa->user_id);
                       	?>
                            <tr >
                                <td >{{$user->nome}}</td>
                                <td >{{$pessoa->tipo}}</td>

                                <td style="width:12px">

                                   


                                    @if($reuniao->user_id == auth()->user()->id)
                                    <div class="btn-group">
                                        <button class="btn  btn-default">
                                        <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        
                                        <button class="btn  btn-default btn-xs">
                                            <i class="fa  fa-trash"></i>
                                        </button>
                                    </div>
                                    
                                    @endif
                                    
        					    </td>
                            </tr>
                        @endforeach
                        
                        @if($pessoas->count() == 0)
                            <tr>
                                <td colspan="6">Nenhuma Pessoa na Reunião ainda</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>


	</div>

</div>

@endsection