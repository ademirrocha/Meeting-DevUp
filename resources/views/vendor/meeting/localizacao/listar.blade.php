@extends('vendor/meeting/templates/template')

@section('content')
    <div class="container-fluid">
    
        <h3>Lista de Locais de Reuniões</h3>
        <div class="col-sm-12 form-group ">
            <a class="btn  btn-primary" href="{{route('locais/cadastrar')}}" >Cadastrar Novo Local</a>
        </div>

        <div class="container-fluid col-sm-12 form-group">
            <div class="table-responsive">
                <table id="tabela-produtos" class="table  table-striped  table-bordered  table-hover  table-condensed  js-sticky-table">
                    <thead class="aw-table-header-solid">
                        <tr>
                            <th>Nome do Local</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $localizacoes = App\Models\Localizacao::where('organizacao_id', auth()->user()->organizacao_id)->get();

                        ?>
                        @foreach($localizacoes as $localizacao)
                            <tr >
                                <td >{{$localizacao->nome}}</td>
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
                        @if($localizacoes->count() == 0)
                            <tr>
                                <td colspan="6">Nenhum Local cadastrado ainda!</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
          
                
        
    </div>
@endsection