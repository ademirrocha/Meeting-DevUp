@extends('vendor/meeting/templates/template')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('reunioes/cadastro') }}"  method="post">
            @csrf
            <h3>Agendamento de Reunião</h3>
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
            </div>

            
           
            <div class="row">
                 <div class="col-sm-6 form-group">
                    <label for="pauta"  class="control-label">Pauta da Reunião</label>
                    <input id="pauta" name="pauta" type="text" class="form-control" value="{{old('pauta')}}" required autocomplete="pauta"/>
                </div>

                <div class="col-sm-6 form-group">
                    <label for="localizacao"  class="control-label">Localização</label>
                    <select name="localizacao" id="localizacao" class="form-control{{ session('localizacao_error') ? ' is-invalid' : '' }}" >
                        <option value="">Selecione uma localização</option>
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

                <div class="col-sm-6 form-group">
                    <label for="data_ini"  class="control-label">Data de Inicio</label>
                    <input id="data_ini" name="data_ini" type="date" class="form-control{{ session('data_error') ? ' is-invalid' : '' }}" required />
                    <label for="hora_ini"  class="control-label">Hora de Inicio</label>
                    <input id="hora_ini" name="hora_ini" type="time" class="form-control{{ session('data_error') ? ' is-invalid' : '' }}" value="{{date('H:i', strtotime('+5 minute', strtotime(date('H:i'))))}}" required/>

                    @if(session('data_error'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ session('data_error') }}</strong>
                            </span>
                        @endif
                </div>
                
                <div class="col-sm-6 form-group">
                    <label for="data_fim"  class="control-label">Data de Témino</label>
                    <input id="data_fim" name="data_fim" type="date" class="form-control" required/>
                    <label for="hora_fim"  class="control-label">Hora de Témino</label>
                    <input id="hora_fim" name="hora_fim" type="time" class="form-control" value="{{date('H:i', strtotime('+30 minute', strtotime(date('H:i'))))}}" required/>
                </div>

                <div class="col-sm-12 form-group">
                    <button class="btn  btn-primary" type="submit">Salvar</button>

                </div>

               

            </div>
        </form>



@endsection