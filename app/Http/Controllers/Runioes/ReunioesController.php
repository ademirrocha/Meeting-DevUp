<?php

namespace App\Http\Controllers\Runioes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Reunioes;
use App\Models\Localizacao;
use App\Models\UsersReuniao;
use App\Models\Organizacao;
use App\Models\Ata;
use App\User;
use App\Notifications\ReuniaoNotify;
use App\Notifications\meetingNotify;

use Illuminate\Support\Facades\DB;

class ReunioesController extends Controller
{
    


    public function showReunioes(){

        $permissoes = auth()->user()->rolesUser();

        $reunioes = Reunioes::where('organizacao_id', auth()->user()->organizacao_id)->orderBy('data_inicio', 'asc')->get();

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

        $usuarios_em_outra_reuniao = '';

        $msgs = array();

        


        if($dataIni >= $dataFim || $dataIni < date('Y-m-d H:s:i') || $request->localizacao == 'Selecione um local' || $request->participantes == null || $request->pauta[0] == null){
            $erro = array();

            if($dataIni >= $dataFim){
                $erro['data_error'] = 'A data de inicio nao pode ser apos ou igual a data de término!';
            }

            if($dataIni < date('Y-m-d H:s:i')){
                $erro['data_error'] = 'A data de inicio e hora nao pode ser antes desse momento!';
            }

            if($request->localizacao == 'Selecione um local'){

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


        $existsReunioes = $this->reunioesExistentes($request);

        
        $inReuniao = $this->inReuniaoExistente($existsReunioes, null);

        $facilitadorInConvocacao = $inReuniao['facilitadorInConvocacao'];
        $facilitadorInConvite = $inReuniao['facilitadorInConvite'];
        $facilitadorPossuiReunião = $inReuniao['facilitadorPossuiReunião'];
        

        

        if( ! $facilitadorInConvocacao && ! $facilitadorPossuiReunião ){
        

            $create = Reunioes::create([
                'organizacao_id' => auth()->user()->organizacao_id,
                'user_id' => auth()->user()->id,
                'title' => $request->title,
                'tipo' => $request->tipo,
                'localizacao_id' => $request->localizacao,
                'data_inicio' => $dataIni,
                'data_fim' => $dataFim,
            ]);

        }else{
            if($facilitadorInConvocacao)
                $msgs['you_in_convocacao'] = 'Você estava convocado para outra reunião neste horário!';

            if($facilitadorPossuiReunião)
                $msgs['you_in_convocacao'] = 'Você já havia criado outra reunião para este horário!';

            $msgs['having_outras_reunioes'] = '';

            return redirect()->back()->with('error', 'Não foi possível agendar a reunião.')->with($msgs);
        }


        

            $order = Reunioes::find(Reunioes::max('id'))->id;

           
           

            //Cadastra As Pautas
            foreach ($request->pauta as $key => $value) {
                DB::table('pautas')->insert([
                    ['reuniao_id' => $order, 'nome' => $value]
                ]);
            }

            $reuniao_criada = Reunioes::with('local')->find($order);

            $pautas = Reunioes::pautas($order);


             auth()->user()->notify(new ReuniaoNotify($reuniao_criada, $pautas, auth()->user()->id));



             

            foreach ($request->participantes as $participante) {

                $userConvocado = false;
                $userConvidadoGeral = false;
                $userConvidado = false;


                if(count($existsReunioes) >= 1){

                    foreach ($existsReunioes as $reuniao) {



                        foreach ($reuniao->participantes as $particips) {

                            if($request->tipo == 'Convocação Geral'){
                                if($participante != $reuniao->user_id){
                                    UsersReuniao::where('reuniao_id', $reuniao->id)->where('user_id', $participante)->delete();
                                }
                            
                            }else{

                                if( $particips->user_id == $participante ){
                                    if($reuniao->tipo == 'Convite' || $reuniao->tipo == 'Convite Geral' ){
                                        if($request->tipo == 'Convocação'){
                                            if($participante != $reuniao->user_id){
                                                UsersReuniao::where('reuniao_id', $reuniao->id)->where('user_id', $participante)->delete();
                                            }
                                        }
                                        $userConvidado = true;
                                    }else if($reuniao->tipo == 'Convocação'){
                                        $userConvocado = true;
                                    }else{
                                        $userConvidadoGeral = true;
                                    }
                                }
                            }
                    
                        }



                    }


                    if($request->tipo == 'Convocação Geral'){
                        $create = UsersReuniao::create([
                            'reuniao_id' => $order,
                            'confimou_presenca' => 1,
                            'user_id' => $participante,
                            ]);

                        $u_r = User::find($participante);
                        $u_r->notify(new ReuniaoNotify($reuniao_criada, $pautas, $value));

                    }else if($request->tipo == 'Convocação' && ! $userConvidado){
                        $create = UsersReuniao::create([
                            'reuniao_id' => $order,
                            'confimou_presenca' => 1,
                            'user_id' => $participante,
                            
                            ]);

                            $u_r = User::find($participante);
                            
                            $u_r->notify(new ReuniaoNotify($reuniao_criada, $pautas, $value));

                    }else{
                        if( ! $userConvidadoGeral && ! $userConvidado ){
                            $create = UsersReuniao::create([
                            'reuniao_id' => $order,
                            'confimou_presenca' => 0,
                            'user_id' => $participante,
                            ]);

                            $u_r = User::find($participante);
                            
                            $u_r->notify(new ReuniaoNotify($reuniao_criada, $pautas, $value));
                        }
                    }

                               

                    if($request->tipo == 'Convocação Geral' || ($request->tipo == 'Convocação' && ($reuniao->tipo == 'Convite' || $reuniao->tipo == 'Convite Geral') ) ){

                        $msgs['usuarios_em_outra_reuniao'] = 'Há usuário que não foi adicionado, porque já estava participando de outra reunião!';
                    }

                    
                }else{
                    $create = UsersReuniao::create([
                        'reuniao_id' => $order,
                        'confimou_presenca' => 0,
                        'user_id' => $participante,
                        ]);
                    
                }

            }


             //Cadastra o facilitador

            if($facilitadorInConvite){


                foreach ($existsReunioes as $reuniao) {
                     

                            UsersReuniao::where('reuniao_id', '=', $reuniao->id)->where('user_id', '=', auth()->user()->id )->delete();
                        
                    

                }
                $msgs['you_in_convite'] = 'Você estava convidado para outras reuniões, mas foi retirado!';

            }

            $newConvite = UsersReuniao::create([
                'reuniao_id' => $order,
                'user_id' => auth()->user()->id,
                'confimou_presenca' => 1,
                
                ]);



            if($request->tipo == 'Convocação Geral' && count($existsReunioes) >= 1){

                $this->solicitarMudancaHorario($request);

                $msgs['having_outras_reunioes'] =  'Havia outras reuniões marcadas para este horário, mas foi solicitado a mudança do horário!';
                        
            }

                

        
        

           

            return redirect()->back()->with('sucesso', 'Reunião agendada com sucesso.')->with($msgs);

        
    }


    public function userInReuniao($existsReunioes, $reuniao = null, $participante){
        $userConvocado = false;
        $userConvocadoGeral = false;
        $userConvidadoGeral = false;
        $userConvidado = false;

        $usuarios_deletados = '';



        foreach ($existsReunioes as $usersReuniao) {

            if($reuniao->id != $usersReuniao->id ){

                foreach ($usersReuniao->participantes as  $particips) {



                    if($reuniao->tipo == 'Convocação Geral'){
                        $particips->delete();
                        $usuarios_deletados = 'Há usuários que podem ter sido retirados, porque já estava participando de outra reunião!';
                    }else if($reuniao->tipo == 'Convocação'){
                        if($usersReuniao->tipo == 'Convite' || $usersReuniao->tipo == 'Convite Geral'){
                            $particips->delete();

                            $usuarios_deletados = 'Há usuários que podem ter sido retirados, pois já estava participando de outra reunião!';
                        }
                    }

                    
                    if($participante == $particips->user_id){
                        if($usersReuniao->tipo == 'Convocação'){
                            $userConvocado = true;
                        }
                        if($usersReuniao->tipo == 'Convocação Geral'){

                            $userConvocadoGeral = true;
                        }
                        if($usersReuniao->tipo == 'Convite'){
                            $userConvidado = true;
                        }
                        if($usersReuniao->tipo == 'Convite Geral'){
                            $userConvidadoGeral = true;
                        }
                    }
                    
                }
            }

            

        }


         return ([
            'userConvocado' => $userConvocado,
            'userConvocadoGeral' => $userConvocadoGeral,
            'userConvidadoGeral' => $userConvidadoGeral,
            'userConvidado' => $userConvidado,
            'usuarios_deletados' => $usuarios_deletados,
        ]);

    }


    public function inReuniaoExistente($existsReunioes, $reuniao = null){

        

        $facilitadorInConvocacao = false;
        $facilitadorInConvite = false;
        $facilitadorPossuiReunião = false;

        if(count($existsReunioes) >= 1){

            
            foreach ($existsReunioes as $key => $value) { 
                if($reuniao == null){

                      if($value->user_id == auth()->user()->id){
                            $facilitadorPossuiReunião = true;
                        } 

                          
                        foreach ($value->participantes as $participante) {
                            if($participante->user_id == auth()->user()->id){
                                if($value->tipo == 'Convocação Geral' || $value->tipo == 'Convocação'){
                                    $facilitadorInConvocacao = true;
                                }else{
                                    $facilitadorInConvite = true;
                                }
                            }
                        }




                       if($value->tipo == 'Convocação Geral'){

                            
                            
                                return redirect()->back()->with('error', 'Não foi possível agendar a reunião. Pois já existe uma reunião do tipo Convocação Geral nesse mesmo horário!');
                            
                            

                        

                    }
                }else{
                    if($reuniao->id != $value->id ){

                        if($value->user_id == auth()->user()->id){
                            $facilitadorPossuiReunião = true;
                        } 

                          
                        foreach ($value->participantes as $participante) {
                            if($participante->user_id == auth()->user()->id){
                                if($value->tipo == 'Convocação Geral' || $value->tipo == 'Convocação'){
                                    $facilitadorInConvocacao = true;
                                }else{
                                    $facilitadorInConvite = true;
                                }
                            }
                        }




                       if($value->tipo == 'Convocação Geral'){

                            
                            
                                return redirect()->back()->with('error', 'Não foi possível agendar a reunião. Pois já existe uma reunião do tipo Convocação Geral nesse mesmo horário!');
                            
                            

                        }

                    }

                }


            }
        }


        return ([
            'facilitadorInConvocacao' => $facilitadorInConvocacao,
            'facilitadorInConvite' => $facilitadorInConvite,
            'facilitadorPossuiReunião' => $facilitadorPossuiReunião,
        ]);

    }



    public function showReuniao($id){



        $reuniao = Reunioes::with('local')->find($id);

        if($reuniao != null){
            if($reuniao->organizacao_id != auth()->user()->organizacao_id){
                return redirect()->back();
            }

            $pessoas = UsersReuniao::where('reuniao_id', $reuniao->id)->get();

            $funcionarios = User::where('organizacao_id', auth()->user()->organizacao_id)->get();

            $pautas = Reunioes::pautas($reuniao->id);

            $presente = false;

            foreach ($pessoas as  $pessoa) {
                if($pessoa->presente && $pessoa->user_id == auth()->user()->id){
                    $presente = true;
                }
            }

            if( $reuniao->user_id == auth()->user()->id){
                $presente = true;

                $ru = UsersReuniao::where('reuniao_id', $reuniao->id)->where('user_id', auth()->user()->id )->get();
                $ru[0]->presente = 1;
                $ru[0]->save();

            }
            

             if($reuniao->data_inicio < date('Y-m-d H:i:s') && $presente ){
                    return redirect("reuniao/$reuniao->id/ata");
                }





            if($reuniao->user_id == auth()->user()->id){

                $localizacoes = Localizacao::where('organizacao_id', auth()->user()->organizacao_id)->get();


                
                return view('vendor.meeting.reunioes.cadastro', compact('reuniao', 'pessoas', 'localizacoes', 'funcionarios', 'pautas'));

            }else{
                return view('vendor.meeting.reunioes.reuniao', compact('reuniao', 'pessoas', 'pautas'));
            }
            

       }else{
            return redirect()->back();
       }

    }


    public function editarReuniao(Request $request){

        $reuniao = Reunioes::find($request->reuniao);

        if( $reuniao->user_id == auth()->user()->id ){

            $dataIni = ($request->data_ini. ' '. $request->hora_ini.':00');
            $dataFim = ($request->data_fim. ' '. $request->hora_fim.':00');

            if($dataIni >= $dataFim || $dataIni < date('Y-m-d H:s:i') || $request->localizacao == 'Selecione um local' || $request->participantes == null || $request->pauta[0] == null){
                $erro = array();

                if($dataIni >= $dataFim){
                    $erro['data_error'] = 'A data de inicio nao pode ser apos ou igual a data de término!';
                }

                if($dataIni < date('Y-m-d H:s:i')){
                    $erro['data_error'] = 'A data de inicio e hora nao pode ser antes desse momento!';
                }

                if($request->localizacao == 'Selecione um local'){

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

            $msgs = array();

            $existsReunioes = $this->reunioesExistentes($request);

        
            $inReuniao = $this->inReuniaoExistente($existsReunioes, $reuniao);



            $facilitadorInConvocacao = $inReuniao['facilitadorInConvocacao'];
            $facilitadorInConvite = $inReuniao['facilitadorInConvite'];
            $facilitadorPossuiReunião = $inReuniao['facilitadorPossuiReunião'];
            

        

            if( ! $facilitadorInConvocacao && ! $facilitadorPossuiReunião ){
        

                $reuniao->title = $request->title;
                $reuniao->tipo = $request->tipo;
                $reuniao->localizacao_id = $request->localizacao;
                $reuniao->data_inicio = $dataIni;
                $reuniao->data_fim = $dataFim;

                $saved = $reuniao->save();


            }else{
                if($facilitadorInConvocacao)
                    $msgs['you_in_convocacao'] = ' Você estava convocado para outra reunião neste horário!';

                if($facilitadorPossuiReunião)
                    $msgs['you_in_convocacao'] = ' Você já havia criado outra reunião para este horário!';

                $msgs['having_outras_reunioes'] = '';

                return redirect()->back()->with('error', 'Não foi possível salvar as alterações.')->with($msgs);
            }

            

        


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

            $confimou_presenca = 0;
            if( $reuniao->tipo == 'Convocação' || $reuniao->tipo == 'Convocação Geral' ){
                $confimou_presenca = 1;
            }
        
        
            foreach ($request->participantes as  $participante) {

                if(count($existsReunioes) >= 1){


                    $userInReuniao = $this->userInReuniao($existsReunioes, $reuniao, $participante);

                   



                    $userConvocado = $userInReuniao['userConvocado'];
                    $userConvocadoGeral = $userInReuniao['userConvocadoGeral'];
                    $userConvidadoGeral = $userInReuniao['userConvidadoGeral'];
                    $userConvidado = $userInReuniao['userConvidado'];
                    
                    $usuarios_deletados = $userInReuniao['usuarios_deletados'];

                    if($usuarios_deletados != ''){
                        $msgs['usuarios_deletados'] = $usuarios_deletados;
                    }

                    $in = UsersReuniao::where('user_id', $participante)->where('reuniao_id', $reuniao->id)->exists();

                    if( ! $userConvocado && ! $userConvocadoGeral && ! $userConvidadoGeral && ! $userConvidado ){
                        if(! $in){
                            $newConvite = UsersReuniao::create([
                                'reuniao_id' => $reuniao->id,
                                'user_id' => $participante,
                                'confimou_presenca' => $confimou_presenca,
                                
                            ]);
                        }
                        

                    }else{

                        $msgs['usuarios_em_outra_reuniao'] = "Alguns usuários podem não terem sido adicionados!";

                        if($in){
                            $delete = UsersReuniao::where('user_id', $participante)->where('reuniao_id', $reuniao->id)->delete();
                            
                                $msgs['usuarios_deletados'] = 'Há usuários que podem terem sido retirados, pois estavam em outra reunião!';
                            
                        }


                        if($reuniao->tipo == 'Convocação' || $reuniao->tipo == 'Convocação Geral' ){

                            if(! $inReuniao){
                                $newConvite = UsersReuniao::create([
                                    'reuniao_id' => $reuniao->id,
                                    'user_id' => $participante,
                                    'confimou_presenca' => $confimou_presenca,
                                    
                                ]);
                            }

                        

                            
                        }


                    }


                }else{


                    $newConvite = UsersReuniao::create([
                        'reuniao_id' => $reuniao->id,
                        'user_id' => $participante,
                        'confimou_presenca' => $confimou_presenca,
                        
                    ]);

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


            if($saved){
                return redirect()
                ->back()
                ->with('sucesso', 'Reunião atualizada com sucesso!')
                ->with($msgs);
        
            }else{
                return redirect()->back()->with('error', 'Não foi possível salvar as alterações!')->with($msgs);
            }
        }else{
            return redirect()->back();
        }
            
    }


    public function showAta($id){

        $reuniao = Reunioes::find($id);


        if($reuniao == null || $reuniao->organizacao_id != auth()->user()->organizacao_id){
                return redirect()->back();
            }



            $pautas = Reunioes::pautas($reuniao->id);

            $pessoas = UsersReuniao::where('reuniao_id', $reuniao->id)
                ->join('users', 'users.id', '=', 'users_reuniao.user_id')
                ->orderBy('users.nome', 'asc')
                    ->get();



            if($reuniao->user_id == auth()->user()->id){

                if( ! Ata::where('reuniao_id', $id)->exists()){
                    Ata::create([
                        'reuniao_id' => $id,
                    ]); 
                }

                //$ata = $reuniao->ata;

                

               
                return view('vendor.meeting.reunioes.ata-edite', compact('reuniao', 'pautas', 'pessoas'));
            }else{

                foreach ($pessoas as  $pessoa) {
                    if( ! $pessoa->presente && $pessoa->user_id == auth()->user()->id){
                        return redirect("reuniao/$reuniao->id/view");
                    }
                }

                return view('vendor.meeting.reunioes.ata', compact('reuniao', 'pautas', 'pessoas'));

            }

        
    }


    public function confirmarPresenca($reuniao, $usuario){

        if(auth()->user() == null){
            return redirect('login');
        }

        if( $usuario != auth()->user()->id ){
            return redirect()->back();
        }

        $user_reuniao = UsersReuniao::where('reuniao_id', $reuniao)->where('user_id', $usuario)->get();

        $user_reuniao[0]->confimou_presenca = 1;

        $save = $user_reuniao[0]->save();

        if ($save) {
            return redirect("reuniao/$reuniao/view")->with('sucesso', 'Você confimou Presença Nessa Reunião!');
        }else{
            return redirect("reuniao/$reuniao/view")->with('error', 'Não foi possível confirmar sua Presença!');
        }

        
    }


    public function atualizaAta(Request $request, $id){

        $reuniao = Reunioes::find($id);

        if($reuniao->user_id == auth()->user()->id){

            if($request->participantes != null){

                $user_reuniao = UsersReuniao::where('reuniao_id', $id)->get();


            
                foreach($request->participantes as $participante){

                    foreach ($user_reuniao as $user) {

                        if($participante == $user->user_id){
                            if($user->presente == 0){
                                $user->presente = 1;
                                $user->save();
                            }
                            
                        }
                    }

                    
                }

                foreach ($user_reuniao as $user) {
                    $continua = false;
                    foreach($request->participantes as $participante){
                        if($user->user_id ==  $participante){
                            $continua = true;
                        }
                    }

                    if( ! $continua){
                        $user->presente = 0;
                        $user->save();
                    }
                }


            }
        
            
        
        

        

            $ata = Ata::where('reuniao_id', $id)->get();


            $ata[0]->ata = $request->ata;

            $ata[0]->save();

        

            
        }else{
            return ('false');
        }

        return ('true');
    }


    public function reunioesExistentes($request){



        $dataIni = ($request->data_ini. ' '. $request->hora_ini.':00');
        $dataFim = ($request->data_fim. ' '. $request->hora_fim.':00');

            $reunioes = Reunioes::with('participantes')->where('data_inicio', '>=', $dataIni)->where('data_fim', '<', $dataFim)
                ->orWhere('data_inicio', '>=', $dataIni)->where('data_inicio', '<', $dataFim)->where('data_fim', '>=', $dataFim)
                ->orWhere('data_inicio', '<', $dataIni)->where('data_fim', '>=', $dataIni)->where('data_fim', '<', $dataFim)
                ->orWhere('data_inicio', '<', $dataIni)->where('data_fim', '>=', $dataIni)->get();
        

            return $reunioes;
        

        

        
        

    }




   

    public function solicitarMudancaHorario($request){
        $dataIni = ($request->data_ini. ' '. $request->hora_ini.':00');
        $dataFim = ($request->data_fim. ' '. $request->hora_fim.':00');

        $reunioes = Reunioes::where('data_inicio', '>=', $dataIni)->where('data_fim', '<', $dataFim)
                ->orWhere('data_inicio', '>=', $dataIni)->where('data_inicio', '<', $dataFim)->where('data_fim', '>=', $dataFim)
                ->orWhere('data_inicio', '<', $dataIni)->where('data_fim', '>=', $dataIni)->where('data_fim', '<', $dataFim)
                ->orWhere('data_inicio', '<', $dataIni)->where('data_fim', '>=', $dataIni)->get();

        $this->criaNotifyMudancaHorario($reunioes);

    }

    public function criaNotifyMudancaHorario($reunioes){
         foreach ($reunioes as $reuniao) {

            if( $reuniao->tipo != 'Convocação Geral' ){

                $create = meetingNotify::create([
                    'user_id' => $reuniao->user_id,
                    'user_autor_id' => auth()->user()->id,
                    'title' => 'Solicitação de mudança de horário de reunião',
                    'texto' => 'O usuário '. auth()->user()->nome . ' solicita a mudança de horário de sua reunião: '. $reuniao->title. ', pois foi mardada uma reunião do tipo Convocação Geral para este horário.',

                    'table_references' => 'reunioes',
                    'table_references_id' => $reuniao->id,
                ]);
            }

        }
    }


    public function adiarEncerramento($id, Request $request){
        $reuniao = Reunioes::find($id);

        if($reuniao->organizacao_id != auth()->user()->organizacao_id || $reuniao->encerrada){
            return redirect()->back();
        }

        $dataFim = ($request->data_fim. ' '. $request->hora_fim.':00');


        $reuniao->data_fim = $dataFim;
        $reuniao->save();



        return redirect()->back();
        
    }


    public function buscaAutoAta($request){

        $reuniao = Reunioes::with('ata')->find($request);

        $user = UsersReuniao::where('reuniao_id', $reuniao->id)->where('user_id', auth()->user()->id)->get();




        if($reuniao->organizacao_id != auth()->user()->organizacao_id ){
            return redirect()->back();
        }


         if( $user[0]->presente ){
            return  ($reuniao); 
        }

        return false;

        

    }


}
