@extends('vendor/meeting/templates/template')

@section('content')
    <div class="container-fluid">
    	<h2>Editar Permissões</h2>

		@foreach($roles as $role)

			<br><hr>
			

			<h4>Perfis de Usuários: {{$role->label}}</h4>
			

			<h5>Permissões:</h5>

			@if($role->nome == 'super_admin')
				<br>
				<h6>Todas as Permissões Estão Disponíveis</h6>
			@else
				<form class="form" action="{{ url("permissions/$role->id/editar") }}"  method="post">
					@csrf


					<div class="container-fluid col-sm-12 form-group">
			            <div class="table-responsive">
			                <table id="tabela-produtos" class="table  table-striped  table-bordered  table-hover  table-condensed  js-sticky-table">
			                    <thead class="aw-table-header-solid">
			                        <tr>
			                            <th>Permissão</th>
			                            <th>Disponibilidade</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                        
			                        @foreach($allPermissions as $all)

			                        	
	                            	@if(DB::table('permission_role')
								    	->where('permission_id', '=', $all->id)
								    	->where('role_id', '=', $role->id)->exists()
									)
										<tr style="background: #5d5d5d;">
			                                <td ><b>{{$all->label}}</b></td>

				                            <td>
												<label>Não: <input  type="radio" name="{{$all->nome}}" value="nao" ></label>
												<label>Sim: <input  type="radio" name="{{$all->nome}}" value="sim" checked></label>
											</td>
										</tr>
									@else
										<tr  style="background: #a0a0a0;">
			                                <td ><b>{{$all->label}}</b></td>

				                            <td>
												<label>Não: <input  type="radio" name="{{$all->nome}}" value="nao" checked></label>
												<label>Sim: <input  type="radio" name="{{$all->nome}}" value="sim" ></label>
											</td>
										</tr>
									@endif
											

			                        
			                           

			                        @endforeach
			                        <tr>
			                            <td colspan="6">
			                            	<div class="col-sm-12 form-group">
								                <button class="btn  btn-primary" type="submit">Salvar</button>
								            </div>
			                            </td>
			                        </tr>

			                    </tbody>
			                </table>
			            </div>
			        </div>
								
				</form>
			@endif
			
			

		</div>
		@endforeach
	
@endsection