@auth
	<?php
		$menu = request()->route()->getName();
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

					
				<li class="">

					<a href="{{route('usuarios')}}"><i class="fa  fa-users"></i><span>Usuários</span></a>

				</li>
				@if(Auth::user()->cargo_id == 2)

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
						$menu == 'local/cadastrar' 
					)
						<li class="is-selected">
					@else
						<li>
					@endif
					<a href="{{route('locais')}}"><i class="fa fa-map-marker"></i><span>Locais de Reuniões</span></a>
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
			</ul>
		</nav>
	</aside>

@endauth