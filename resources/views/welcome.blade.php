<!DOCTYPE html>
<html lang = "pt-BR">

<head>
    <title> Home </title>
    <meta charset="utf-8">
    <link href="{{ asset('vendor/meeting/css/styles-homepage.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
    
<body> 
    <div class="container">

        <div class="ilustracao">
            <img src="{{asset('vendor/meeting/img/reuniao.png')}}" alt="Imagem de Reunião">
        </div>

        <div class="box-text">
            <div class="conteudo-text">
                @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                       <span style="color: #6931dc;">Bem Vindo {{auth()->user()->nome}}</span>  <a href="{{ url('/home') }}">Ir Para Home</a>
                    @else
                        <a href="{{ route('register') }}">Registrar</a>
                        <a href="{{ route('login') }}">Entrar</a>

                    @endauth
                </div>
            @endif
                

                <h1>Meeting</h1>
                <p>" O Meeting é um software inovador que ajuda há organizar e planejar reuniões de sucesso. Garantimos resultado na produtividade, gerenciamos salas, pautas, atas e outras ferramentas de excelente qualidade"</p>
            </div>
        </div>
    </div>{{ trans('adminlte::adminlte.sign_up') }}

</body>

<html>
