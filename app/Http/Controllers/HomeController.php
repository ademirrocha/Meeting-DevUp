<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Organizacao;

use App\Models\UsersReuniao;

use Calendar;

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
        
        $organizacaoUser = Organizacao::find(auth()->user()->organizacao_id);

        if($organizacaoUser->fantasia == 'Nenhuma'){
            return redirect()->route('organizacao/solicitar-participacao');
        }else if( auth()->user()->organizacao_confirmed == 0 ){
            return redirect()->route('aguardando-solicitacao');
        }

       
        $reunioes = Organizacao::with('reunioes')->where('id', auth()->user()->organizacao_id)->get();

        

        
        $event_list = [];
        foreach ($reunioes[0]->reunioes as $key => $event) {
            //dd($event->data_inicio);
            $event_list[] = Calendar::event(
                $event->title,
                false,
                $event->data_inicio,
                $event->data_inicio,
                $event->id,
                [
                    'url' => 'reuniao/'.$event->id.'/view',
                    //'color' => '#800', //mudar a cor
                ]

            );

        }
        $calendar_details = Calendar::addEvents($event_list);
       



        return view('vendor.meeting.usuario.index', compact("organizacaoUser", 'reunioes', 'calendar_details'));
    }




    public function addEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
 
        if ($validator->fails()) {
            \Session::flash('warnning','Please enter the valid details');
            return Redirect::to('/events')->withInput()->withErrors($validator);
        }
 
        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->save();
 
        \Session::flash('success','Event added successfully.');
        return Redirect::to('/events');
    }


}
