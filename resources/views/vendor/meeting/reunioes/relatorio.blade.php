@extends('vendor/meeting/templates/template')

@section('css')

@endsection

@section('content')

<div class="container-fluid">
	@section('bread-crumbs')
        <a href="{{url('home')}}">Página Inicial</a>/
        <a href="{{url('reunioes')}}">Gerenciar Reuniões</a>/
        <a href="{{url("reunioes/gerar-relatorios")}}">Gerar Relatório de Reuniões</a>
    @endsection
    <div class="col-sm-4 form-group " style="position:relative; float: right;">
        <button onclick="criaPDF();"><i class="fas fa-file-pdf"></i> Criar PDF</button>
    </div>
    <div id="relatorio" class="relatorio">

        <h3>Relatório de Reuniões</h3> 
        <div class="container-fluid col-sm-12 form-group">
            <div class="table-responsive">
                <table id="" class="table  table-striped  table-bordered  table-hover  table-condensed  js-sticky-table">
                    @foreach($usuarios as $usuario)
                    <thead class="aw-table-header-solid center">
                        <th> {{$usuario->nome}} Participou de {{$usuario->qtd_participacao}} Reuniões </th>
                        
                    </thead>
                     
                    <tbody>
                        <tr>
                            <td>
                                <table id="" class="table  table-striped  table-bordered  table-hover  table-condensed  js-sticky-table">
                                    @foreach($usuario->reunioes as $reuniao)
                                        <thead class="aw-table-header-solid center">
                                            <tr style="background: #20B2AA;">
                                                <td colspan="6">
                                                    Título da Reunião: {{$reuniao->title}} | 
                                                    Facilitador: {{$reuniao->facilitador->nome}} | 
                                                    Tipo: {{$reuniao->tipo}} | 
                                                    Data: {{$reuniao->data_inicio}} 
                                                </td>
                                            </tr>
                                                <td>Pautas:</td>
                                                <td>Participantes:</td>
                                            <tr>
                                            </tr>
                                        </thead>

                                        <tbody class=" center">
                                            
                                                <td>
                                                    

                                                    @foreach($reuniao->hasPautas as $pauta)
                                                         {{$pauta->nome}} <br>
                                                        
                                                    @endforeach

                                                    </td>
                                                    <td>
                                                    

                                                    @foreach($reuniao->hasParticipantes as $participante)
                                                       {{$participante->nome}} <br>
                                                        
                                                        
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </tbody>

                                    @endforeach
                                </table>
                            </td>
                        </tr>

                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>

       
    	
    		
    		 
    	

    </div>

@endsection

@section('js')

<script  src="{{asset('vendor/meeting/javascripts/gerar-pdf.js')}}"></script>

@endsection