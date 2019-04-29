@extends('vendor/meeting/templates/template')

@section('css')

	
	
    


@endsection

@section('content')

	<br>

 	<div class="container-fluid">
    <div class="row">
      
      <section class="content left">
        <h2>Calendário de Reuniões</h2>

       		@foreach($reunioes as $reuniao)
       		<?php
       		$detalhe_reuniao = App\Models\Reunioes::find($reuniao->reuniao_id);
       		?>

         
   		      <!-- small box -->
            <div class="small-box bg-aqua ">
              <div class="inner">
                <h3>{{$detalhe_reuniao->pauta}}</h3>
                <p>Data: {{$detalhe_reuniao->data_inicio}}</p>
                
                <p>Local: {{$detalhe_reuniao->local->nome}}</p>


                <p>Facilitador: {{App\User::find($reuniao->user_id)->nome}}</p>
                <p>Tipo de Reunião: {{$detalhe_reuniao->tipo}}</p>
              </div>
              
              <a href="#" onclick="redirectReuniao('{{$reuniao->reuniao_id}}', `{{route('reuniao')}}`)" class="small-box-footer">Mais detalhes <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          
          @endforeach

          @if($reunioes->count() == 0)
            <div class="small-box bg-aqua ">
             
                <div class="inner">
                <p>Não há reuniões marcadas pra você</p>
              </div>
                
              
              
            </div>
          @endif
       
      </section>

      </div>
    </div>
	
@endsection