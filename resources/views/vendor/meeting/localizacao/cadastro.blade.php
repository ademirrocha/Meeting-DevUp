@extends('vendor/meeting/templates/template')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('localizacoes/cadastro') }}"  method="post">
            @csrf
            <h3>Cadastro Localização</h3>
           
            <div class="row">
                 <div class="col-sm-12 form-group">
                    <label for="nome"  class="control-label">Nome da Localização</label>
                    <input id="nome" name="nome" type="text" class="form-control" />
                </div>

                <div class="col-sm-12 form-group">
                    <button class="btn  btn-primary" type="submit">Salvar</button>
                </div>
            </div>
        </form>
    </div>

@endsection