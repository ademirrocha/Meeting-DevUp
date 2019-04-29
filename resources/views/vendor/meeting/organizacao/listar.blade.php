@extends('vendor/meeting/templates/template')

@section('content')
    <div class="container-fluid">
    <form>
        <input id="token_page" type="hidden" name="_token" value="{{csrf_token()}}">
        <h3>Listagem Organização</h3>
        

        <div class="container-fluid col-sm-12 form-group">
            <div class="table-responsive">

               
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
                            
                            <script src="{{ asset('vendor/meeting/javascripts/script-admin-meeting.js') }}"></script>

                           

                            @foreach( $organizacoes as $organizacao )
                                @if($organizacao->id > 1)

                                    @if( ! $organizacao->meeting_confirmed )
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
                                            @endif

                                            
                                        </td>

                                        <td style="width:12px">
                                            <div class="btn-group">



                                            @foreach($permissoes as $permissao)

                                                    @if( ( $permissao->nome == 'super_admin' || $permissao->permissoes->contains('nome', 'confirmar_organizacao') ) && ! $organizacao->meeting_confirmed)
                                                
                                                    <a class="btn btn-default" onclick="autorizarOrganizacao('{{$organizacao->id}}', '', '{{$organizacao->fantasia}}', `{{route('admin/autorizar-organizacao')}}`)" href="#">
                                                        <i class="fas fa-check-square"></i>
                                                    </a>
                                                    @endif

                                                     @if($permissao->permissoes->contains('nome', 'update_organizacao') || $permissao->nome == 'super_admin')
                                                
                                                    <a class="btn btn-default"  href="#">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    @endif

                                                @endforeach



                                            
                                                <button class="btn  btn-default btn-xs">
                                                    <i class="fa  fa-trash"></i>
                                                </button>
                                            </div>
                					    </td>
                                    </tr>
                                    
                                   
                                @endif
                            @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
          
                
        </form>
    </div>

@endsection