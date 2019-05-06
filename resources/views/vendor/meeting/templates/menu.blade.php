@auth
	<?php
		$menu = request()->route()->getName();

		$permissoes = auth()->user()->rolesUser();
	?>



	<aside class="aw-sidebar  js-sidebar">
		<nav class="aw-menu">
			<ul>
				@if(
					$menu == 'home' || 
					$menu == 'solicitar-participacao' ||
					$menu == 'aguardando-solicitacao'
				)
					<li class="is-selected">
				@else
					<li>
				@endif
					<a href="{{route('home')}}"><i class="fa  fa-home"></i><span>Página Inicial</span></a>
				</li>
				<li>
					<hr>
				</li>
					@if(
						$menu == 'acount' || 
						$menu == 'acount/edit' 
					)
						<li class="is-selected">
					@else
						<li>
					@endif
					<a href="{{route('acount')}}"><i class="fa  fa-user"></i><span>Minha Conta</span></a>
				</li>

					
				@if(
						$menu == 'admin/usuarios' 
					)
						<li class="is-selected">
					@else
						<li>
					@endif

					<a href="{{route('usuarios')}}"><i class="fa  fa-users"></i><span>Usuários</span></a>

				</li>
				

				@if( $permissoes[0]->nome == 'admin' || $permissoes[0]->nome == 'super_admin')

					@if(
						$menu == 'admin/organizacoes' 
					)
						<li class="is-selected">
					@else
						<li>
					@endif

					
						<a href="{{route('admin/organizacoes')}}"><i class="fa  fa-briefcase"></i>
						<span> 
						@if(Auth::user()->organizacao_id == 2)
							Organizações 
						@else
							Organização
						@endif
						</span></a>
					

					</li>
				@endif

					@if( 
						$menu == 'locais' ||
						$menu == 'locais/cadastrar' 
					)
						<li class="is-selected">
					@else
						<li>
					@endif
					<a href="{{url('locais')}}"><i class="fa fa-map-marker"></i><span>Locais de Reuniões</span></a>
				</li>
				@if( 
					$menu == 'reunioes' ||
					$menu == 'reunioes/cadastrar' 
				)
					<li class="is-selected">
				@else
					<li>
				@endif
					<a href="{{route('reunioes')}}"><i class="fa fa-user-circle"></i><span>Gerenciar Reuniões</span></a>
				</li>

				@can('super_admin')
					@if( 
						$menu == 'permissions'
					)
						<li class="is-selected">
					@else
						<li>
					@endif
						<a href="{{route('permissions')}}"><i class="fa fa-user-circle"></i><span>Permissões de usuários</span></a>
					</li>
				@endcan


				<li>
					<hr>
				</li>
				<li>
				<a class="aw-sair" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Sair</a>
				</li>


			</ul>

		</nav>


	</aside>

@endauth