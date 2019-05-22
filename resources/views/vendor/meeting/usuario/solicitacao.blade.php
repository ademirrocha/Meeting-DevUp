@extends('vendor/meeting/templates/template')

@section('content')
<div class="container-fluid">
    <form class="form " action="{{route('organizacao/solicitar-participacao')}}"  method="POST">

        <input id="token_page" type="hidden" name="_token" value="{{csrf_token()}}">

        <h3>Solicitação para participar de uma empresa</h3>
       
        <div class="row">
            <div class="col-sm-6 form-group">
                <?php 
                    $organizacoes = App\Models\Organizacao::all(); 
                    $cargos = App\Models\Cargo::all(); 
                ?>

                <label for="organizacao">Organização</label>
                <select class="form-control" id="organizacao" name="organizacao_id">
                    <option>Selecione Uma Organização</option>
                    @foreach( $organizacoes as $organizacao )
                        @if($organizacao->id > 1)
                            <option value="{{$organizacao->id}}">{{$organizacao->fantasia}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 form-group">
                <label for="cargo">Cargo</label>
                <select class="form-control" id="cargo" name="cargo_id">
                    <option>Selecione Um Cargo</option>
                    @foreach( $cargos as $cargo )
                        @if($cargo->id > 1)
                            <option value="{{$cargo->id}}">{{$cargo->cargo}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            
           
            <div class="col-sm-6 form-group">
                <button class="btn  btn-primary" type="submit">Enviar Solicitação</button>
            </div>

            <div class="col-sm-6 form-group">
                <a class="btn  btn-primary" href="#" onclick="newCargo(``, `{{route('cadastrar-cargo')}}` );">Cadastrar Novo Cargo</a>
            </div>

            <div class="col-sm-12 form-group">
                <h6>Caso queira cadastrar sua empresa. Clique no botão abaixo</h6>
            </div>
            <div class="col-sm-12 form-group">
                <a class="btn  btn-info" href="{{ route('organizacao/cadastro')}}">Cadastrar Organização</a>
            </div>
        </div>
    </form>
</div>

@endsection