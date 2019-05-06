@extends('vendor/meeting/templates/template')

@section('css')

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
 


@endsection

@section('content')

 	<div class="container-fluid">
    @section('bread-crumbs')
      <a href="{{url('home')}}">Página Inicial</a>
    @endsection

    <div class="row">
      
      <section class="content left">
        <h2>Calendário de Reuniões</h2>

       		
        

          <div class="panel panel-primary">
            <div class="panel-body calendario" >
                
              {!! $calendar_details->calendar() !!}
            </div>
          </div>

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


@section('js')

<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

<script  src="{{asset('vendor/meeting/fullcalendar/lang/pt-br.js')}}"></script>

{!! $calendar_details->script() !!}

@endsection


