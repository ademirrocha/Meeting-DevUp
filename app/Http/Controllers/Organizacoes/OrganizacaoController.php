<?php

namespace App\Http\Controllers\Organizacoes;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Organizacao;

class OrganizacaoController extends Controller
{
    private $organizacao;
    private $user;

    

	function __construct(Organizacao $organizacao, User $user)
	{
		$this->organizacao = $organizacao;
        $this->user = $user;
	}


    public function showAguardandoOrganizacao(){
        if(User::registeredOk()){
            return redirect()->route('home');
        }
        return view("vendor.meeting.usuario.aguardando-solicitacao");
    }

	public function getSolicitaOrganizacao(){

        if( User::registeredOk()  ){
            return redirect()->route('home');
        }

        return view("vendor.meeting.usuario.solicitacao");
       

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

            $user->save();
   
            return redirect()->route('home');
        }else{
            return redirect()->back();
        }

        
        
    }


    public function showOrganizacoes(){
        if( User::isAdmin() ){
            return view('vendor.meeting.organizacao.listar');
        }else{
            return redirect()->back();
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
            
           $user->save();

        }

        return redirect()->back();

    }



}
