<?php

namespace App\Http\Controllers\Runioes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Reunioes;
use App\Models\Localizacao;

class ReunioesController extends Controller
{
    


    public function showReunioes(){

    	$reunioes = Reunioes::where('organizacao_id', auth()->user()->organizacao_id)->get();

    	

    	return view('vendor.meeting.reunioes.listar', compact('reunioes'));

    }


    public function showCadastroReuniao(){
    	$localizacoes = Localizacao::where('organizacao_id', auth()->user()->organizacao_id)->get();

    	return view('vendor.meeting.reunioes.cadastro', compact('localizacoes'));
    }




    public function cadastrarReuniao(Request $request){


    	//return dd($request);

    	$dataIni = ($request->data_ini. ' '. $request->hora_ini.':00');
    	$dataFim = ($request->data_fim. ' '. $request->hora_fim.':00');

    	
    		

    	if($dataIni >= $dataFim || $dataIni < date('Y-m-d H:s:i') || $request->localizacao == ''){
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

    		return redirect()->back()->with($erro);

    	}

    	$create = Reunioes::create([
            'organizacao_id' => auth()->user()->organizacao_id,
            'pauta' => $request->pauta,
            'localizacao_id' => $request->localizacao,
            'data_inicio' => $dataIni,
            'data_fim' => $dataIni,
        ]);


    	if($create){
            return redirect()->back()->with('sucesso', 'Reunião agendada com sucesso!');
        }else{
            return redirect()->back()->with('error', 'Não foi possível agendar a reunião!');
        }
    }


}
