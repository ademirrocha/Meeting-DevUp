@extends('vendor/meeting/templates/template')

@section('content')
    <div class="container-fluid">
        <form  action="{{ route('organizacao/cadastro') }}"  method="post">
            @csrf

            <h3>Cadastro Organização</h3>
           
            <div class="row">
                 <div class="col-sm-6 form-group">
                    <label for="razaosocial" class="control-label">Razão Social</label>
                    <input id="razaosocial" name="razao_social" type="text" class="form-control" />
                </div>

                <div class="col-sm-6 form-group">
                    <label for="fantasia">Nome Fantasia</label>
                    <input type="text" name="fantasia" class="form-control" id="fantasia" >
                </div>

                <div class="col-sm-6  form-group">
                    <label for="cnpj" class="control-label">CNPJ</label>
                    <input id="cnpj" type="text"  name="cnpj"  class="form-control" />
                </div>

                <div class="col-sm-6 form-group">
                <label for="cargo">Seu Cargo </label>
                <select class="form-control" id="cargo" name="cargo_id">
                    <option value="Gerente/TI">Gerente/TI</option>
                </select>
                (O primeiro cargo da empresa deve ser Gerente/TI, posteriormente poderá mudá-lo!)
            </div>

                <div class="col-sm-12 form-group">
                    <button class="btn  btn-primary" type="submit">Salvar</button>
                </div>
            </div>
        </form>
    </div>

@endsection