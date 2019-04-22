@extends('vendor/meeting/templates/template')

@section('content')
    <div class="container-fluid">
    <form>
        <input id="token_page" type="hidden" name="_token" value="{{csrf_token()}}">
        <h3>Listagem Organização</h3>
        

        <div class="container-fluid col-sm-12 form-group">
            <div class="table-responsive">
                <?php 
                    if(Auth::user()->organizacao_id == 2)
                        $organizacoes = App\Models\Organizacao::all();
                    else 
                        $organizacoes = App\Models\Organizacao::find(Auth::user()->organizacao_id);
                ?>
                <table id="tabela-produtos" class="table  table-striped  table-bordered  table-hover  table-condensed  js-sticky-table">
                    <thead class="aw-table-header-solid">
                        <tr>
                            <th>Razão Social</th>
                            <th>Fantasia</th>
                            <th>CNPJ</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(Auth::user()->organizacao_id == 2)
                            <script src="{{ asset('vendor/meeting/javascripts/script-admin-meeting.js') }}"></script>
                            @foreach( $organizacoes as $organizacao )
                                @if($organizacao->id > 1)

                                    @if( ! $organizacao->meeting_confirmed)
                                        <tr style="background: #FF7F24;">
                                    @else
                                        <tr >
                                    @endif
                                    
                                        <td >{{$organizacao->razao_social}}</td>
                                        <td >{{$organizacao->fantasia}}</td>
                                        <td >{{$organizacao->cnpj}}</td>
                                        <td >
                                            @if( $organizacao->meeting_confirmed )
                                                Registrada
                                            @else
                                                Solicitação Pendente
                                                @if(Auth::user()->organizacao_id == 2)

                                                <?php $d = App\User::all(); ?>
                                                    @foreach($d as $i)
                                                        @if($i->organizacao_id == $organizacao->id)
                                                            <?php $u = $i->id; ?>
                                                        @endif
                                                    @endforeach

                                                    {{$u}}

                                                <a class="btn btn-primary" onclick="autorizarOrganizacao('{{$organizacao->id}}', '{{$u}}', '{{$organizacao->fantasia}}', `{{route('admin/autorizar-organizacao')}}`)" href="#">Autorizar</a>
                                                @endif

                                            @endif
                                        </td>
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
                                    
                                   
                                @endif
                            @endforeach
                        @else
                             <tr >
                                <td >{{$organizacoes->razao_social}}</td>
                                <td >{{$organizacoes->fantasia}}</td>
                                <td >{{$organizacoes->cnpj}}</td>
                                <td >
                                    @if( $organizacoes->meeting_confirmed )
                                        Registrada
                                    @else
                                        Solicitação Pendente
                                    @endif
                                </td>

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
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
          
                
        </form>
    </div>

@endsection