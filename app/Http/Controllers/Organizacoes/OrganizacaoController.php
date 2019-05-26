<?php

namespace App\Http\Controllers\Organizacoes;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Organizacao;
use App\Models\UsersReuniao;

use Gate;

use Illuminate\Support\Facades\DB;

class OrganizacaoController extends Controller
{
    private $organizacao;
    private $user;

    

	function __construct(Organizacao $organizacao, User $user)
	{
		$this->organizacao = $organizacao;
        $this->user = $user;
	}


    public function showAguardandoOrganizacao(User $user){

       
       $permissoes = auth()->user()->rolesUser();

       

        if($permissoes[0]->nome == 'unauthorized' ){
            return view("vendor.meeting.usuario.aguardando-solicitacao");
            
        }else{
            return redirect()->route('home');
        }
            
        
    }

	public function getSolicitaOrganizacao(User $user){

       
        $permissoes = auth()->user()->rolesUser();

        if($permissoes[0]->nome == 'unauthorized' ){
            return view("vendor.meeting.usuario.solicitacao");
            
        }else{
            return redirect()->route('home');
        }

    }


    public function postSolicitaOrganizacao(Request $request){

		$id_user = auth()->user()->id;

    	$dados = $request->all();

       
        $update = auth()->user()->update($dados);

        if ($update) {

            return redirect()->route("home");

         }else{
            return redirect()->back();
         }
    }




    public function getCadastrarOrganizacao(){
    	
       $organizacao =  Organizacao::find(auth()->user()->organizacao_id);

        if($organizacao->fantasia != 'Nenhuma' && auth()->user()->organizacao_confirmed == 1 ){
            return redirect()->route("home");
        }

        return view('vendor.meeting.organizacao.cadastro');

    }


    public function postCadastrarOrganizacao(Request $request){
        

        $dados = $request->all();

        $insert = $this->organizacao->create($dados);

        if ($insert) {

            $order = Organizacao::find(Organizacao::max('id'))->id;

            $user = auth()->user();



            $user->organizacao_id = $order;
            $user->organizacao_confirmed = 0;
            $user->cargo_id = 2;

            $userSave = $user->save();
            

   
            return redirect()->route('home');
        }else{
            return redirect()->back();
        }

        
        
    }


    public function showOrganizacoes(){

        $permissoes = auth()->user()->rolesUser();

        

        if($permissoes[0]->nome == 'unauthorized' ){
            return redirect()->route('home');
        }

        foreach ($permissoes as $permissao) {
            if($permissao->permissoes->contains('nome', 'view_organizacao')){
                $organizacoes = Organizacao::where('id', auth()->user()->organizacao_id)->get();

                return view('vendor.meeting.organizacao.listar', compact('organizacoes', 'permissoes'));


            }
            
        }
        
        
       
        if($permissoes[0]->nome == 'super_admin' ){
            $organizacoes = Organizacao::all();
            return view('vendor.meeting.organizacao.listar', compact('organizacoes', 'permissoes'));

        }else{
            redirect()->route('home');
        }
        
        
    }

    public function AutorizarOrganizacao(Request $request){
        $dados = $request->all();

        $this->organizacao = Organizacao::find($dados['organizacao']);

        $this->organizacao->meeting_confirmed = 1;

        //return dd($organizacao);



        $update = ($this->organizacao)->save();

        
        if($update){

            
            
            $user = User::find($dados['user']);

            $user->organizacao_confirmed = 1;
            
           $salve = $user->save();

           if($salve){
                DB::table('role_user')->insert([
                    ['user_id' => $user->id, 'role_id' => 2],
                ]);
           }

        }

        return redirect()->back();

    }



    public function gerarRelatorioReunioes(){

        $organizacao = Organizacao::find(auth()->user()->organizacao_id);
        
        foreach ($organizacao->users as $user) {
            
            $qtd = 0;

            foreach ($user->reunioes as $reuniao) {

                
                if(UsersReuniao::where('user_id', $user->id)
                        ->where('reuniao_id', $reuniao->id)
                        ->where('presente', 1)
                        ->exists() || $reuniao->user_id == $user->id){
                    $qtd++;
                }

            }

             $user->qtd_participacao = $qtd;


             $user->save();
        }

        $usuarios = User::where('organizacao_id', auth()->user()->organizacao_id)
                        ->with('reunioes')
                        ->orderBy('qtd_participacao', 'asc')
                        ->orderBy('nome', 'asc')
                        ->get();

                

        return view( 'vendor.meeting.reunioes.relatorio', compact('usuarios'));
    }




}
