<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;


use App\Models\Organizacao;
use App\Models\Localizacao;
use App\Models\Cargo;
use App\User;

use App\Notifications\meetingNotify;

use Illuminate\Support\Facades\DB;


class UsuariosController extends Controller
{


	function __construct()
	{
		
	}
	

    public function index(){

		return view("vendor.meeting.usuario.index");  
    }

    public function acount(){


        return view("vendor.meeting.usuario.cadastro");
        
    }


    public function showNotificacao($id){

        $notificacao = meetingNotify::find($id);

        if($notificacao->user_id != auth()->user()->id){
            return redirect()->back();
        }


        $objeto = DB::table($notificacao->table_references)->find($notificacao->table_references_id);

        $rota = '';
        $textAction = '';
        if($notificacao->table_references == 'reunioes'){

           $rota = 'reuniao/'.$notificacao->table_references_id.'/view';
           $textAction = 'Ver Reunião';
        }


        $notificacao->read = 1;
        $notificacao->save();

        return view('vendor.meeting.usuario.notificacoes', compact('notificacao', 'rota', 'textAction'));

    }

    


    public function postAcountEdit( Request $request ){

    	$id_user = auth()->user()->id;

    	$dados = $request->all();

        $request->validate([
                    'name' => ['required', 'string', 'max:191'],
                    'email' => ['required', 'string', 'email', 'max:191'],
                    'cpf' => ['required', 'string', 'max:11',],
                    'telefone' => ['required', 'string',  'max:15'],
                ]);

    	if( password_verify($dados['old_password'] , auth()->user()->password)){

    		

		     $user = auth()->user();


            if( $dados['password'] != null){

                $request->validate([
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);

                //return redirect()->back()->with('old_password', 'Senha Invalida');
                

		    	$dados['password'] = Hash::make($dados['password']);
		    }else{
		    	$dados['password'] = Hash::make($dados['old_password']);
		    }

            $dados['nome'] = $dados['name'];

            $dados['imagem'] = $user->imagem;

            if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
                if( $user->imagem ){
                    $nameImg = $user->imagem;
                }else{
                    // dar um nome pra imagem, kebab_case retira caracters especials
                    $nameImg = 'img_perfil_'.kebab_case($user->nome).$user->id;
                }


                $extension = $request->imagem->extension();

                $nameImg = "{$nameImg}.{$extension}";
                $dados['imagem'] = $nameImg;

                $upload = $request->imagem->storeAs('users', $nameImg);

                if(! $upload) 
                    return redirect()
                                ->back()
                                    ->with('error', 'Falha ao Fazer upload da imagem');

            }



		    $update = $user->update($dados);
    		

        	if($update){
        		return redirect()->route("acount");
        	}else{
        		return redirect()->back();
        	}
        
    	}else{

    		return redirect()->back()->with('old_password', 'Senha Inválida!');
    	}
    	
        
	}

    public function setPrefixAdmin(Request $request){
        return redirect()->route('admin/'.$request->route()->uri);
        
    }




    

    public function showUsuarios(Request $request, User $user){



       if( $request->route()->getPrefix() == null && auth()->user()->cargo_id == 2){
            return $this->setPrefixAdmin($request);
       }else if($request->route()->getPrefix() != null && auth()->user()->cargo_id != 2){
            return redirect()->route('usuarios');
       }

       $permissoes = auth()->user()->rolesUser();

       if($permissoes[0]->nome == 'admin' || $permissoes[0]->nome == 'super_admin'){
            $usuarios = User::where('organizacao_id', auth()->user()->organizacao_id)->orderBy('nome', 'asc')->get();
       }else{
            $usuarios = User::where('id', auth()->user()->id)->get();
       }

        return view("vendor.meeting.usuario.listar", compact('usuarios', 'permissoes'));
    }



    public function autorizarUsuario(Request $request){

        $usuario = User::find($request->user);

        $update = false;
        if($usuario->organizacao_id == auth()->user()->organizacao_id){
            $usuario->organizacao_confirmed = 1;
            
            
            $update = $usuario->save();

        }

        if($update){

            DB::table('role_user')->insert([
                 ['user_id' => $usuario->id, 'role_id' => 3],
            ]);
           
            return redirect()->back()->with('sucesso', 'Usuário atualizado com sucesso!');
        }else{
            return redirect()->back()->with('error', 'Não foi possível atualizar o usuário!');
        }
    }

    

    public function showLocalizacoes(){
        

        return view('vendor.meeting.localizacao.listar');
    }

    public function showCadastroLocalizacao(){

        

        return view('vendor.meeting.localizacao.cadastro');
    }


    public function cadastrarLocalizacao(Request $request){

        

        Localizacao::create([
            'organizacao_id' => auth()->user()->organizacao_id,
            'nome' => $request->nome,
        ]);

        
    
        return redirect()->route('locais');

    }




    
}
