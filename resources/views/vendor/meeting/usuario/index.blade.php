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
                <p>Local: {{App\Models\Localizacao::find($detalhe_reuniao->localizacao_id)->nome}}</p>
                <p>Facilitador: {{App\User::find($reuniao->user_id)->nome}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" onclick="redirectReuniao('{{$reuniao->reuniao_id}}', `{{route('reuniao')}}`)" class="small-box-footer">Mais detalhes <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          
          @endforeach
       
      </section>

      </div>
    </div>
	
@endsection