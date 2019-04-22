<?php



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', function () {
    return view('welcome');
})->name('/');

//Route::get('/', 'HomeController@index')->name('/');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['middleware', ['auth'], 'namespace' => 'Usuarios'], function(){
	
	Route::get('/acount', 'UsuariosController@acount')->name('acount');
	Route::get('acount/edit', 'UsuariosController@acountEdit')->name('acount/edit');
	Route::post('acount/edit', 'UsuariosController@postAcountEdit')->name('acount/edit');

	Route::get('usuarios', 'UsuariosController@showUsuarios')->name('usuarios');

	Route::get('localizacoes', 'UsuariosController@showLocalizacoes')->name('localizacoes');

	Route::get('localizacoes/cadastrar', 'UsuariosController@showCadastroLocalizacao')->name('localizacoes/cadastrar');

	Route::POST('localizacoes/cadastro', 'UsuariosController@cadastrarLocalizacao')->name('localizacoes/cadastro');



});


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
	Route::POST('reunioes/cadastro', 'ReunioesController@cadastrarReuniao')->name('reunioes/cadastro');
	
});


Route::group(['middleware', ['auth'], 'namespace' => 'Usuarios' , 'prefix' => 'admin' ], function(){
	
	Route::get('usuarios', 'UsuariosController@showUsuarios')->name('admin/usuarios');
	
	Route::POST('autorizar-usuario', 'UsuariosController@autorizarUsuario')->name('autorizar-usuario');

});


Route::POST('cadastrar-cargo', 'Controller@cadastrarCargo')->name('cadastrar-cargo');



