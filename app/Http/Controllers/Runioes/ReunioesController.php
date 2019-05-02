<?php

namespace App\Http\Controllers\Runioes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Reunioes;
use App\Models\Localizacao;
use App\Models\UsersReuniao;
use App\Models\Organizacao;
use App\User;

use Illuminate\Support\Facades\DB;

class ReunioesController extends Controller
{
    


    public function showReunioes(){

        $permissoes = auth()->user()->rolesUser();

    	$reunioes = Reunioes::where('organizacao_id', auth()->user()->organizacao_id)->get();

    	return view('vendor.meeting.reunioes.listar', compact('reunioes', 'permissoes'));

    }


    public function showCadastroReuniao(){
    	$localizacoes = Localizacao::where('organizacao_id', auth()->user()->organizacao_id)->get();

        $funcionarios = User::where('organizacao_id', auth()->user()->organizacao_id)->get();

        

    	return view('vendor.meeting.reunioes.cadastro', compact('localizacoes', 'funcionarios'));
    }




    public function cadastrarReuniao(Request $request){


    	$dataIni = ($request->data_ini. ' '. $request->hora_ini.':00');
    	$dataFim = ($request->data_fim. ' '. $request->hora_fim.':00');

    	
    		

    	if($dataIni >= $dataFim || $dataIni < date('Y-m-d H:s:i') || $request->localizacao == '' || $request->participantes == null || $request->pauta[0] == null){
    		$erro = array();

    		if($dataIni >= $dataFim){
    			$erro['data_error'] = 'A data de inicio nao pode ser apos ou igual a data de término!';
    		}

    		if($dataIni < date('Y-m-d H:s:i')){
    			$erro['data_error'] = 'A data de inicio e hora nao pode ser antes desse momento!';
    		}

    		if($request->localizacao == ''){

    			$erro['localizacao_error'] = 'Selecione uma Localizacao!';
    		}

             if($request->participantes == null){

                $erro['participantes_error'] = 'Selecione pelo menos mais um participante!';
            }

            if($request->pauta[0] == null){

                $erro['pautas_error'] = 'Informe ao menos uma pauta!';
            }

    		return redirect()->back()->with($erro);

    	}

       
    	$create = Reunioes::create([
            'organizacao_id' => auth()->user()->organizacao_id,
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'tipo' => $request->tipo,
            'localizacao_id' => $request->localizacao,
            'data_inicio' => $dataIni,
            'data_fim' => $dataIni,
        ]);


    	if($create){



            $order = Reunioes::find(Reunioes::max('id'))->id;

            //Cadastra o facilitador
            $create = UsersReuniao::create([
                'reuniao_id' => $order,
                'user_id' => auth()->user()->id,
                
                ]);
            //Cadastra As Pautas
            foreach ($request->pauta as $key => $value) {
                DB::table('pautas')->insert([
                    ['reuniao_id' => $order, 'nome' => $value]
                ]);
            }


            foreach ($request->participantes as $key => $value) {
                $create = UsersReuniao::create([
                'reuniao_id' => $order,
                'user_id' => $value,
                
                ]);
            }
            

            


            return redirect()->back()->with('sucesso', 'Reunião agendada com sucesso!');
        }else{
            return redirect()->back()->with('error', 'Não foi possível agendar a reunião!');
        }
    }



    public function showReuniao($id){



        $reuniao = Reunioes::with('local')->find($id);

        if($reuniao != null){
            if($reuniao->organizacao_id != auth()->user()->organizacao_id){
                return redirect()->back();
            }

            $pessoas = UsersReuniao::where('reuniao_id', $reuniao->id)->get();

            

            if($reuniao->user_id == auth()->user()->id){

                $localizacoes = Localizacao::where('organizacao_id', auth()->user()->organizacao_id)->get();

                $funcionarios = User::where('organizacao_id', auth()->user()->organizacao_id)->get();

                $pautas = Reunioes::pautas($reuniao->id);

                


                return view('vendor.meeting.reunioes.cadastro', compact('reuniao', 'pessoas', 'localizacoes', 'funcionarios', 'pautas'));

            }else{
                return view('vendor.meeting.reunioes.reuniao', compact('reuniao', 'pessoas'));
            }
            

       }else{
            return redirect()->back();
       }

    }




