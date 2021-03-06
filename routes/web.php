<?php



Route::get('permissions', 'Config\ConfigController@permissoes')->name('permissions');


Route::POST('permissions/{id}/editar', 'Config\ConfigController@editarPermissoes');






Route::group(['middleware', ['auth'], 'namespace' => 'Usuarios'], function(){
	
	Route::get('/acount', 'UsuariosController@acount')->name('acount');
	Route::post('acount/edit', 'UsuariosController@postAcountEdit')->name('acount/edit');

	Route::get('usuarios', 'UsuariosController@showUsuarios')->name('usuarios');

	Route::get('locais', 'UsuariosController@showLocalizacoes')->name('locais');

	Route::get('locais/cadastrar', 'UsuariosController@showCadastroLocalizacao')->name('locais/cadastrar');

	Route::POST('locais/cadastro', 'UsuariosController@cadastrarLocalizacao')->name('locais/cadastro');


	Route::get('notificacoes/{id}/view', 'UsuariosController@showNotificacao')->name('notificacoes/{id}/view');


	

});

//Rota Gerar Reltórios de Reunioes
Route::get('reunioes/gerar-relatorios', 'Organizacoes\OrganizacaoController@gerarRelatorioReunioes')->name('reunioes/gerar-relatorios');


Route::group(['middleware', ['auth'], 'namespace' => 'Organizacoes' , 'prefix' => 'organizacao' ], function(){

	Route::get('solicitar-participacao', 'OrganizacaoController@getSolicitaOrganizacao')->name('organizacao/solicitar-participacao');

	Route::POST('solicitar-participacao', 'OrganizacaoController@postSolicitaOrganizacao')->name('organizacao/solicitar-participacao');

	Route::get('aguardando-solicitacao', 'OrganizacaoController@showAguardandoOrganizacao')->name('aguardando-solicitacao');


	Route::get('cadastrar-organizacao', 'OrganizacaoController@getCadastrarOrganizacao')->name('organizacao/cadastrao');

	Route::POST('cadastrar-organizacao', 'OrganizacaoController@postCadastrarOrganizacao')->name('organizacao/cadastro');





});

Route::group(['middleware', ['auth'], 'namespace' => 'Organizacoes' , 'prefix' => 'admin' ], function(){
	
	Route::get('organizacoes', 'OrganizacaoController@showOrganizacoes')->name('admin/organizacoes');
	
	Route::POST('autorizar-organizacao', 'OrganizacaoController@AutorizarOrganizacao')->name('admin/autorizar-organizacao');

});






Route::group(['middleware', ['auth'], 'namespace' => 'Runioes' ], function(){
	
	Route::get('reunioes', 'ReunioesController@showReunioes')->name('reunioes');

	Route::get('reunioes/cadastrar', 'ReunioesController@showCadastroReuniao')->name('reunioes/cadastrar');


	Route::get('reunioes/buscarNextReunioes', 'ReunioesController@buscarNextReunioes')->name('reunioes/buscarNextReunioes');




	Route::POST('reunioes/cadastro', 'ReunioesController@cadastrarReuniao')->name('reunioes/cadastro');
	
	Route::POST('reuniao/adicionar-pessoas', 'ReunioesController@adicionarPessoasNaReuniao')->name('reuniao/adicionar-pessoas');

	Route::get('reuniao/{id}/view', 'ReunioesController@showReuniao')->name('reuniao/{id}/view');
	

	Route::POST('reunioes/editar', 'ReunioesController@editarReuniao')->name('reunioes/editar');

	Route::get('reuniao/{id}/ata', 'ReunioesController@showAta')->name('reuniao/{id}/ata');
	
	Route::get('reuniao/{id}/confirmar_presenca/{id2}/confirm', 'ReunioesController@confirmarPresenca')->name('reuniao/{id}/confirmar_presenca/{id2}/confirm');



	Route::POST('reuniao/{id}/ata/salvar', 'ReunioesController@atualizaAta')->name('reuniao/{id}/ata/salvar');

	Route::POST('reuniao/{id}/adiar-encerramento', 'ReunioesController@adiarEncerramento')->name('reuniao/{id}/adiar-encerramento');


	Route::get('reuniao/{id}/buscarAta', 'ReunioesController@buscaAutoAta')->name('reuniao/{id}/buscarAta');

	

	

});


Route::group(['middleware', ['auth'], 'namespace' => 'Usuarios' , 'prefix' => 'admin' ], function(){
	
	Route::get('usuarios', 'UsuariosController@showUsuarios')->name('admin/usuarios');
	
	Route::POST('autorizar-usuario', 'UsuariosController@autorizarUsuario')->name('autorizar-usuario');



});


Route::POST('cadastrar-cargo', 'Controller@cadastrarCargo')->name('cadastrar-cargo');

Auth::routes();




Route::get('/home', 'HomeController@index')->name('home');



Route::get('/', 'HomeController@welcome')->name('/');

