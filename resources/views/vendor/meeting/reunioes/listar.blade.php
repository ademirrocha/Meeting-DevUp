@extends('vendor/meeting/templates/template')

@section('content')
    <div class="container-fluid">


    
        <h3>Listagem de Reunioes</h3>
        <div class="col-sm-12 form-group ">
            <a class="btn  btn-primary" href="{{route('reunioes/cadastrar')}}" >Nova Reuniao</a>
        </div>

        <div class="container-fluid col-sm-12 form-group">
            <div class="table-responsive">
                <table id="tabela-produtos" class="table  table-striped  table-bordered  table-hover  table-condensed  js-sticky-table">
                    <thead class="aw-table-header-solid">
                        <tr>
                            <th>Título</th>
                            <th>Local</th>
                            <th>Data Inicio</th>
                            <th>Data Término</th>
                            <th>Facilitador</th>
                            <th>Tipo de Reunião</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>


                        
                        @foreach($reunioes as $reuniao)

                        
                            

                            <tr >
                                <td >{{$reuniao->title}}</td>

                                <td >{{$reuniao->local->nome}}</td>
                                <td >{{$reuniao->data_inicio}}</td>
                                <td >{{$reuniao->data_fim}}</td>
                                <td >{{App\User::find($reuniao->user_id)->nome}}</td>
                                <td >{{$reuniao->tipo}}</td>
                                <td style="width:12px">

                                   
                                        

                                    
                                    <div class="btn-group">

                                        

                                        @foreach($permissoes as $permissao)


                                         @if($permissao->permissoes->contains('nome', 'update_reuniao') && $reuniao->user_id == auth()->user()->id)
                                            <a class="btn  btn-default" alt="Clique para visualizar ou editar essa reunião" title="Clique para visualizar ou editar essa reunião" href="{{url("reuniao/$reuniao->id/view")}}">
                                                <i class="fas fa-pencil-alt"></i>
                                                </a>

                                         @elseif($permissao->permissoes->contains('nome', 'view_reuniao'))

                                                <a class="btn  btn-default btn-xs" href="{{url("reuniao/$reuniao->id/view")}}" alt="Clique para ver detalhes dessa reunião" title="Clique para ver detalhes dessa reunião">
                                                    <i class="fa  fa-info-circle"></i>
                                                </a>
                                           
                                            @endif

                                            @if($permissao->permissoes->contains('nome', 'delete_reuniao'))
                                            <button class="btn  btn-default btn-xs">
                                                <i class="fa  fa-trash"></i>
                                            </button>
                                            @endif

                                        @endforeach

                                    </div>
                                    
                                    
                                   
                                    
        					    </td>
                            </tr>
                            </label>
                        @endforeach
                        @if($reunioes->count() == 0)
                            <tr>
                                <td colspan="6">Nenhuma Reuniao Marcada ainda</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
          
                
        
    </div>
@endsection