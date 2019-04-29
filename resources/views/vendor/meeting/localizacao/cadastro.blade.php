@extends('vendor/meeting/templates/template')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('locais/cadastro') }}"  method="post">
            @csrf
            <h3>Cadastro Locais de Reuniões</h3>
           
            <div class="row">
                 <div class="col-sm-12 form-group">
                    <label for="nome"  class="control-label">Nome do Local</label>
                    <input id="nome" name="nome" type="text" class="form-control" />
                </div>

                <div class="col-sm-12 form-group">
                    <button class="btn  btn-primary" type="submit">
                        <i class="fas fa-save"></i>Salvar
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection