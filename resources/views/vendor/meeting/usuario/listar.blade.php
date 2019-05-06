@extends('vendor/meeting/templates/template')

@section('content')
    <div class="container-fluid">
        @section('bread-crumbs')
          <a href="{{url('home')}}">Página Inicial</a>/
          <a href="{{url('admin/usuarios')}}">Usuários</a>
        @endsection
    <form>
        <input id="token_page" type="hidden" name="_token" value="{{csrf_token()}}">
        <h3>Listagem de Usuários</h3>



       

        <div class="container-fluid col-sm-12 form-group">

            @if(session('error'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ session('error') }}</strong>
                </span>
            @endif
            @if(session('sucesso'))
                <span class="valid-feedback" role="alert">
                    <strong>{{ session('sucesso') }}</strong>
                </span>
            @endif

            <div class="table-responsive">
                

                
                <table id="tabela-produtos" class="table  table-striped  table-bordered  table-hover  table-condensed  js-sticky-table">
                    <thead class="aw-table-header-solid">
                        <tr>
                            <th>Nome</th>
                            <th>Cargo</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        
                            
                        
                        @foreach( $usuarios as $usuario )
                            

                            @if( ! $usuario->organizacao_confirmed)
                                <tr style="background: #FF7F24;">
                            @else
                                <tr >
                            @endif
                            
                                <td >{{$usuario->nome}}</td>

                                <?php $cargo = App\Models\Cargo::find($usuario->cargo_id); ?>

                                <td >{{$cargo->cargo}}</td>
                                
                                
                                <td >{{$usuario->email}}</td>
                                <td >
                                    @if( $usuario->organizacao_confirmed )
                                        Membro da Organização
                                    @else
                                        Solicitação Pendente

                                    @endif

                                    
                                </td>
                                <td style="width:12px">
                                     <div class="btn-group">

                                        @foreach($permissoes as $permissao)

                                            @if($permissao->permissoes->contains('nome', 'confirmar_user') && ! $usuario->organizacao_confirmed)
                                        
                                            <script src="{{ asset('vendor/meeting/javascripts/script-admins.js') }}"></script>
                                            
                                            <a class="btn  btn-default" onclick="autorizarUsuario('{{$usuario->id}}', '{{$usuario->nome}}', `{{route('autorizar-usuario')}}`)" href="#" alt="Autorizar Usuario" title="Autorizar Usuario">
                                                <i class="fas fa-check-square"></i>
                                            </a>
                                            @endif

                                            @if($permissao->permissoes->contains('nome', 'update_user') && auth()->user()->id == $usuario->id)
                                                <a class="btn  btn-default" href="{{route('acount')}}" alt="Visualizar ou editar seus  dados" title="Visualizar ou editar seus  dados">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            @endif





                                        @endforeach

                                   
                                       
                                    </div>
        					    </td>
                            </tr>
                            
                           
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
          
                
        </form>
    </div>

@endsection