    public function adicionarPessoasNaReuniao(Request $request){

        $reuniao = Reunioes::find($request->reuniao);




        if($reuniao != null){
            if($reuniao->organizacao_id != auth()->user()->organizacao_id){
                return redirect()->back();
            }


            //return dd($reuniao->id);

            foreach ($request->pessoa as $key => $p) {

        

            $create = UsersReuniao::create([
                'reuniao_id' => $reuniao->id,
                'user_id' => $p,
                
                
                ]);


            } 
            
         

           return redirect()->route('reuniao');

       }else{
            return redirect()->back();
       }

       
    }



    public function editarReuniao(Request $request){


        
        $reuniao = Reunioes::find($request->reuniao);



        if( $reuniao->user_id == auth()->user()->id ){


           


            $dataIni = ($request->data_ini. ' '. $request->hora_ini.':00');
            $dataFim = ($request->data_fim. ' '. $request->hora_fim.':00');

            
                

            if($dataIni >= $dataFim || $dataIni < date('Y-m-d H:s:i') || $request->localizacao == '' || $request->participantes == null || $request->pauta[0] == null){
                $erro = array();

                if($dataIni >= $dataFim){
                    $erro['data_error'] = 'A data de inicio nao pode ser apos ou igual a data de término!';
                }

                if($dataIni < date('Y-m-d H:s:i')){
                    $erro['data_error'] = 'A data de inicio e hora nao pode ser antes desse momento!';
                }

                if($request->localizacao == ''){

                    $erro['localizacao_error'] = 'Selecione uma Localizacao!';
                }

                if($request->participantes == null){

                    $erro['participantes_error'] = 'Selecione pelo menos mais um participante!';
                }

                if($request->pauta[0] == null){

                    $erro['pautas_error'] = 'Informe ao menos uma pauta!';
                }

                



                return redirect()->back()->with($erro);

            }


            $reuniao->title = $request->title;
            $reuniao->tipo = $request->tipo;
            $reuniao->localizacao_id = $request->localizacao;
            $reuniao->data_inicio = $dataIni;
            $reuniao->data_fim = $dataFim;

           
            $create = $reuniao->save();

            

            if($create){

                $pessoas = UsersReuniao::where('reuniao_id', $reuniao->id)->get();

                foreach ($pessoas as  $value) {
                    if($value->user_id != auth()->user()->id){
                        $continua = false;
                        foreach ($request->participantes as  $p) {
                            if($value->user_id == $p)
                                $continua = true;
                        }
                        if($continua == false){
                            UsersReuniao::where('reuniao_id', '=', $reuniao->id)->where('user_id', '=', $value->user_id)->delete();
                        }
                    }
                }


                
                
                foreach ($request->participantes as  $value) {

                    

                    if($value != auth()->user()->id){

                         $pessoa = UsersReuniao::where('reuniao_id', $reuniao->id)->where('user_id', $value)->exists();

                         if( ! $pessoa){
                            $create = UsersReuniao::create([
                            'reuniao_id' => $reuniao->id,
                            'user_id' => $value,
                            
                            ]);
                         }

                    }
                }


                
                
                //Cadastra As Pautas


                $pautas = DB::table('pautas')->where('reuniao_id', $reuniao->id)->get();

                

                foreach ($pautas as  $value) {

                    foreach ($request->pauta as  $pauta) {
                        $continua = false;
                        if($value->nome == $pauta){
                            $continua = true;
                        }
        
                    }

                    if($continua == false){
                        DB::table('pautas')->where('reuniao_id', '=', $reuniao->id)->where('nome', '=', $value->nome)->delete();
                    }
                }
                


                foreach ($request->pauta as $key => $value) {

                   

                    $pauta = DB::table('pautas')->where('nome', $value)->where('reuniao_id', $reuniao->id)->exists();

                    if(! $pauta){
                        DB::table('pautas')->insert([
                            ['reuniao_id' => $reuniao->id, 'nome' => $value]
                        ]);
                    }


                }



                    



                return redirect()->back()->with('sucesso', 'Reunião atualizada com sucesso!');
            }else{
                return redirect()->back()->with('error', 'Não foi possível atualizar a reunião!');
            }

        }else{
            redirect()->back();
        }

    }



    public function showAta($id){

        $reuniao = Reunioes::find($id);


        if($reuniao == null || $reuniao->organizacao_id != auth()->user()->organizacao_id){
                return redirect()->back();
            }

        return ('Mostrar Ata da reunião '.$reuniao->title);
    }



}
