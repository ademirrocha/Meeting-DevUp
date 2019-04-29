@extends('vendor/meeting/templates/template')

@section('content')

<div class="container-fluid">


    <h3>Reunião: {{$reuniao->title}}</h3>
    
    <div>
    	Data de Inicio: {{$reuniao->data_inicio}}<br>
    	Data de Término: {{$reuniao->data_fim}}<br>
    	Facilitador: {{App\User::find($reuniao->user_id)->nome}}<br>
    </div>
    <br><br>
    <div class="row">


		 <div class="container-fluid col-sm-12 form-group">
            <div class="table-responsive">
                <table id="tabela-produtos" class="table  table-striped  table-bordered  table-hover  table-condensed  js-sticky-table">
                	
                    <thead class="aw-table-header-solid">
                    	<tr>
	                        <td colspan="6">Pessoas Convidadas/Convocadas</td>
	                    </tr>
                        <tr>
                            <th>Nome</th>
                            <th>Confirmou Presença</th>
                       
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
                                <td >Não</td>

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