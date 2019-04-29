@extends('vendor/meeting/templates/template')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/meeting/styles/cadastro-reunioes.css')}}" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    
                
    

    

@endsection

@section('content')

    <div class="container-fluid">
        @if(isset($pessoas))
            <h3>Editar Reunião </h3>
            <form id="formulario" action="{{ route('reunioes/editar') }}"  method="post">
        @else
            <h3>Agendamento de Reunião</h3>
            <form id="formulario" action="{{ route('reunioes/cadastro') }}"  method="post">
        @endif

        
            
            @csrf
            
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
                <div class="col-sm-6 form-group">
                    <label for="pauta"  class="control-label">Título da Reunião</label>
                    <input id="pauta" name="title" type="text" class="form-control" value="{{$reuniao->title ?? old('pauta')}}" required autocomplete="title" autofocus placeholder="Digite o Título da Reunião" />
                </div>

                <div class="col-sm-6 form-group">
                            Tipo de Reunião:

                            <select  name='tipo' class="form-control">
                                @if(isset($reuniao))
                                    <option value="{{$reuniao->tipo}}">
                                        {{$reuniao->tipo}}
                                    </option>
                                @endif
                                <option value="Convite">Convite</option>
                                <option value="Convocação">Convocação</option>
                                <option value="Convite Geral">Convite Geral</option>
                                <option value="Convocação Geral">Convocação Geral</option>
                            </select>
                            
                        </div>

                <div class="col-sm-6 form-group">
                    <label for="localizacao"  class="control-label">Local da Reunião</label>
                    <select name="localizacao" id="localizacao" class="form-control{{ session('localizacao_error') ? ' is-invalid' : '' }}" required>

                        
                        @if(isset($reuniao))
                            <option value="{{$reuniao->local->id}}">
                                {{$reuniao->local->nome}}
                            </option>
                        @else
                            <option >Selecione um local</option>
                        @endif
                        @foreach($localizacoes as $localizacao)
                            <option value="{{$localizacao->id}}">{{$localizacao->nome}}</option>
                        @endforeach
                    </select>
                    @if(session('localizacao_error'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ session('localizacao_error') }}</strong>
                            </span>
                        @endif
                </div>
            </div>
            <div class="row">

                


                

                <div class="col-sm-6 form-group">
                    <label for="data_ini"  class="control-label">Data de Inicio</label>
                    <input id="data_ini" name="data_ini" value="{{date('Y-m-d', strtotime($reuniao->data_inicio))}}" type="date" class="form-control{{ session('data_error') ? ' is-invalid' : '' }}" required />
                    <label for="hora_ini"  class="control-label">Hora de Inicio</label>
                    <input id="hora_ini" name="hora_ini" type="time" class="form-control{{ session('data_error') ? ' is-invalid' : '' }}" value="{{date('H:i', strtotime($reuniao->data_inicio)) ?? date('H:i', strtotime('+5 minute', strtotime(date('H:i'))))}}" required/>

                    @if(session('data_error'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ session('data_error') }}</strong>
                            </span>
                        @endif
                </div>

                
                <div class="col-sm-6 form-group">
                    <label for="data_fim"  class="control-label">Data de Témino</label>
                    <input id="data_fim" value="{{date('Y-m-d', strtotime($reuniao->data_fim))}}" name="data_fim" type="date" class="form-control" required/>
                    <label for="hora_fim"  class="control-label">Hora de Témino</label>
                    <input id="hora_fim" name="hora_fim" type="time" class="form-control" value="{{date('H:i', strtotime($reuniao->data_fim)) ?? date('H:i', strtotime('+30 minute', strtotime(date('H:i'))))}}" required/>
                </div>

                <hr>
            </div>



            <div class="row">



                

                    @if(session('pautas_error'))
                    <div id="area-box-pautas" class="col-sm-6 area-box" style="border-color: red;">
                        <div class="col-sm-12" role="alert" style="color: red;">
                            <strong>{{ session('pautas_error') }}</strong>
                        </div>

                    @else
                    <div id="area-box-pautas" class="col-sm-6 area-box">
                    @endif
                
                    <div class="btn-group btn-mais">
                        <a class="btn  btn-default" onclick="setNewPauta();">
                        <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>
                    <h3>Pautas</h3>
                    <hr>
                @if(isset($reuniao))
                    <?php $i = 0; ?>
                    @foreach($pautas as $pauta)
                        <?php 
                            $i++;
                            $id1 = 'btn_'.$i;
                            $id2 = 'pauta_'.$i;

                        ?>

                        
                        @if($i > 1)
                        <div class="btn-group btn-menos" id="{{$id2}}">
                            <a class="btn  btn-default" onclick="removePauta('{{$id1}}', '{{$id2}}');">
                            <i class="fas fa-minus-circle"></i>
                            </a>
                        </div>
                        @endif

                        <input name="pauta[]" type="text" id="{{$id1}}" class="form-control col-sm-10 input-pauta" value="{{$pauta->nome}}" required autocomplete="pauta" placeholder="Digite a Pauta" autofocus/>';

                        @endforeach

                    @else
                        <input name="pauta[]" type="text" class="form-control col-sm-10 input-pauta" value="" required autocomplete="pauta" placeholder="Digite a Pauta" />
                    @endif
                    

                   
                    
                    <div id="error-pauta"></div>
                </div>

                

                
                    @if(session('participantes_error'))
                    <div class="col-sm-6 area-box" style="border-color: red;">
                        <div class="col-sm-12" role="alert" style="color: red;">
                            <strong>{{ session('participantes_error') }}</strong>
                        </div>

                    @else
                    <div class="col-sm-6 area-box">
                    @endif
                    
                    <h3 >Selecione Participantes</h3>
                    <hr>

                    
                    @foreach($funcionarios as $funcionario)

                    
                        @if($funcionario->id != auth()->user()->id)
                            <div class="col-sm-12 form-group ">
                                <label>

                                    @if($pessoas->contains('user_id', $funcionario->id) )

                                    <input name="participantes[]" type="checkbox" class="" value="{{$funcionario->id}}" checked='true'/>
                                    @else
                                    <input name="participantes[]" type="checkbox" class="" value="{{$funcionario->id}}"/>
                                    @endif

                                    {{$funcionario->nome}}:

                                </label>
                            </div>
                            <hr>
                        @endif
                           
                    @endforeach

                    @if($funcionarios->count() == 1)
                        Nenhum outro Funcionário na Organização
                    @endif

                </div>

                <input type="hidden" name="reuniao" value="{{$reuniao->id}}">

                <div class="col-sm-12 form-group">
                    
                    <button class="btn  btn-primary" type="submit">
                        <i class="fas fa-save"></i>
                        Salvar
                        @if(isset($reuniao))
                         Alterações
                        @endif
                        
                    </button>
                    

                </div>

               

            </div>
        </form>



@endsection