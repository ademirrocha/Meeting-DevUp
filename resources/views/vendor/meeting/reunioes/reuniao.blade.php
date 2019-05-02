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
        <div class="col-sm-12 form-group">

            @if(session('error'))
                <div class="session-error col-sm-12" role="alert">
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif
             @if(session('sucesso'))
                <div class="session-sucess col-sm-12" role="alert">
                    <strong>{{ session('sucesso') }}</strong>
                </div>
            @endif
        </div>
    </div>
            
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
                                <td >
                                    @if($pessoa->confimou_presenca)
                                        Sim
                                        <i class="fas fa-thumbs-up"></i>
                                    @else
                                        Não
                                        <i class="fas fa-thumbs-down"></i>
                                    @endif
                                    

                                    
                                </td>

                                <td style="width:12px">



                                   
                                    <div class="btn-group">
                                        @if($user->id == auth()->user()->id)
                                            @if(! $pessoa->confimou_presenca)

                                                    <a href="{{url("reuniao/$reuniao->id/confirmar_presenca/$user->id/confirm")}}" class="btn  btn-default btn-xs" href="#" alt="Clique para confirmar sua presença nessa reunião" title="Clique para confirmar sua presença nessa reunião">
                                                        <i class="fas fa-clipboard-check"></i>
                                                    </a>

                                            @else
                                                <a style="color: red;" class="btn  btn-default btn-xs" href="#" alt="Clique para cancelar sua presença nessa reunião" title="Clique para cancelar sua presença nessa reunião">
                                                    <i class="fas fa-window-close"></i>
                                                </a>
                                            @endif


                                            
                                        @endif

                                        @if($reuniao->user_id == auth()->user()->id)
                                        
                                            <a class="btn  btn-default">
                                            <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            
                                            <button class="btn  btn-default btn-xs">
                                                <i class="fa  fa-trash"></i>
                                            </button>
                                        
                                        
                                        @endif
                                    </div>
                                    
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