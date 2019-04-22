<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Organizacao;

use App\Models\UsersReuniao;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$dadosUser = User::hasOne();

        $organizacaoUser = Organizacao::find(auth()->user()->organizacao_id);




        if($organizacaoUser->fantasia == 'Nenhuma'){
            return redirect()->route('organizacao/solicitar-participacao');
        }else if( auth()->user()->organizacao_confirmed == 0 ){
            return redirect()->route('aguardando-solicitacao');
        }

        $reunioes = UsersReuniao::where('user_id', auth()->user()->id)->get();

        
        
        
        return view('vendor.meeting.usuario.index', compact("organizacaoUser", 'reunioes'));
    }
}
