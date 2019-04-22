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
                            <th>Pauta</th>
                            <th>Local</th>
                            <th>Data Inicio</th>
                            <th>Data Término</th>
                            <th>Facilitador</th>
                            <th>Convidado/Convocado</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($reunioes as $reuniao)
                            <tr >
                                <td >{{$reuniao->pauta}}</td>

                                <td >{{App\Models\Localizacao::find($reuniao->localizacao_id)->nome}}</td>
                                <td >{{$reuniao->data_inicio}}</td>
                                <td >{{$reuniao->data_fim}}</td>
                                <td >{{App\User::find($reuniao->user_id)->nome}}</td>
                                <td >nenhum</td>
                                <td style="width:12px">
                                    <div class="btn-group">
                                        <button class="btn  btn-default">
                                        <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        
                                        <button class="btn  btn-default btn-xs">
                                            <i class="fa  fa-trash"></i>
                                        </button>
                                    </div>
        					    </td>
                            </tr>
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