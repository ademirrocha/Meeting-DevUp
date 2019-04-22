@extends('vendor/meeting/templates/template')

@section('content')


    <div class="container-fluid">
        
            
            
            @auth
                <form method="post" action="{{route('acount/edit')}}" enctype="multipart/form-data">
                <h3>Editar Dados do Usuário</h3>
            
            @endauth
            @guest
                <form id="frm" method="POST" action="{{ route('register') }}">
                <h3>Cadastro de Usuário</h3>
            @endguest

            @csrf
           
            <div class="row">

               @auth
                    <div class="col-sm-12 form-group center">
                        @if(Auth::user()->imagem == null)
                            <?php $image = 'perfil.png'; ?>
                        @else
                            <?php $image = Auth::user()->imagem; ?>
                        @endif

                        <label for="imagem" class="btn" id="forImg">
                                <img id="imgUser" alt="Clique para alterar a imagem" src="{{ asset('storage/users/'.auth()->user()->imagem) }}" class="imagem-usuario-acount ">
                            </label>

                             <input id="imagem" type="file" style="visibility:hidden;" name="imagem" ><br>

                        <br>Clique na Imagem Para Alterar 
                       
                    </div>
               @endauth

               

                 <div class="col-sm-6 form-group">

                    <label for="nome" class="control-label">Nome</label>
                    
                    <input id="nome" name="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"value="{{Auth::user()->nome ?? old('name')}}" required autocomplete="name" autofocus/>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-sm-6 form-group">
                    <label for="email">Email</label>

                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" aria-describedby="emailHelp"  name="email" value="{{Auth::user()->email ?? old('email') }}" required autocomplete="email">

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-sm-3  form-group">
                    <label for="fone"  class="control-label">Telefone</label>
                    <input id="fone" name="telefone" type="text" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}" value="{{Auth::user()->telefone ?? old('telefone') }}" required autocomplete="email"/>

                    @if ($errors->has('telefone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('telefone') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-sm-3  form-group">
                    <label for="cpf" class="control-label">CPF</label>
                    <input id="cpf" name="cpf"   type="text" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" value="{{Auth::user()->cpf ?? old('cpf') }}"  required autocomplete="cpf"/>
                    @if ($errors->has('cpf'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cpf') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-3">
                    <label for="inputPassword4">@auth Nova @endauth Senha</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" @guest required @endguest autocomplete="new-password">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-3">
                    <label for="inputPassword5">Repetir Senha</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" @guest required @endguest autocomplete="password-confirm">
                </div>
                
                
                @auth

                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Senha Atual</label>
                        <input id="old_password" type="password" class="form-control{{ session('old_password') ? ' is-invalid' : '' }}" name="old_password" required >



                        @if(session('old_password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ session('old_password') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group col-sm-6 input-lg">
                        <br>Sexo: <br>
                        <?php 
                            $inputMasc = '<input type="radio" name="sexo" value="Masculino">'; 
                            $inputFem = '<input type="radio" name="sexo" value="Feminino">'; 
                        ?>
                        @if(Auth::user()->sexo == 'Masculino')
                           <?php $inputMasc = '<input type="radio" name="sexo" value="Masculino" checked="true">'; ?>
                        @elseif(Auth::user()->sexo == 'Feminino')
                            <?php $inputFem = '<input type="radio" name="sexo" value="Feminino" checked="true">'; ?>
                        @endif

                        <label>Masculino: 
                            <?= $inputMasc; ?>
                        </label>
                        <label>Feminino: 
                            <?= $inputFem; ?>
                        </label>
                    </div>

                @endauth

               
               <div class="col-sm-12 ">
                    <div class=" col-sm-6 form-group ">
                        <button class="btn col-sm-12 btn-primary" type="submit">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
        @guest
            <div class="aw-simple-panel__footer col-sm-6 center">Já possui cadastro? <a href="{{route('login')}}">Entre qui</a>.</div>
        @endguest
    </div>
@endsection


